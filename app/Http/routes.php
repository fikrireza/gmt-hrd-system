<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
  return view('pages/login');
});

Route::get('dashboard', [
  'as'=>'dashboard',
  'uses'=>'CustomAuthController@gotodashboard'
])->middleware('isAdmin');

Route::post('loginprocess', 'CustomAuthController@loginprocess');
Route::get('logoutprocess', 'CustomAuthController@logoutprocess');

Route::resource('masterpegawai', 'MasterPegawaiController');
Route::resource('masterjabatan', 'MasterJabatanController');
Route::resource('useraccount', 'AkunController');
