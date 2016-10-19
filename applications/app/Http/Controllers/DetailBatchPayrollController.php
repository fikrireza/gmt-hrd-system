<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\MasterPegawai;
use App\Models\DetailKomponenGaji;
use App\Models\DetailBatchPayroll;

class DetailBatchPayrollController extends Controller
{
  public function getdatakomponen($idbatch, $idpegawai)
  {
    $getid = DetailBatchPayroll::select('id')
                        ->where('id_batch_payroll', $idbatch)
                        ->where('id_pegawai', $idpegawai)
                        ->first();

    $getkomponengaji = DetailKomponenGaji::select('detail_komponen_gaji.id as id', 'nama_komponen', 'tipe_komponen', 'nilai')
                        ->join('komponen_gaji', 'komponen_gaji.id', 'detail_komponen_gaji.id_komponen_gaji')
                        ->where('id_detail_batch_payroll', $getid->id)->get();

    return $getkomponengaji;
  }

  public function addtodetailkomponen($idbatch, $idpegawai, $idkomponen, $nilai)
  {
    $getid = DetailBatchPayroll::select('id')
                        ->where('id_batch_payroll', $idbatch)
                        ->where('id_pegawai', $idpegawai)
                        ->first();

    $set = new DetailKomponenGaji;
    $set->id_detail_batch_payroll = $getid->id;
    $set->id_komponen_gaji = $idkomponen;
    $set->nilai = $nilai;
    $set->save();

    $getkomponengaji = DetailKomponenGaji::select('detail_komponen_gaji.id as id', 'nama_komponen', 'tipe_komponen', 'nilai')
                        ->join('komponen_gaji', 'komponen_gaji.id', 'detail_komponen_gaji.id_komponen_gaji')
                        ->where('id_detail_batch_payroll', $getid->id)->get();

    return $getkomponengaji;
  }

  public function cekkomponen($idbatch, $idpegawai)
  {
    $getid = DetailBatchPayroll::select('id')
                  ->where('id_batch_payroll', $idbatch)
                  ->where('id_pegawai', $idpegawai)
                  ->first();

    $cek = DetailKomponenGaji::where('id_detail_batch_payroll', $getid->id)->get();
    return $cek;
  }

  public function getgajipokok($idpegawai)
  {
    $get = MasterPegawai::find($idpegawai);
    return $get->gaji_pokok;
  }
}
