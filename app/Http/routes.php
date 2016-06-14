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


Route::group(['middleware' => 'cors'], function(){
Route::post('registro', 'usuarioController@registrar');
Route::post('login', 'usuarioController@login');
Route::get('usuario', ['uses' => 'usuarioController@getAuthenticatedUser']);
  // mostrar informacion
Route::resource('noticias', 'noticiasController');
Route::delete('delnoticia/{delId}/{categoria}', 'deleteController@destroy');
Route::resource('programas', 'programasController');
Route::resource('videosemanal', 'videosemanalController');
Route::resource('galeria', 'galeriaController');
Route::resource('clientes', 'clientesController');
Route::resource('slider', 'sliderController');
Route::resource('ultimas-noticias', 'ultimas_noticiasController');
Route::post('addTop10', 'top10Controller@addTop10');
Route::get('gettop10', 'top10Controller@getlistaTop10');
});

