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

Auth::routes(['register'=>false]);
Route::get('/attendance-request', 'RequestsController@create');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return redirect()->route('home');
    });
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/report', 'ReportsController@index')->name('report');
    Route::post('/attendance-request', 'RequestsController@store')->name("store_request");
    Route::get('/approve-request/{id}', 'RequestsController@approve_request')->name('approve_request');
    Route::resource('/requests', 'RequestsController');
    Route::resource('/services', 'ServicesController');
    Route::resource('/users', 'UsersController');
});
