<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\AnggotaController;
use App\Models\Anggota;
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

$router->post('/daftar_petugas', 'AuthController@registrasi_petugas');
$router->post('/login_petugas', 'AuthController@login_petugas');

$router->get('/petugas/{id}', 'PetugasController@show');

$router->get('/buku', 'BukuController@show');
$router->post('/buku', 'BukuController@create');
$router->get('/buku/{id}', 'BukuController@showId');
$router->delete('/buku/{id}', 'BukuController@delete');
$router->put('/buku/{id}', 'BukuController@update');

$router->get('/anggota', 'AnggotaController@show');
$router->get('/anggota/{id}', 'AnggotaController@showId');
$router->put('/anggota/{id}', 'AnggotaController@update');
$router->delete('anggota/{id}', 'AnggotaController@delete');

