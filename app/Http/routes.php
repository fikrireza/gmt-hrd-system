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
Route::get('datatables', ['as'=>'datatables.data', 'uses'=>'MasterPegawaiController@getDataForDataTable']);

Route::get('data-pkwt', 'PKWTController@index')->name('kelola.pkwt');
Route::get('datatablespkwt', ['as'=>'datatables.pkwt', 'uses'=>'PKWTController@getPKWTforDataTables']);
Route::get('datatablespkwtdash', ['as'=>'datatables.dash', 'uses'=>'PKWTController@getPKWTforDashboard']);
Route::get('add-pkwt', ['as'=>'datapkwt.create', 'uses'=>'PKWTController@create']);
Route::post('add-pkwt/proses', 'PKWTController@store');
Route::get('view-detail-pkwt/{id}', ['as'=>'detail.pkwt', 'uses'=>'PKWTController@detail']);
Route::get('edit-pkwt/getpkwt/{id}', 'PKWTController@bind');
Route::post('savepkwt', 'PKWTController@saveChangesPKWT');

Route::resource('masterjabatan', 'MasterJabatanController');
Route::get('masterjabatan/hapusjabatan/{id}', ['as'=>'masterjabatan.hapusjabatan', 'uses'=>'MasterJabatanController@hapusJabatan']);

// Route::resource('masterbahasaasing', 'MasterBahasaAsingController');
// Route::get('masterbahasaasing/delete/{id}', ['as'=>'masterbahasaasing.delete', 'uses'=>'MasterBahasaAsingController@delete']);

Route::resource('masterclient','MasterClientController');
Route::get('masterclient/cabang/{id}','MasterClientController@cabang_client_show');
Route::resource('cabangclient','CabangClientController');
Route::resource('departemencabang','DepartemenCabangController');

Route::resource('useraccount', 'AkunController');
Route::resource('uploaddocument', 'UploadDocumentController');

Route::post('addkeluarga', 'MasterPegawaiController@addKeluarga');
Route::get('masterpegawai/hapuskeluarga/{id}', 'MasterPegawaiController@hapusKeluarga');
Route::get('masterpegawai/getkeluarga/{id}', 'MasterPegawaiController@getDataKeluargaByID');
Route::post('masterpegawai/savekeluarga', 'MasterPegawaiController@saveChangesKeluarga');
Route::post('masterpegawai/savedarurat', 'MasterPegawaiController@saveChangesDarurat');

Route::post('addpendidikan', 'MasterPegawaiController@addPendidikan');
Route::get('masterpegawai/hapuspendidikan/{id}', 'MasterPegawaiController@hapusPendidikan');
Route::get('masterpegawai/getpendidikan/{id}', 'MasterPegawaiController@getPendidikanByID');
Route::post('masterpegawai/savependidikan', 'MasterPegawaiController@saveChangesPendidikan');

Route::post('addpengalaman', 'MasterPegawaiController@addPengalaman');
Route::get('masterpegawai/hapuspengalaman/{id}', 'MasterPegawaiController@hapusPengalaman');
Route::get('masterpegawai/getpengalaman/{id}', 'MasterPegawaiController@getPengalamanByID');
Route::post('masterpegawai/savepengalaman', 'MasterPegawaiController@saveChangesPengalaman');

Route::post('addkomputer', 'MasterPegawaiController@addKomputer');
Route::get('masterpegawai/hapuskomputer/{id}', 'MasterPegawaiController@hapusKomputer');
Route::get('masterpegawai/getkomputer/{id}', 'MasterPegawaiController@getKomputerByID');
Route::post('masterpegawai/savekomputer', 'MasterPegawaiController@saveChangesKomputer');

Route::post('addbahasa', 'MasterPegawaiController@addBahasa');
Route::get('masterpegawai/hapusbahasa/{id}', 'MasterPegawaiController@hapusBahasa');
Route::get('masterpegawai/getbahasa/{id}', 'MasterPegawaiController@getBahasaByID');
Route::post('masterpegawai/savebahasa', 'MasterPegawaiController@saveChangesBahasa');

Route::post('addkesehatan', 'MasterPegawaiController@addKesehatan');
Route::get('masterpegawai/hapuskesehatan/{id}', 'MasterPegawaiController@hapusKesehatan');
Route::post('masterpegawai/savekesehatan', 'MasterPegawaiController@saveChangesKesehatan');

Route::post('addpenyakit', 'MasterPegawaiController@addPenyakit');
Route::get('masterpegawai/hapuspenyakit/{id}', 'MasterPegawaiController@hapusPenyakit');
Route::get('masterpegawai/getpenyakit/{id}', 'MasterPegawaiController@getPenyakitByID');
Route::post('masterpegawai/savepenyakit', 'MasterPegawaiController@saveChangesPenyakit');

Route::post('adddokumen', 'MasterPegawaiController@addDokumen');
Route::get('masterpegawai/hapusdokumen/{id}', 'MasterPegawaiController@hapusDokumen');

Route::post('masterpegawai/savepegawai', 'MasterPegawaiController@saveChangesPegawai');
