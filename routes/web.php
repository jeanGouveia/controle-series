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

use App\Http\Controllers\TemporadasController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola', function(){
    echo 'Olá Jean!';
});

Route::get('/series', 'SeriesController@index')
    ->name('series.index');
Route::get('/series/adicionar', 'SeriesController@create')
    ->name('criar');
Route::post('/series/adicionar', 'SeriesController@store');

Route::delete('/series/{id}', 'SeriesController@destroy');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');
    
