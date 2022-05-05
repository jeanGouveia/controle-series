<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola', function(){
    echo 'Olá Jean!';
});

Route::get('/series', 'SeriesController@index')->name('series.index');

Route::get('/series/adicionar', 'SeriesController@create')
    ->name('criar')
    ->middleware('autenticador');

Route::post('/series/adicionar', 'SeriesController@store')
    ->middleware('autenticador');

Route::delete('/series/{id}', 'SeriesController@destroy')
    ->middleware('autenticador');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');

Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')
    ->middleware('autenticador');

Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');

Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir')
    ->middleware('autenticador');

Auth::routes();

//Route::get('/series', 'SeriesController@index')->name('home');

Route::get('/entrar', 'EntrarController@index')
    ->name('entrar');

Route::post('/entrar', 'EntrarController@entrar');

Route::get('/registrar', 'RegistroController@create');

Route::post('/registrar', 'RegistroController@store');

Route::get('/sair', function(){
    Auth::logout();
    return redirect('/entrar');
});