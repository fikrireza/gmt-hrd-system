<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Bpjs;
use App\Models\MasterClient;
use App\Models\KomponenGaji;
use App\Models\CabangClient;

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
      $getbpjs = Bpjs::leftJoin('cabang_client', 'management_bpjs.id_cabang_client', '=', 'cabang_client.id')
                        ->leftJoin('komponen_gaji', 'management_bpjs.id_bpjs', '=', 'komponen_gaji.id')
                        ->leftJoin('master_client', 'cabang_client.id_client', '=', 'master_client.id')
                        ->select('management_bpjs.*', 'master_client.id as client_id', 'master_client.kode_client as kode_client', 'master_client.nama_client as nama_client', 'komponen_gaji.id as id_komgaj', 'komponen_gaji.nama_komponen as nama_komponen', 'cabang_client.nama_cabang', 'cabang_client.alamat_cabang')
                        ->paginate(10);

      // $getClient  = MasterClient::get();

      $getClient  = MasterClient::select('id', 'nama_client')->get();
      $getCabang = CabangClient::select('id','kode_cabang','nama_cabang', 'id_client')->get();

      $getKomponentGaji = KomponenGaji::get()->where('id', '>', '9990');
     
      return view('pages/params/kelolabpjs', compact('getbpjs', 'getClient', 'getKomponentGaji', 'getCabang'));
    }

    public function store(Request $request)
    {
      $message = [
        'id_bpjs.required' => 'Wajib di isi',
        'keterangan.required' => 'Wajib di isi',
        'bpjs_dibayarkan.required' => 'Wajib di isi',
        'id_cabang_client.required' => 'Wajib di isi',
      ];

      $validator = Validator::make($request->all(), [
        'id_bpjs' => 'required',
        'keterangan' => 'required',
        'bpjs_dibayarkan' => 'required',
        'id_cabang_client' => 'required',
      ], $message);

      if($validator->fails())
      {
        return redirect()->route('bpjs.index')->withErrors($validator)->withInput();
      }

      $set = new Bpjs;
      $set->id_bpjs = $request->id_bpjs;
      $set->keterangan = $request->keterangan;
      $set->bpjs_dibayarkan = $request->bpjs_dibayarkan;
      $set->id_cabang_client = $request->id_cabang_client;
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
      $dataChage->id_bpjs = $request->id_bpjs_edit;
      $dataChage->keterangan = $request->keterangan_edit;
      $dataChage->bpjs_dibayarkan = $request->bpjs_dibayarkan_edit;
      $dataChage->id_cabang_client = $request->id_cabang_client_edit;
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
