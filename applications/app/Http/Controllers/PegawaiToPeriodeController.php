<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\MasterPegawai;
use App\Models\PKWT;
use App\Models\PeriodeGaji;
use App\Models\DetailBatchPayroll;
use App\Models\DetailPeriodeGaji;
use App\Models\MasterClient;
use App\Models\CabangClient;

class PegawaiToPeriodeController extends Controller
{
    public function index() {
      $periodeGaji  = PeriodeGaji::get();
      $getClient  = MasterClient::select('id', 'nama_client')->get();
      $getCabang = CabangClient::select('id','kode_cabang','nama_cabang', 'id_client')->get();


      return view('pages.prosespayroll.pegawaitoperiode', compact('periodeGaji', 'getClient', 'getCabang'));
    }

    public function proses(Request $request)
    {
      // dd($request);
      $idCabangClient = $request->id_client;
      $periodeGaji  = PeriodeGaji::get();
      $getClient  = MasterClient::select('id', 'nama_client')->get();
      $getCabang = CabangClient::select('id','kode_cabang','nama_cabang', 'id_client')->get();

      $pkwtActive = PKWT::join('master_pegawai', 'master_pegawai.id', '=', 'data_pkwt.id_pegawai')
                        ->join('master_pegawai as spv', 'spv.id', '=', 'data_pkwt.id_kelompok_jabatan')
                        ->join('cabang_client', 'cabang_client.id', '=', 'data_pkwt.id_cabang_client')
                        ->join('master_client', 'master_client.id', '=', 'cabang_client.id_client')
                        ->join('master_jabatan', 'master_jabatan.id', '=', 'master_pegawai.id_jabatan')
                        ->select('data_pkwt.*', 'master_pegawai.nama', 'master_pegawai.id as idpegawai', 'spv.nama as spv_nama', 'master_client.nama_client', 'cabang_client.nama_cabang')
                        ->where('status_pkwt', 1)
                        ->where('cabang_client.id', $idCabangClient)
                        ->where('master_pegawai.status', 1)
                        ->where('flag_terminate', 1)
                        ->get();
        // dd($pkwtActive);

      return view('pages.prosespayroll.pegawaitoperiode', compact('periodeGaji','getClient', 'idCabangClient', 'pkwtActive', 'getCabang'));
    }

    public function store(Request $request)
    {
      if ($request->idpegawai != null) {
          $countfailed = 0;
          foreach ($request->idpegawai as $key) {
            $check = DetailPeriodeGaji::where('id_pegawai', $key)->get();

            if(count($check)==0) {
              $set = new DetailPeriodeGaji;
              $set->id_periode_gaji = $request->periodegaji;
              $set->id_pegawai = $key;
              $set->save();
            } else {
              $countfailed++;
            }
          }

          if ($countfailed==0) {
            return redirect()->route('periodepegawai.index')->with('message', 'Berhasil memasukkan seluruh data pegawai ke periode penggajian.');
          } else {
            return redirect()->route('periodepegawai.index')->with('message', 'Berhasil memasukkan data pegawai ke periode penggajian, namun ada beberapa pegawai yang gagal dimasukkan karena telah terdaftar dalam periode penggajian yang lainnya.');
          }
      } else {
          return redirect()->route('periodepegawai.index')->with('gagal', 'Pilih data pegawai tersebuh dahulu.');
      } 
    }

    public function delete($id)
    {
      $get = DetailPeriodeGaji::find($id);
      $get->delete();

      return redirect()->route('periodegaji.detail', $get->id_periode_gaji)->with('message', 'Berhasil menghapus pegawai dari periode.');
    }
}
