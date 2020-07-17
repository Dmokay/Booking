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
Route::post('/attendance-request', 'RequestsController@store')->name("store_request");
Route::get('/validate-attendance', 'RequestsController@validate_attendance')->name('validate_attendance');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return redirect()->route('home');
    });
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/service/toggle/{id}', 'ServicesController@toggle')->name('toggle_service');
    Route::get('/report', 'ReportsController@index')->name('report');
    Route::get('/approve-request/{id}', 'RequestsController@approve_request')->name('approve_request');
    Route::resource('/requests', 'RequestsController');
    Route::resource('/services', 'ServicesController');
    Route::resource('/users', 'UsersController');
});
