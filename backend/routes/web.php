<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'api/'], function() use ($router) {
    $router->post('/reels', 'ReelController@create');
    $router->get('/reels', 'ReelController@listReels');
    $router->post('/reels/{reelId}/videos', 'VideoClipController@create');
    $router->delete('/reels/{reelId}/videos/{id}', 'VideoClipController@delete');
    $router->get('/reels/{reelId}', 'ReelController@getReel');
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});
