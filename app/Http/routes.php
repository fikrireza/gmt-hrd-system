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
]);

Route::post('loginprocess', 'CustomAuthController@loginprocess');
Route::get('logoutprocess', 'CustomAuthController@logoutprocess');

Route::resource('masterpegawai', 'MasterPegawaiController');
Route::get('datatables', ['as'=>'datatables.data', 'uses'=>'MasterPegawaiController@getDataForDataTable']);

Route::resource('masterjabatan', 'MasterJabatanController');
Route::get('masterjabatan/hapusjabatan/{id}', ['as'=>'masterjabatan.hapusjabatan', 'uses'=>'MasterJabatanController@hapusJabatan']);

Route::resourse('masterbahasaasing', 'MasterBahasaAsingController');
Route::get('masterbahasaasing/delete/{id}', ['as'=>'masterbahasaasing.delete', 'uses'=>'MasterBahasaAsingController@delete']);

Route::resource('masterclient','MasterClientController');
Route::get('masterclient/cabang/{id}','MasterClientController@cabang_client_show');
Route::get('masterclient/departemen/{id}','MasterClientController@departemen_client_show');
Route::resource('cabangclient','CabangClientController');
Route::resource('departemencabang','DepartemenCabangController');

Route::resource('useraccount', 'AkunController');
