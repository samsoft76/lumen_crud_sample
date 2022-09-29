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

$router->get('/', ['middleware' => 'auth', 'uses' => 'ProductController@index']);

$router->get('/products', ['middleware' => 'auth', 'uses' => 'ProductController@index']);

$router->post('/product', ['middleware' => 'auth', 'uses' => 'ProductController@create']);

$router->put('/product/{id}', ['middleware' => 'auth', 'uses' => 'ProductController@update']);

$router->delete('/product/{id}', ['middleware' => 'auth', 'uses' => 'ProductController@destroy']);

//$router->get('/key', function() {
//    return \Illuminate\Support\Str::random(32);
//});
$router->group(['prefix' => 'auth'], function ($router) {
    $router->post('login', 'AuthController@login');
    $router->get('logout', 'AuthController@logout');
    $router->post('forgot-password', 'AuthController@forgotPassword');
    $router->post('reset-password', 'AuthController@resetPassword');
    $router->post('change-password', ['middleware' => 'auth', 'uses' => 'AuthController@changePassword']);
    $router->get('token', ['middleware' => 'auth', 'uses' => 'AuthController@refreshToken']);
});

