<?php
namespace App;

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
use Illuminate\Support\Facades\Mail;
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

Route::get('/visualizando-email', function ()
{
    return new \App\Mail\NovaSerie('Arrow',2,2);
});

Route::get('/enviando-email', function ()
{
    //pagina que será enviada por email
    $email = new \App\Mail\NovaSerie('Arrow',2,2);
    
    //titulo do email
    $email->subject = 'Nova Série Adicionada';

    //dados do usuário
    $user = (object)[
        'email' => 'jean@teste.com',
        'name'  => 'Jean'
    ];

    //envio do email
    Mail::to($user)->send($email);

    //retorno da rota
    return 'Email enviado!';
});