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

Route::get('/', 'HomeController@index');
Route::match(['post','get'],'result/{date}','HomeController@showResult');
Route::match(['post','get'],'/lk','LkController@index')->name('lk');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
