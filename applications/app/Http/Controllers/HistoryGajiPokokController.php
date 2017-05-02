<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\MasterPegawai;
use App\Models\PKWT;
use App\Models\MasterClient;
use App\Models\CabangClient;

use DB;

class HistoryGajiPokokController extends Controller
{
    public function index() {
      $listNew = DB::select("select a.*, b.id as client_id, b.kode_client as kode_client, b.nama_client as nama_client
      FROM cabang_client a left join master_client b on a.id_client = b.id where exists (select * from data_pkwt c where c.id_cabang_client = a.id)");

      $getlistClientNew = collect($listNew);
      // dd($getlistClientNew);
      return view('pages/params/kelolahistorygajipokok', compact('getlistClientNew'));
    }

    public function store(Request $request)
    {
      if ($request->idcabangclient != null) {
        foreach ($request->idcabangclient as $key1) {
          $check = PKWT::where('id_cabang_client', $key1)->get();
            foreach ($check as $key2) {
              $dataChage = MasterPegawai::find($key2->id_pegawai);
              $dataChage->gaji_pokok = $request->gaji_pokok;
              $dataChage->save();
            }
        }
          return redirect()->route('historygajipokok.index')->with('message', 'Berhasil memasukkan seluruh data history gaji pokok perclient.');
      } else {
          return redirect()->route('historygajipokok.index')->with('gagal', 'Pilih data client tersebuh dahulu.');
      }
    }
}
