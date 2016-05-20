<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// mostrar informacion
Route::resource('noticias', 'noticiasController');
Route::delete('delnoticia/{delId}/{categoria}', 'deleteController@destroy');
Route::resource('programas', 'programasController');
Route::resource('videosemanal', 'videosemanalController');
Route::resource('galeria', 'galeriaController');
Route::resource('clientes', 'clientesController');
Route::resource('slider', 'sliderController');
Route::resource('ultimas-noticias', 'ultimas_noticiasController');
// Route::resource('curiosidades', 'noticiasController');
// Route::resource('deportes', 'noticiasController');
// Route::resource('farandula', 'noticiasController');

// Route::post('/api/v1/noticias', 'Noticias@store');