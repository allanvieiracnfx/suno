<?php

namespace App\Domains\Globo\Services;
use App\Domains\Rss\Services\RssService;


class GloboService
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
    public function list()
    {

        try{
            return $this->rssService->list('https://g1.globo.com/rss/g1/economia/');
        }catch(\Exception $e){
            throw $e;
        }
    }
}
