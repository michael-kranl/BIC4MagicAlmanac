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

Route::get('/', 'GuestController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('spell', 'SpellController');
Route::resource('kind', 'KindController');

Route::get('/search/spell', 'SpellController@search')->name('spell.search');
Route::post('/search/spell', 'SpellController@query')->name('spell.query');

Route::get('/list/kind', 'KindController@list')->name('kind.list');
Route::get('/list/spell', 'SpellController@list')->name('spell.list');

Route::get('/kind/{kind}/detail', 'KindController@detail')->name('kind.detail');

