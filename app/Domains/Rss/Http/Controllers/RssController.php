<?php

namespace App\Domains\Rss\Http\Controllers;
use App\Domains\Core\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Domains\Rss\Services\RssService;

class RssController extends Controller
{

    /**
    * @var RssService
    */
    private $rssService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        RssService $rssService
    )
    {
        $this->rssService = $rssService;
    }

    /**
     * List all last notices by globo.com
     * @return Object
     */
    public function list(Request $request)
    {

        try{
            $url = $request->rss_url;
            $response = $this->rssService->list($url);
            return $response;
        }catch(\Exception $e){
            return new JsonResponse([
                'error' =>  $e->getMessage(),
            ], 500);
        }
    }
}
