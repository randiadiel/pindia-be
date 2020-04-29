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


$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('/login','AuthController@login');

    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('/','AuthController@me');
        $router->post('/','UserController@store');

    });

    $router->group(['prefix' => 'shops', 'middleware' => 'jwt.verify'], function () use ($router) {
        $router->post('/','ShopController@store');
        $router->group(['middleware' => 'verify.seller'],function () use ($router){
            $router->get('/','ShopController@show');
            $router->patch('/','ShopController@update');
            $router->delete('/','ShopController@destroy');
        });
            
    });

});




