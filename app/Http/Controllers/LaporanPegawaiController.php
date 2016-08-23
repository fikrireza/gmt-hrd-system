<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MasterJabatan;
use App\MasterPegawai;
use App\Models\CabangClient;
use App\Models\MasterClient;
use App\PKWT;
use DB;
use Excel;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;

class LaporanPegawaiController extends Controller
{


  public function index()
  {
    $getClient  = MasterClient::get();

    return view('pages.Laporan.laporanpegawai', compact('getClient'));
  }

  public function proses(Request $request)
  {

    $idClient = $request->id_client;

    $getClient  = MasterClient::get();
    $proses   = MasterPegawai::join('data_pkwt', 'data_pkwt.id_pegawai', '=', 'master_pegawai.id')
                              ->join('cabang_client', 'cabang_client.id', '=', 'data_pkwt.id_cabang_client')
                              ->join('master_client', 'master_client.id', '=', 'cabang_client.id_client')
                              ->join('master_jabatan', 'master_jabatan.id', '=', 'master_pegawai.id_jabatan')
                              ->select('master_pegawai.nip', 'master_pegawai.no_rekening', 'master_pegawai.nama', 'master_client.nama_client','master_jabatan.nama_jabatan', 'master_pegawai.no_ktp', 'master_pegawai.tanggal_lahir', 'master_pegawai.no_kk', 'master_pegawai.alamat', 'master_pegawai.no_telp', 'master_pegawai.jenis_kelamin', 'data_pkwt.tanggal_masuk_gmt', 'data_pkwt.tanggal_masuk_client')
                              ->where('data_pkwt.id_cabang_client', $idClient)
                              ->where('data_pkwt.status_pkwt', '=', 1)
                              ->orderBy('data_pkwt.tanggal_masuk_gmt', 'DESC')
                              ->paginate(10);

    return view('pages.Laporan.laporanpegawai', compact('getClient', 'idClient', 'proses'));
  }

  public function downloadExcel($id, $type)
  {
    $idClient = $id;

    $getClient  = MasterClient::get();
    $proses   = MasterPegawai::join('data_pkwt', 'data_pkwt.id_pegawai', '=', 'master_pegawai.id')
                              ->join('cabang_client', 'cabang_client.id', '=', 'data_pkwt.id_cabang_client')
                              ->join('master_client', 'master_client.id', '=', 'cabang_client.id_client')
                              ->join('master_jabatan', 'master_jabatan.id', '=', 'master_pegawai.id_jabatan')
                              ->select('master_pegawai.nip', 'master_pegawai.no_rekening', 'master_pegawai.nama', 'master_client.nama_client', 'data_pkwt.id_kelompok_jabatan', 'master_jabatan.nama_jabatan', 'master_pegawai.no_ktp', 'master_pegawai.tanggal_lahir', 'master_pegawai.no_kk', 'master_pegawai.alamat', 'master_pegawai.no_telp', 'master_pegawai.jenis_kelamin', 'data_pkwt.tanggal_masuk_gmt', 'data_pkwt.tanggal_masuk_client')
                              ->where('data_pkwt.id_cabang_client', $idClient)
                              ->where('data_pkwt.status_pkwt', '=', 1)
                              ->orderBy('data_pkwt.tanggal_masuk_gmt', 'DESC')
                              ->get()
                              ->toArray();
    // dd($proses);
    $spv  = MasterPegawai::join('data_pkwt', 'data_pkwt.id_kelompok_jabatan', '=', 'master_pegawai.id')
                          ->select('data_pkwt.id_kelompok_jabatan', 'master_pegawai.nama')
                          ->where('data_pkwt.status_pkwt', 1)
                          ->groupBy('master_pegawai.id')
                          ->get();
    //dd($spv);

    return Excel::create('Export Data Pegawai', function($excel) use($proses, $spv){
      foreach ($spv as $key) {
        $excel->sheet($key->nama, function($sheet) use ($proses)
        {
          $sheet->fromArray($proses, null, 'A3', true);
          $sheet->mergeCells('A1:M2');
          $sheet->row(1, array('PT. GANDA MADY INDOTAMA - Data Personnel Pegawai '));
          $sheet->row(3, array('NIP','No Rekening','Nama','Departemen', 'Kel Jabatan', 'Jabatan', 'No KTP', 'Tanggal Lahir', 'No KK', 'Alamat', 'No Tlp', 'Jenis Kelamin', 'Tanggal Masuk GMT', 'Tanggal Masuk Client'));
          $sheet->cell('A1:M3', function($cell){
            $cell->setFontSize(12);
            $cell->setFontWeight('bold');
            $cell->setAlignment('center');
            $cell->setValignment('center');
          });
          $sheet->setAllBorders('thin');
          $sheet->setFreeze('A4');
        });
      }
    })->download($type);
  }

}