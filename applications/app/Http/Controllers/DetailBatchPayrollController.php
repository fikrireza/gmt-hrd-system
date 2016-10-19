<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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
}
