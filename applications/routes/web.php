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
Route::post('saveChangesPKWT', 'PKWTController@saveChangesPKWT');
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
Route::get('report/{kode_client}/{token}', 'LaporanPegawaiController@reportforclient')->name('reportforclient');

Route::resource('masterclient','MasterClientController');
Route::get('masterclient/cabang/{id}','MasterClientController@cabang_client_show');
Route::resource('cabangclient','CabangClientController');
Route::resource('departemencabang','DepartemenCabangController');

Route::resource('useraccount', 'AkunController');
Route::get('useraccount/delete/{id}', 'AkunController@delete');
Route::get('useraccount/kelola-profile/{id}', 'AkunController@kelolaprofile')->name('kelola.profile');
Route::post('useraccount/update-profile', 'AkunController@updateprofile')->name('profile.edit');
Route::post('useraccount/update-password', 'AkunController@updatepassword')->name('profile.editpassword');

Route::post('addkeluarga', 'MasterPegawaiController@addKeluarga');
Route::get('masterpegawai/hapuskeluarga/{id}', 'MasterPegawaiController@hapusKeluarga');
Route::get('masterpegawai/getkeluarga/{id}', 'MasterPegawaiController@getDataKeluargaByID');
Route::post('masterpegawai/savekeluarga', 'MasterPegawaiController@saveChangesKeluarga');
Route::post('masterpegawai/savedarurat', 'MasterPegawaiController@saveChangesDarurat');
Route::get('masterpegawai/getdarurat/{id}', 'MasterPegawaiController@bindDarurat');

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
Route::post('masterpegawai/setkondisikesehatan', 'MasterPegawaiController@setKondisiKesehatan')->name('kesehatan.set');

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

Route::resource('uploaddocument', 'UploadDocumentController');
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
Route::get('historipegawai/delete/{id}', 'MasterPegawaiController@hapusRiwayatPekerjaan');

Route::get('import', ['as' => 'import', 'uses' => 'ImportDataController@index']);
Route::post('import-proses', 'ImportDataController@proses');
Route::get('import-template/{type}', 'ImportDataController@downloadExcel');

///// KOMPONEN GAJI //////
Route::get('komponen-gaji', 'KomponenGajiController@index')->name('komgaji.index');
Route::post('komponen-gaji', 'KomponenGajiController@store')->name('komgaji.store');
Route::post('komponen-gaji/update', 'KomponenGajiController@update')->name('komgaji.update');
Route::get('komponen-gaji/delete/{id}', 'KomponenGajiController@delete')->name('komgaji.delete');
Route::get('komponen-gaji/update-nilai/{id}/{nilai}', 'KomponenGajiController@update_nilai')->name('komgaji.updatenilai');
Route::get('komponen-gaji/bind-gaji/{id}', 'KomponenGajiController@bind')->name('komgaji.bind');

///// PERIODE GAJI ///////
Route::get('periode-gaji', 'PeriodeGajiController@index')->name('periodegaji.index');
Route::post('periode-gaji', 'PeriodeGajiController@store')->name('periodegaji.store');
Route::post('periode-gaji/update', 'PeriodeGajiController@update')->name('periodegaji.update');
Route::post('periode-gaji/updateworkday', 'PeriodeGajiController@updateworkday')->name('periodegaji.updateworkday');
Route::get('periode-gaji/delete/{id}', 'PeriodeGajiController@delete')->name('periodegaji.delete');
Route::get('periode-gaji/detail/{id}', 'PeriodeGajiController@detail')->name('periodegaji.detail');
Route::get('periode-gaji/get-detail/periode/{id}', 'PeriodeGajiController@getdatafordatatable')->name('periodegaji.getdata');

///// PEGAWAI TO PERIODE /////
Route::get('periode-pegawai', 'PegawaiToPeriodeController@index')->name('periodepegawai.index');
Route::post('periode-pegawai', 'PegawaiToPeriodeController@store')->name('periodepegawai.store');
Route::get('periode-pegawai/delete/{id}', 'PegawaiToPeriodeController@delete')->name('periodepegawai.delete');
Route::post('periode-pegawai-proses', 'PegawaiToPeriodeController@proses')->name('periodepegawai.proses');

///// SET GAJI PEGAWAI //////
Route::get('pegawai/set-gaji', 'SetGajiController@index')->name('setgaji.index');
Route::get('pegawai/detail-pegawai/{id}', 'SetGajiController@detailpegawai')->name('setgaji.detailpegawai');
Route::get('pegawai/getdata', 'SetGajiController@getdata')->name('setgaji.getdata');
Route::get('pegawai/bind-gaji/{id}', 'SetGajiController@bind')->name('setgaji.bind');
Route::post('pegawai/update-gaji', 'SetGajiController@update')->name('setgaji.update');

///// BATCH PAYROLL ///////
Route::get('batch-payroll', 'BatchPayrollController@index')->name('batchpayroll.index');
Route::post('batch-payroll', 'BatchPayrollController@store')->name('batchpayroll.store');
Route::post('batch-payroll/update', 'BatchPayrollController@update')->name('batchpayroll.update');
Route::get('batch-payroll/bind-batch-payroll/{id}', 'BatchPayrollController@bind')->name('batchpayroll.bind');
Route::get('batch-payroll/delete/{id}', 'BatchPayrollController@delete')->name('batchpayroll.delete');
Route::get('batch-payroll/detail/{id}', 'BatchPayrollController@detail')->name('batchpayroll.detail');
Route::get('batch-payroll/getdata/{id}', 'BatchPayrollController@getdatafordatatable')->name('batchpayroll.getdata');
Route::get('batch-payroll/refreshrowdatatables/{id}', 'BatchPayrollController@refreshrowdatatables')->name('batchpayroll.refreshrow');

///// DETAIL BATCH PAYROLL //////
Route::get('detail-batch-payroll/bind-to-table/{idbatch}/{idpegawai}', 'DetailBatchPayrollController@getdatakomponen')->name('detailbatchpayroll.bindtotable');
Route::get('detail-batch-payroll/add-to-komponen/{idbatch}/{idpegawai}/{idkomponen}/{nilai}', 'DetailBatchPayrollController@addtodetailkomponen')->name('detailbatchpayroll.addkomponen');
Route::get('detail-batch-payroll/cek-komponen-gaji/{idbatch}/{idpegawai}', 'DetailBatchPayrollController@cekkomponen')->name('detailbatchpayroll.cekkomponen');
Route::get('detail-batch-payroll/get-gapok/{idpegawai}', 'DetailBatchPayrollController@getgajipokok')->name('detailbatchpayroll.getgapok');
Route::get('detail-batch-payroll/delete-komponen-gaji/{id}', 'DetailBatchPayrollController@deletekomponengaji')->name('detailbatchpayroll.deletekomponen');
Route::get('detail-batch-payroll/bind-for-absen/{id}', 'DetailBatchPayrollController@bindforabsen')->name('detailbatchpayroll.bindforabsen');
Route::post('detail-batch-payroll/update-for-absen', 'DetailBatchPayrollController@updateforabsen')->name('detailbatchpayroll.updateforabsen');

///// EXPORT IMPORT DETAIL BATCH PAYROLL ////
Route::get('detail-batch-payroll/export/{idbatch}', 'ExportImportDetailBatchPayrollController@export')->name('detailbatchpayroll.export');
Route::post('detail-batch-payroll/import', 'ExportImportDetailBatchPayrollController@import')->name('detailbatchpayroll.import');


///// HARI LIBUR //////
Route::get('hari-libur', 'HariLiburController@index')->name('hari.libur.index');
Route::post('hari-libur', 'HariLiburController@store')->name('hari.libur.store');
Route::post('hari-libur/update', 'HariLiburController@update')->name('hari.libur.update');
Route::get('hari-libur/bind-hari-libur/{id}', 'HariLiburController@bind')->name('hari.libur.bind');
Route::get('hari-libur/delete/{id}', 'HariLiburController@delete')->name('hari.libur.delete');

///// BPJS //////
Route::get('bpjs', 'BpjsController@index')->name('bpjs.index');
Route::post('bpjs', 'BpjsController@store')->name('bpjs.store');
Route::post('bpjs/update', 'BpjsController@update')->name('bpjs.update');
Route::get('bpjs/bind-bpjs/{id}', 'BpjsController@bind')->name('bpjs.bind');
Route::get('bpjs/delete/{id}', 'BpjsController@delete')->name('bpjs.delete');

///// CUTI //////
Route::get('cuti', 'CutiController@index')->name('cuti.index');
Route::post('cuti', 'CutiController@store')->name('cuti.store');
Route::post('cuti/update', 'CutiController@update')->name('cuti.update');
Route::get('cuti/bind-cuti/{id}', 'CutiController@bind')->name('cuti.bind');
Route::get('cuti/delete/{id}', 'CutiController@delete')->name('cuti.delete');
