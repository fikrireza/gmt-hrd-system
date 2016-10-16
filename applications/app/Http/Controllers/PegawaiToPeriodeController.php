<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\MasterPegawai;
use App\Models\PKWT;
use App\Models\PeriodeGaji;
use App\Models\DetailBatchPayroll;

class PegawaiToPeriodeController extends Controller
{


    public function index() {
      $periodeGaji  = PeriodeGaji::get();

      $pkwtActive = PKWT::join('master_pegawai', 'master_pegawai.id', '=', 'data_pkwt.id_pegawai')
                        ->join('master_pegawai as spv', 'spv.id', '=', 'data_pkwt.id_kelompok_jabatan')
                        ->join('cabang_client', 'cabang_client.id', '=', 'data_pkwt.id_cabang_client')
                        ->join('master_client', 'master_client.id', '=', 'cabang_client.id_client')
                        ->join('master_jabatan', 'master_jabatan.id', '=', 'master_pegawai.id_jabatan')
                        ->select('data_pkwt.*', 'master_pegawai.nama', 'spv.nama as spv_nama', 'master_client.nama_client', 'cabang_client.nama_cabang')
                        ->where('status_pkwt', 1)
                        ->where('flag_terminate', 1)
                        ->get();

      return view('pages.prosespayroll.pegawaitoperiode', compact('periodeGaji', 'pkwtActive'));
    }
}
