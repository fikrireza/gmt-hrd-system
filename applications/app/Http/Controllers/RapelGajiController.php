<?php

namespace App\Http\Controllers;

use Debugbar;
use App\Models\RapelGaji;
use App\Models\BatchPayroll;
use Illuminate\Http\Request;
use App\Models\MasterClient;
use App\Models\CabangClient;
use App\Models\MasterPegawai;
use App\Models\BatchProcessed;
use App\Models\DetailRapelGaji;
use App\Models\DetailPeriodeGaji;
use App\Models\HistoriGajiPokokPerClient;
use App\Models\HistoryGajiPokok;
use App\Models\PKWT;


class RapelGajiController extends Controller
{
    public function index()
    {
      $getClient  = MasterClient::select('id', 'nama_client')->get();
      $getCabang = CabangClient::select('id','kode_cabang','nama_cabang', 'id_client')->get();


      return view('pages.rapelgaji.rapelgaji')
        ->with('getClient', $getClient)
        ->with('getCabang', $getCabang);
    }

    public function list()
    {
      $get = RapelGaji::select('rapel_gaji.id as id_rapel', 'master_client.nama_client', 'cabang_client.nama_cabang', 'rapel_gaji.tanggal_proses', 'histori_gaji_pokok_per_client.nilai')
        ->join('histori_gaji_pokok_per_client', 'rapel_gaji.id_histori', '=', 'histori_gaji_pokok_per_client.id')
        ->join('cabang_client', 'histori_gaji_pokok_per_client.id_cabang_client', '=', 'cabang_client.id')
        ->join('master_client', 'histori_gaji_pokok_per_client.id_client', '=', 'master_client.id')
        ->get();

      return view('pages.rapelgaji.listrapelgaji')->with('data', $get);
    }

    public function detail()
    {
      $get = DetailRapelGaji::select('nip', 'nama', 'tanggal_proses', 'jml_bulan_selisih', 'nilai_rapel')
        ->join('master_pegawai', 'master_pegawai.id', '=', 'detail_rapel_gaji.id_pegawai')
        ->join('rapel_gaji', 'rapel_gaji.id', '=', 'detail_rapel_gaji.id_rapel_gaji')
        ->get();

      return view('pages.rapelgaji.detailrapelgaji')->with('data', $get);
    }

    public function getclienthistory(Request $request)
    {
      $get = HistoriGajiPokokPerClient::where('id_cabang_client', $request->id_cabang_client)->orderby('id', 'desc')->get();
      $getasc = HistoriGajiPokokPerClient::where('id_cabang_client', $request->id_cabang_client)->orderby('id', 'asc')->get();
      $getClient  = MasterClient::select('id', 'nama_client')->get();
      $getCabang = CabangClient::select('id','kode_cabang','nama_cabang', 'id_client')->get();
      $getClientByID = CabangClient::where('cabang_client.id', $request->id_cabang_client)->get();

      return view('pages.rapelgaji.rapelgaji')
        ->with('historydata', $get)
        ->with('historydataasc', $getasc)
        ->with('getClient', $getClient)
        ->with('getClientByID', $getClientByID)
        ->with('getCabang', $getCabang);
    }

    public function proses($id)
    {
      $get = HistoriGajiPokokPerClient::find($id);
      $date = explode('-', $get->tanggal_penyesuaian);
      $tahunpenyesuaianterakhir = $date[0];

      $get->flag_rapel_gaji = 1;
      $get->save();

      $set = new RapelGaji;
      $set->id_histori = $get->id;
      $set->tanggal_proses = date('Y-m-d');

      if ($set->save()) {
        $getpegawai = PKWT::join('master_pegawai', 'master_pegawai.id', '=', 'data_pkwt.id_pegawai')
          ->where('data_pkwt.id_cabang_client', $get->id_cabang_client)
          ->where('master_pegawai.status', 1)
          ->get();
        $idpegawai = array();
        foreach ($getpegawai as $key) {
          $idpegawai[] = $key->id_pegawai;
        }

        $batchprocessed = BatchProcessed::orderby('id_periode')->orderby('tanggal_proses_payroll', 'desc')->get();
        $gajipegawai = MasterPegawai::select('id', 'gaji_pokok')->get();
        $historigaji = HistoryGajiPokok::orderby('id_pegawai')->orderby('periode_tahun', 'desc')->get();
        $getperiode = DetailPeriodeGaji::all();
        $idpegawai_unique = array_unique($idpegawai);
        foreach ($idpegawai_unique as $uniqueid) {
          foreach ($getperiode as $periode) {
            if ($periode->id_pegawai == $uniqueid) {
              $pegawaiperiode = $periode->id_periode_gaji;
              foreach ($batchprocessed as $bp) {
                if ($bp->id_periode == $pegawaiperiode) {
                  $terakhirgajian = $bp->tanggal_proses_payroll;
                  $exp = explode('-', $terakhirgajian);
                  $bulanterakhirgajian = $exp[1];

                  $gajisekarang = 0;
                  foreach ($gajipegawai as $gp) {
                    if ($gp->id == $uniqueid) {
                      $gajisekarang = $gp->gaji_pokok;
                      break;
                    }
                  }
                  $gajisebelumnya = 0;
                  foreach ($historigaji as $hg) {
                    if ($hg->id_pegawai == $uniqueid && $hg->periode_tahun == $tahunpenyesuaianterakhir-1) {
                      $gajisebelumnya = $hg->gaji_pokok;
                      break;
                    }
                  }

                  $selisih = $gajisekarang - $gajisebelumnya;
                  $nilairapel = $selisih * $bulanterakhirgajian;

                  $setrapel = new DetailRapelGaji;
                  $setrapel->id_pegawai = $uniqueid;
                  $setrapel->id_rapel_gaji = $set->id;
                  $setrapel->jml_bulan_selisih = $bulanterakhirgajian;
                  $setrapel->nilai_rapel = $nilairapel;
                  $setrapel->save();

                  break;
                }
              }
              break;
            }
          }
        }
      }

      return redirect()->route('rapelgaji.list')->with('message', 'Berhasil memproses rapel gaji.');
    }
}
