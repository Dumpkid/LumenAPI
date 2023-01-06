<?php

/** @var \Laravel\Lumen\Routing\Router $router */

// use App\Http\Controllers\AnggotaController;
// use App\Models\Anggota;
// use Illuminate\Support\Str;

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
$router->post('/daftar_anggota', 'AuthController@registrasi_anggota');
$router->post('/login_anggota', 'AuthController@login_anggota');


$router->group(['middleware' => 'role:petugas'], function () use ($router) {
    $router->get('/petugas/{id}', 'PetugasController@show');
    $router->post('/buku', 'BukuController@create');
    $router->delete('/buku/{id}', 'BukuController@delete');
    $router->put('/buku/{id}', 'BukuController@update');
    $router->get('/anggota', 'AnggotaController@show');
    $router->get('/anggota/{id}', 'AnggotaController@showId');
    $router->put('/anggota/{id}', 'AnggotaController@update');
    $router->delete('anggota/{id}', 'AnggotaController@delete');
    $router->post('/jenis_buku', 'JenisBukuController@create');
    $router->put('/jenis_buku/{id}', 'JenisBukuController@update');
    $router->delete('/jenis_buku/{id}', 'JenisBukuController@delete');
    $router->post('/rak', 'RakController@create');
    $router->put('/rak/{id}', 'RakController@update');
    $router->delete('/rak/{id}', 'RakController@delete');
    $router->post('/penerbit', 'PenerbitController@create');
    $router->put('/penerbit/{id}', 'PenerbitController@update');
    $router->delete('/penerbit/{id}', 'PenerbitController@delete');
    $router->post('/penulis', 'PenulisController@create');
    $router->put('/penulis/{id}', 'PenulisController@update');
    $router->delete('/penulis/{id}', 'PenulisController@delete');
    $router->get('/peminjaman', 'PinjamController@show');
    $router->get('/peminjaman/{id}', 'PinjamController@showId');
    $router->post('/peminjaman', 'PinjamController@create');
    $router->put('/peminjaman/{id}', 'PinjamController@update');
    $router->delete('/peminjaman/{id}', 'PinjamController@delete');
    $router->get('/pengembalian', 'KembaliController@show');
    $router->get('/pengembalian/{id}',  'Kembaliontroller@showId');
    $router->post('/pengembalian', 'KembaliController@create');
    $router->put('/pengembalian/{id}', 'KembaliController@update');
    $router->delete('/pengembalian/{id}', 'KembaliController@delete');
    
});

$router->group(['middleware' => 'role:anggota,petugas'], function() use ($router) {
    $router->get('/buku', 'BukuController@show');
    $router->get('/buku/{id}', 'BukuController@showId');
    $router->get('/rak', 'RakController@show');
    $router->get('/rak/{id}', 'RakController@showId');
    $router->get('/jenis_buku', 'JenisBukuController@show');
    $router->get('/jenis_buku/{id}', 'JenisBukuController@showId');
    $router->get('/penerbit', 'PenerbitController@show');
    $router->get('/penerbit/{id}', 'PenerbitController@showId');
    $router->get('/penulis', 'PenulisController@show');
    $router->get('/penulis/{id}', 'PenulisController@showId');
});


