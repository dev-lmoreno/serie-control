<?php

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
Route::get('/series/create', 'App\Http\Controllers\SeriesController@create')->name('create_series');
Route::post('/series/create', 'App\Http\Controllers\SeriesController@store');
Route::delete('/series/{id}', 'App\Http\Controllers\SeriesController@destroy');
Route::post('/series/{id}/edit', 'App\Http\Controllers\SeriesController@edit');
Route::get('/series/{id}/seasons', 'App\Http\Controllers\SeasonsController@index');
// está sendo passado {season} para que na controller seja criado um OBJETO do tipo Season diretamente
Route::get('/seasons/{season}/episodes', 'App\Http\Controllers\EpisodesController@index');

Route::post('/seasons/{season}/episodes/watched', 'App\Http\Controllers\EpisodesController@watched');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
