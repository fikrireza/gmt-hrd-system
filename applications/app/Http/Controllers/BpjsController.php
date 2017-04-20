<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Bpjs;
use App\Models\MasterClient;
use App\Models\CabangClient;
use App\Models\KomponenGaji;

use Validator;

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
      $getbpjs = Bpjs::
        select('nama_client', 'nama_cabang', 'nama_komponen', 'management_bpjs.bpjs_dibayarkan')
        ->join('cabang_client', 'management_bpjs.id_cabang_client', '=', 'cabang_client.id')
        ->join('master_client', 'master_client.id', '=', 'cabang_client.id_client')
        ->join('komponen_gaji', 'management_bpjs.id_bpjs', '=', 'komponen_gaji.id')
        ->paginate(10);

      $getbpjsitem = KomponenGaji::where('id', 'like', '999%')->get();

      $getClient  = CabangClient::
        select('cabang_client.id as id_cabang', 'cabang_client.kode_cabang', 'master_client.nama_client', 'cabang_client.nama_cabang')
        ->join('master_client', 'cabang_client.id_client', '=', 'master_client.id')
        ->get();

      return view('pages/params/kelolabpjs', compact('getbpjs', 'getClient', 'getbpjsitem'));
    }

    public function store(Request $request)
    {
      $message = [
        'tipe_bpjs.required' => 'Wajib di isi',
        'keterangan.required' => 'Wajib di isi',
        'bpjs_dibayarkan.required' => 'Wajib di isi',
        'id_client.required' => 'Wajib di isi',
      ];

      $validator = Validator::make($request->all(), [
        'tipe_bpjs' => 'required',
        'keterangan' => 'required',
        'bpjs_dibayarkan' => 'required',
        'id_client' => 'required',
      ], $message);

      if($validator->fails())
      {
        return redirect()->route('bpjs.index')->withErrors($validator)->withInput();
      }

      $set = new Bpjs;
      $set->id_bpjs = $request->tipe_bpjs;
      $set->keterangan = $request->keterangan;
      $set->bpjs_dibayarkan = $request->bpjs_dibayarkan;
      $set->id_cabang_client = $request->id_client;
      $set->save();

      return redirect()->route('bpjs.index')->with('message', 'Berhasil memasukkan hari bpjs.');
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
      $dataChage->tipe_bpjs = $request->tipe_bpjs_edit;
      $dataChage->keterangan = $request->keterangan_edit;
      $dataChage->bpjs_dibayarkan = $request->bpjs_dibayarkan_edit;
      $dataChage->id_client = $request->id_client_edit;
      $dataChage->save();

      return redirect()->route('bpjs.index')->with('message', 'Data bpjs berhasil diubah.');
    }

    public function delete($id)
    {
      $set = Bpjs::find($id);
      $set->delete();
      return redirect()->route('bpjs.index')->with('message', 'Berhasil menghapus data hari bpjs.');
    }

}
