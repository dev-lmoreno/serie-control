<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/series', 'App\Http\Controllers\SeriesController@index')->name('list_series');
Route::get('/series/create', 'App\Http\Controllers\SeriesController@create')->name('create_series')->middleware('authenticator');
Route::post('/series/create', 'App\Http\Controllers\SeriesController@store')->middleware('authenticator');
Route::delete('/series/{id}', 'App\Http\Controllers\SeriesController@destroy')->middleware('authenticator');
Route::post('/series/{id}/edit', 'App\Http\Controllers\SeriesController@edit')->middleware('authenticator');
Route::get('/series/{id}/seasons', 'App\Http\Controllers\SeasonsController@index');
// está sendo passado {season} para que na controller seja criado um OBJETO do tipo Season diretamente
Route::get('/seasons/{season}/episodes', 'App\Http\Controllers\EpisodesController@index');
Route::post('/seasons/{season}/episodes/watched', 'App\Http\Controllers\EpisodesController@watched')->middleware('authenticator');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

// login 
Route::get('/mylogin', 'App\Http\Controllers\MyLoginController@index');
Route::post('/mylogin', 'App\Http\Controllers\MyLoginController@login');
// register
Route::get('/myregister', 'App\Http\Controllers\MyRegisterController@create');
Route::post('/myregister', 'App\Http\Controllers\MyRegisterController@store');
// logout
Route::get('/mylogout', function() {
    Auth::logout();
    return redirect('/mylogin');
});

// email
Route::get('/email', function() {
    return new \App\Mail\NewSerie('teste',10,5);
});

Route::get('/send-email', function() {
    $email =  new \App\Mail\NewSerie('teste',10,5);

    $user = (object) [ 
        'email' => 'lmoreno@teste.com',
        'name' => 'Lucas'
    ];

    Mail::to($user)->send($email);

    return 'Email enviado';
});