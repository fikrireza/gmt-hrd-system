<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {return view('pages/login');})->name('index');

Route::get('dashboard', 'DashboardController@gotodashboard')->name('dashboard');

Route::post('login', 'Auth\LoginController@postLogin')->name('login');
Route::get('logout', 'Auth\LoginController@getLogout')->name('logout');

////// MASTER PEGAWAI //////
Route::resource('masterpegawai', 'MasterPegawaiController');
Route::post('masterpegawai', 'MasterPegawaiController@store')->name('masterpegawai.store');
Route::get('datatables', ['as'=>'datatables.data', 'uses'=>'MasterPegawaiController@getDataForDataTable']);
Route::get('masterpegawai/changestatus/{id}', 'MasterPegawaiController@changestatus');

////// PKWT //////
Route::get('data-pkwt', 'PKWTController@index')->name('kelola.pkwt');
Route::get('datatablespkwt', ['as'=>'datatables.pkwt', 'uses'=>'PKWTController@getPKWTforDataTables']);
Route::get('datatablespkwtdash', ['as'=>'datatables.dash', 'uses'=>'PKWTController@getPKWTforDashboard']);
Route::get('add-pkwt', ['as'=>'datapkwt.create', 'uses'=>'PKWTController@create']);
Route::post('add-pkwt/proses', 'PKWTController@store');
Route::get('view-detail-pkwt/{id}', ['as'=>'detail.pkwt', 'uses'=>'PKWTController@detail']);
Route::get('edit-pkwt/getpkwt/{id}', 'PKWTController@bind');
Route::post('savepkwt', 'PKWTController@saveChangesPKWT');
Route::post('terminatepkwt', 'PKWTController@terminatePKWT');

////// SPV Manajemen //////
Route::get('spv-manajemen', ['as' => 'spv-manajemen', 'uses' => 'PKWTController@viewSPV']);
Route::post('getClientSPV', ['as' => 'getClientSPV', 'uses' => 'PKWTController@proses']);
Route::post('changeSPV', ['as' => 'changeSPV', 'uses' => 'PKWTController@changeSPV']);

Route::resource('masterjabatan', 'MasterJabatanController');
Route::get('masterjabatan/hapusjabatan/{id}', ['as'=>'masterjabatan.hapusjabatan', 'uses'=>'MasterJabatanController@hapusJabatan']);

////// Buat Laporan //////
Route::get('laporan-pegawai', ['as' => 'laporanpegawai', 'uses' => 'LaporanPegawaiController@index']);
Route::post('laporan-proses', ['as' => 'proseslaporan', 'uses' => 'LaporanPegawaiController@proses']);
Route::get('laporan-proses/{id}/{type}', 'LaporanPegawaiController@downloadExcel');

Route::resource('masterclient','MasterClientController');
Route::get('masterclient/cabang/{id}','MasterClientController@cabang_client_show');
Route::resource('cabangclient','CabangClientController');
Route::resource('departemencabang','DepartemenCabangController');

Route::resource('useraccount', 'AkunController');
Route::get('useraccount/delete/{id}', 'AkunController@delete');
Route::get('useraccount/kelola-profile/{id}', 'AkunController@kelolaprofile')->name('kelola.profile');
Route::post('useraccount/update-profile', 'AkunController@updateprofile')->name('profile.edit');
Route::post('useraccount/update-password', 'AkunController@updatepassword')->name('profile.editpassword');
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
Route::get('uploaddokumen/hapusdokumen/{id}', 'UploadDocumentController@hapusDokumen');
Route::get('masterpegawai/getdokumen/{id}', 'MasterPegawaiController@getdokumen');
Route::post('masterpegawai/editdokumenpegawai', 'MasterPegawaiController@editdokumenpegawai');
Route::post('masterpegawai/savepegawai', 'MasterPegawaiController@saveChangesPegawai');

Route::get('upload/view-document', 'UploadDocumentController@getDocforDataTables')->name('datatables.doc');
Route::get('upload/bind-data/{id}', 'UploadDocumentController@bindData');
Route::post('upload/edit', 'UploadDocumentController@editDokumen')->name('upload.edit');

Route::post('data-peringatan/create', 'DataPeringatanController@create')->name('dataperingatan.create');
Route::get('masterpegawai/hapusperingatan/{id}', 'DataPeringatanController@hapusPeringatan');
Route::post('masterpegawai/editperingatan', 'DataPeringatanController@editPeringatan')->name('dataperingatan.update');
Route::get('masterpegawai/bind-peringatan/{id}', 'DataPeringatanController@bindPeringatan');

Route::post('historipegawai/create', ['as' => 'historipegawai.create', 'uses' => 'MasterPegawaiController@addhistoripegawai']);
Route::get('historipegawai/bind-data/{id}', 'MasterPegawaiController@bindhistoriperingatan');
Route::post('historipegawai/update', ['as' => 'historipegawai.update', 'uses' => 'MasterPegawaiController@updatehistoripegawai']);

Route::get('import', ['as' => 'import', 'uses' => 'ImportDataController@index']);
Route::post('import-proses', 'ImportDataController@proses');
Route::get('import-template/{type}', 'ImportDataController@downloadExcel');


///// KOMPONEN GAJI //////
Route::get('komponen-gaji', 'KomponenGajiController@index')->name('komgaji.index');
Route::post('komponen-gaji', 'KomponenGajiController@store')->name('komgaji.store');
Route::post('komponen-gaji/update/{$id}', 'KomponenGajiController@update')->name('komgaji.update');
Route::get('komponen-gaji/delete/{$id}', 'KomponenGajiController@delete')->name('komgaji.delete');

///// PERIODE GAJI ///////
Route::get('periode-gaji', 'PeriodeGajiController@index')->name('periodegaji.index');
Route::post('periode-gaji', 'PeriodeGajiController@store')->name('periodegaji.store');
Route::post('periode-gaji/update/{id}', 'PeriodeGajiController@update')->name('periodegaji.update');
Route::get('periode-gaji/delete/{id}', 'PeriodeGajiController@delete')->name('periodegaji.delete');
Route::get('periode-gaji/detail/{id}', 'PeriodeGajiController@detail')->name('periodegaji.detail');
Route::get('periode-gaji/get-detail/periode/{id}', 'PeriodeGajiController@getdatafordatatable')->name('periodegaji.getdata');

///// PEGAWAI TO PERIODE /////
Route::get('periode-pegawai', 'PegawaiToPeriodeController@index')->name('periodepegawai.index');
Route::post('periode-pegawai', 'PegawaiToPeriodeController@store')->name('periodepegawai.store');
Route::get('periode-pegawai/delete/{id}', 'PegawaiToPeriodeController@delete')->name('periodepegawai.delete');

///// SET GAJI PEGAWAI //////
Route::get('pegawai/set-gaji', 'SetGajiController@index')->name('setgaji.index');
Route::get('pegawai/detail-pegawai/{id}', 'SetGajiController@detailpegawai')->name('setgaji.detailpegawai');
Route::get('pegawai/getdata', 'SetGajiController@getdata')->name('setgaji.getdata');