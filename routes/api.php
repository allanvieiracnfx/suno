<?php

use Illuminate\Http\Request;
/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router->middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$router->get('/globo/notices/list', [
    'as' => 'index', 'uses' => 'App\Domains\Globo\Http\Controllers\GloboController@list'
]);

$router->post('/rss/notices/list', [
    'as' => 'index', 'uses' => 'App\Domains\Rss\Http\Controllers\RssController@list'
]);