<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\MasterPegawai;
use App\Models\PKWT;
use App\Models\MasterClient;
use App\Models\CabangClient;
use App\Models\PengecualianClient;

use DB;

class PengecualianClientController extends Controller
{
    public function index() {

      $getpengecualianclientold = PengecualianClient::leftJoin('cabang_client', 'pengecualian_client.id_cabang_client', '=', 'cabang_client.id')
                        ->leftJoin('master_client', 'cabang_client.id_client', '=', 'master_client.id')
                        ->select('cabang_client.*', 'master_client.id as client_id', 'master_client.kode_client as kode_client',
                        'master_client.nama_client as nama_client', 'cabang_client.nama_cabang', 'cabang_client.alamat_cabang')
                        ->get();

        $listpengecualiancleintnew = DB::select("select a.*, b.id as client_id, b.kode_client as kode_client, b.nama_client as nama_client FROM cabang_client a
        left join master_client b on a.id_client = b.id where not exists (select * from pengecualian_client c where c.id_cabang_client = a.id)");
        $getpengecualianclientnew = collect($listpengecualiancleintnew);

      return view('pages/params/kelolapengecualianclient', compact('getpengecualianclientold', 'getpengecualianclientnew'));
    }

    public function store(Request $request)
    {
      // dd($request);
      if ($request->idcabangclientnew != null) {
          foreach ($request->idcabangclientnew as $id_cabang_client)
          {
            $set = new PengecualianClient;
            $set->id_cabang_client = $id_cabang_client;
            $set->flag_status = 0;
            $set->save();
          }
          return redirect()->route('pengecualian.client.index')->with('message', 'Berhasil memasukkan seluruh data hari kerja perclient.');
      } else {
          return redirect()->route('pengecualian.client.index')->with('messagefail', 'Pilih data client tersebuh dahulu.');
      }
    }

    public function delete(Request $request)
    {
      // dd($request);
      if ($request->idcabangclientold != null) {
          foreach ($request->idcabangclientold as $id_cabang_client)
          {
            $set = PengecualianClient::where('id_cabang_client', $id_cabang_client)->first();
            $set->id_cabang_client = $request->id_cabang_client;
            $set->delete();
          }
          return redirect()->route('pengecualian.client.index')->with('message', 'Berhasil menghapus seluruh data hari kerja perclient.');
      } else {
          return redirect()->route('pengecualian.client.index')->with('messagefail', 'Pilih data client tersebuh dahulu.');
      }
    }
}
