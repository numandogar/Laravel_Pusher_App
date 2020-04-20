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

Route::view('/grocery', 'grocery');
Route::post('/grocery/post', 'Live_AJAX_Search@store')->name('grocery.store');

Route::get('/live_search', 'Live_AJAX_Search@index');
Route::get('/live_search/action', 'Live_AJAX_Search@action')->name('live_search.action');
