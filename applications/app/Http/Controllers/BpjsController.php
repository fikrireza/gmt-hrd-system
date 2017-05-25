<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Bpjs;
use App\Models\MasterClient;
use App\Models\KomponenGaji;
use App\Models\CabangClient;

use Validator;
use DB;

class BpjsController extends Controller
{
    /**
    * Authentication controller.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
      $getbpjskesehatan = Bpjs::leftJoin('cabang_client', 'management_bpjs.id_cabang_client', '=', 'cabang_client.id')
                        ->leftJoin('komponen_gaji', 'management_bpjs.id_bpjs', '=', 'komponen_gaji.id')
                        ->leftJoin('master_client', 'cabang_client.id_client', '=', 'master_client.id')
                        ->select('management_bpjs.*', 'master_client.id as client_id', 'master_client.kode_client as kode_client', 'master_client.nama_client as nama_client', 'komponen_gaji.id as id_komgaj', 'komponen_gaji.nama_komponen as nama_komponen', 'cabang_client.nama_cabang', 'cabang_client.alamat_cabang')
                        ->where('id_bpjs', '9991')
                        ->get();

      $getbpjsketenagakerjaan = Bpjs::leftJoin('cabang_client', 'management_bpjs.id_cabang_client', '=', 'cabang_client.id')
                        ->leftJoin('komponen_gaji', 'management_bpjs.id_bpjs', '=', 'komponen_gaji.id')
                        ->leftJoin('master_client', 'cabang_client.id_client', '=', 'master_client.id')
                        ->select('management_bpjs.*', 'master_client.id as client_id', 'master_client.kode_client as kode_client', 'master_client.nama_client as nama_client', 'komponen_gaji.id as id_komgaj', 'komponen_gaji.nama_komponen as nama_komponen', 'cabang_client.nama_cabang', 'cabang_client.alamat_cabang')
                        ->where('id_bpjs', '9992')
                        ->get();

      $getbpjspensiun = Bpjs::leftJoin('cabang_client', 'management_bpjs.id_cabang_client', '=', 'cabang_client.id')
                        ->leftJoin('komponen_gaji', 'management_bpjs.id_bpjs', '=', 'komponen_gaji.id')
                        ->leftJoin('master_client', 'cabang_client.id_client', '=', 'master_client.id')
                        ->select('management_bpjs.*', 'master_client.id as client_id', 'master_client.kode_client as kode_client', 'master_client.nama_client as nama_client', 'komponen_gaji.id as id_komgaj', 'komponen_gaji.nama_komponen as nama_komponen', 'cabang_client.nama_cabang', 'cabang_client.alamat_cabang')
                        ->where('id_bpjs', '9993')
                        ->get();

      $listKesehatanNew = DB::select("select a.*, b.id as client_id, b.kode_client as kode_client, b.nama_client as nama_client FROM cabang_client a left join master_client b on a.id_client = b.id where not exists (select * from management_bpjs c where c.id_cabang_client = a.id and c.id_bpjs = 9991)");
      $getlistBPJSKesehatanNew = collect($listKesehatanNew);

      $listKetenagakerjaanNew = DB::select("select a.*, b.id as client_id, b.kode_client as kode_client, b.nama_client as nama_client FROM cabang_client a left join master_client b on a.id_client = b.id where not exists (select * from management_bpjs c where c.id_cabang_client = a.id and c.id_bpjs = 9992)");
      $getlistBPJSKetenagakerjaanNew = collect($listKetenagakerjaanNew);

      $listPensiunNew = DB::select("select a.*, b.id as client_id, b.kode_client as kode_client, b.nama_client as nama_client FROM cabang_client a left join master_client b on a.id_client = b.id where not exists (select * from management_bpjs c where c.id_cabang_client = a.id and c.id_bpjs = 9993)");
      $getlistBPJSPensiunNew = collect($listPensiunNew);

      $getbpjscountkesehatan = Bpjs::select('*')->where('id_bpjs', '9991')->count('id');
      $getbpjscountketenagakerjaan = Bpjs::select('*')->where('id_bpjs', '9992')->count('id');
      $getbpjscountpensiun = Bpjs::select('*')->where('id_bpjs', '9993')->count('id');

      $getClient  = MasterClient::select('id', 'nama_client')->get();
      $getCabang = CabangClient::select('id','kode_cabang','nama_cabang', 'id_client')->get();

      $getKomponentGaji = KomponenGaji::where(function($query) {
                return $query->where('id', '=', '9991')
                    ->orWhere('id', '=', '9992')
                    ->orWhere('id', '=', '9993');
            })->get();

      return view('pages/params/kelolabpjs', compact('getbpjskesehatan', 'getbpjsketenagakerjaan', 'getbpjspensiun',
        'getClient', 'getKomponentGaji', 'getCabang',
        'getbpjscountkesehatan', 'getbpjscountketenagakerjaan', 'getbpjscountpensiun',
        'getlistBPJSKesehatanNew', 'getlistBPJSKetenagakerjaanNew', 'getlistBPJSPensiunNew'));
    }

    public function store(Request $request)
    {
      // $message = [
      //   'id_bpjs.required' => 'Wajib di isi',
      //   'keterangan.required' => 'Wajib di isi',
      //   'bpjs_dibayarkan.required' => 'Wajib di isi',
      // ];

      // $validator = Validator::make($request->all(), [
      //   'id_bpjs' => 'required',
      //   'keterangan' => 'required',
      //   'bpjs_dibayarkan' => 'required',
      // ], $message);

      // if($validator->fails())
      // {
      //   return redirect()->route('bpjs.index')->withErrors($validator)->withInput();
      // }

      if ($request->idcabangclient != null) {
        foreach ($request->idcabangclient as $id_cabang_client)
        {
          $set = new Bpjs;
          $set->id_bpjs = $request->status_flag_bpjs;
          $set->keterangan = $request->keterangan;
          $set->bpjs_dibayarkan = $request->bpjs_dibayarkan;
          $set->id_cabang_client = $id_cabang_client;
          $set->save();
        }
        return redirect()->route('bpjs.index')->with('message', 'Berhasil memasukkan bpjs.');
      }else{
        return redirect()->route('bpjs.index')->with('messagefail', 'Pilih data client tersebuh dahulu.');
      }

    }

    public function bind($id)
    {
      $get = Bpjs::find($id);
      return $get;
    }

    public function update(Request $request)
    {
      // dd($request);
      $dataChage = Bpjs::find($request->id);
      // $dataChage->id_bpjs = $request->id_bpjs_edit;
      $dataChage->keterangan = $request->keterangan_edit;
      $dataChage->bpjs_dibayarkan = $request->bpjs_dibayarkan_edit;
      // $dataChage->id_cabang_client = $request->id_cabang_client_edit;
      $dataChage->save();

      return redirect()->route('bpjs.index')->with('message', 'Data bpjs berhasil diubah.');
    }

    public function delete($id)
    {
      $set = Bpjs::find($id);
      $set->delete();
      return redirect()->route('bpjs.index')->with('message', 'Berhasil menghapus data bpjs.');
    }

}
