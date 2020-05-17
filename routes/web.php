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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::view('/', 'welcome');
Route::get('wood', 'WorkersController@wood');
//Route::get('table', 'WorkersController@table');
Route::view('table', 'workers.table');
//Route::view('list', 'workers.index');
Route::get('workers', 'HomeController@index');
Route::get('home', 'HomeController@index');
//Route::view('/workers', 'workers.index');
//Route::get('workers', 'WorkersController');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
