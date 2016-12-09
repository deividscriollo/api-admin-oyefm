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
// Programas
Route::resource('programas', 'programasController');
// Programa Actual
Route::get('programaactual', 'programasController@programa_actual');
// Video Semanal
Route::resource('videosemanal', 'videosemanalController');
// Galeria
Route::resource('galeria', 'galeriaController');
// CLientes
Route::resource('clientes', 'clientesController');
// Slider
Route::resource('slider', 'sliderController');
// ultimas noticias
Route::resource('ultimas-noticias', 'ultimas_noticiasController');
// Top 10
Route::post('addTop10', 'top10Controller@addTop10');
Route::get('gettop10', 'top10Controller@getlistaTop10');
// Radios
Route::resource('getRadios', 'RadiosController@Get_Radios');
Route::resource('AddRadio', 'RadiosController@Add_Radio');

});

