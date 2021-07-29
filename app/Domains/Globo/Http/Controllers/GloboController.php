<?php

namespace App\Domains\Globo\Http\Controllers;
use App\Domains\Core\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Domains\Globo\Services\GloboService;

class GloboController extends Controller
{

    /**
    * @var GloboService
    */
    private $globoService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        GloboService $globoService
    )
    {
        $this->globoService = $globoService;
    }

    /**
     * List all last notices by globo.com
     * @return Object
     */
    public function list(Request $request)
    {

        try{
            $response = $this->globoService->list();
            return $response;
        }catch(\Exception $e){
            return new JsonResponse([
                'error' =>  $e->getMessage(),
            ], 500);
        }
    }
}
