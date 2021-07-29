<?php

namespace App\Domains\Rss\Services;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use SimplePie;
use Carbon\Carbon;


class RssService
{

    /**
    * @var SimplePie
    */
    private $simplePie;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        SimplePie $simplePie
    )
    {
        $this->simplePie = $simplePie;
    }

    /**
     * List any rss notices by url
     * @return Object
     */
    public function list($url)
    {

        try{

            $value = Cache::get($url);

            if(!empty($value)) return new JsonResponse(json_decode($value), 200);

            $feed = $this->simplePie;
            $feed->set_feed_url($url);
            $feed->enable_order_by_date(true);
            $feed->enable_cache(false);
            // $feed->set_cache_location(dirname($_SERVER['DOCUMENT_ROOT'], 1) .'/App/Domains/Rss/Storage/Cache');
            // $feed->set_cache_duration(1000);
            $feed->init();
            
            $items = $feed->get_items();
            
            if(empty($items)){
                if(!empty($value)) return new JsonResponse($value, 200);
                return new JsonResponse(null, 204);
            }

            $response = Array();
            
            foreach($items as $item){
                $data['title'] = $item->get_title();
                $data['data'] = $item->get_date();
                $data['link'] = $item->get_link();
                array_push($response, $data);
            }

            $time = Carbon::now()->addMinutes(15);
            if (Cache::has($url)) {
                Cache::put($url, json_encode($response), $time);
            }else{
                Cache::store('redis')->put($url, json_encode($response), $time);
            }

            return new JsonResponse($response, 200);
        }catch(\Exception $e){
            throw $e;
        }
    }
}
