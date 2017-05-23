<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\MasterPegawai;
use App\Models\PKWT;
use App\Models\MasterClient;
use App\Models\CabangClient;
use App\Models\HistoryGajiPokok;
use App\Models\HistoriGajiPokokPerClient;

use DB;
use Validator;

class HistoryGajiPokokController extends Controller
{
    public function index() {
      $listNew = DB::select("select a.*, b.id as client_id, b.kode_client as kode_client, b.nama_client as nama_client,
		    (select count(1) from data_pkwt d where d.id_cabang_client = a.id) as total_pegawai
        FROM cabang_client a left join master_client b on a.id_client = b.id where exists (select * from data_pkwt c where c.id_cabang_client = a.id)");

      $getlistClientNew = collect($listNew);

      $gethistorygajipokok = HistoryGajiPokok::leftJoin('master_pegawai', 'history_gaji_pokok.id_pegawai', '=', 'master_pegawai.id')
                        ->leftJoin('cabang_client', 'history_gaji_pokok.id_cabang_client', '=', 'cabang_client.id')
                        ->leftJoin('master_client', 'cabang_client.id_client', '=', 'master_client.id')
                        ->select('history_gaji_pokok.*', 'master_pegawai.nip as nip_pegawai', 'master_pegawai.nama as nama_pegawai', 'master_pegawai.tanggal_lahir as tanggal_lahir_pegawai',
                         'master_pegawai.no_telp as no_telp_pegawai', 'master_pegawai.status as status_pegawai',
                         'master_client.id as client_id', 'master_client.kode_client as kode_client', 'master_client.nama_client as nama_client',
                         'cabang_client.nama_cabang', 'cabang_client.alamat_cabang')
                        ->get();
      return view('pages/params/kelolahistorygajipokok', compact('getlistClientNew', 'gethistorygajipokok'));
    }

    public function store(Request $request)
    {
      $message = [
        'gaji_pokok.required' => 'Wajib di isi',
        'keterangan.required' => 'Wajib di isi',
      ];

      $validator = Validator::make($request->all(), [
        'gaji_pokok' => 'required',
        'keterangan' => 'required',
      ], $message);

      if($validator->fails())
      {
        return redirect()->route('historygajipokok.index')->withErrors($validator)->withInput();
      }

      $cabangclient = CabangClient::all();

      if ($request->idcabangclient != null) {

        foreach ($request->idcabangclient as $key1) {

          // SAVE TO HISTORI GAJI POKOK PER CLIENT BY DUDY //
          $idclient = 0;
          foreach ($cabangclient as $cc) {
            if ($cc->id==$key1) {
              $idclient = $cc->id_client;
              break;
            }
          }
          $newrow = new HistoriGajiPokokPerClient;
          $newrow->id_client = $idclient;
          $newrow->id_cabang_client = $key1;
          $newrow->tanggal_penyesuaian = date('Y-m-d');
          $newrow->nilai = $request->gaji_pokok;
          $newrow->save();
          // SAVE TO HISTORI GAJI POKOK PER CLIENT BY DUDY //

          $check = PKWT::where('id_cabang_client', $key1)->get();
            foreach ($check as $key2) {
              $dataChage = MasterPegawai::find($key2->id_pegawai);
              $dataChage->gaji_pokok = $request->gaji_pokok;
              $dataChage->save();
              $checkhistory = HistoryGajiPokok::where('id_pegawai', $key2->id_pegawai)->where('periode_tahun', $request->periode_tahun)->first();
              if ($checkhistory != null) {
                $set = HistoryGajiPokok::where('id_pegawai', $key2->id_pegawai)->where('periode_tahun', $request->periode_tahun)->first();
                $set->gaji_pokok = $request->gaji_pokok;
                $set->periode_tahun = $request->periode_tahun;
                $set->keterangan = $request->keterangan;
                $set->id_pegawai = $key2->id_pegawai;
                $set->id_cabang_client = $key1;
                $set->flag_status = 0;
                $set->save();
              } else {
                $set = new HistoryGajiPokok;
                $set->gaji_pokok = $request->gaji_pokok;
                $set->periode_tahun = $request->periode_tahun;
                $set->keterangan = $request->keterangan;
                $set->id_pegawai = $key2->id_pegawai;
                $set->id_cabang_client = $key1;
                $set->flag_status = 0;
                $set->save();
              }
            }
        }
          return redirect()->route('historygajipokok.index')->with('message', 'Berhasil memasukkan seluruh data history gaji pokok perclient.');
      } else {
          return redirect()->route('historygajipokok.index')->with('gagal', 'Pilih data client tersebuh dahulu.');
      }
    }
}
