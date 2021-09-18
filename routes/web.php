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

Route::get('/series', 'App\Http\Controllers\SeriesController@index')
    ->name('list_series');
Route::get('/series/create', 'App\Http\Controllers\SeriesController@create')
    ->name('create_series');
Route::post('/series/create', 'App\Http\Controllers\SeriesController@store');
Route::delete('/series/{id_serie}', 'App\Http\Controllers\SeriesController@destroy');