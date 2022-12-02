<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Support\Str;

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');
$router->get('/user/{id}', 'UserController@show');
$router->get('/buku', 'BukuController@show');
$router->post('/buku', 'BukuController@create');
$router->get('/buku/{id}', 'BukuController@showId');
$router->delete('/buku/{id}', 'BukuController@delete');
$router->put('/buku/{id}', 'BukuController@update');