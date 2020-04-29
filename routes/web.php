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

    $router->group(['middleware' => ['jwt.verify','verify.seller']], function () use ($router){
        $router->get('/productTypes','ProductTypeController@index');
    });

    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->post('/','UserController@store');

        $router->group(['middleware' => 'jwt.verify'], function () use ($router){
            $router->get('/','AuthController@me');
            $router->patch('/','UserController@update');
        });
    });

    $router->group(['prefix' => 'shops', 'middleware' => 'jwt.verify'], function () use ($router) {
        $router->post('/','ShopController@store');
        $router->group(['middleware' => 'verify.seller'],function () use ($router){
            $router->get('/','ShopController@show');
            $router->patch('/','ShopController@update');
            $router->delete('/','ShopController@destroy');
        });
    });


    $router->group(['prefix' => 'products'], function () use ($router) {
        $router->get('/{id}','ProductController@show');
        $router->get('/','ProductController@index');

        $router->get('/shops','ProductController@getShopProducts');

        $router->group(['middleware' => ['verify.seller','jwt.verify']],function () use ($router){
            $router->post('/','ProductController@store');
            $router->patch('/{id}','ProductController@update');
            $router->delete('/{id}','ProductController@destroy');
        });

    });
            

});




