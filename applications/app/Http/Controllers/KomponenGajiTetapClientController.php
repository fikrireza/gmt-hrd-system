<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\KomponenGaji;
use App\Models\KomponenGajiTetap;
use App\Models\DetailKomponenGaji;
use App\Models\MasterClient;
use App\Models\CabangClient;

use Validator;


class KomponenGajiTetapClientController extends Controller
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

    public function index($id)
    {
      
      $getcountCabang = CabangClient::count('*');
      $getcountCabangKom = KomponenGajiTetap::where('id_komponen_gaji', $id)->count('*');
      $getdataKomponenGaji = KomponenGaji::where('id', $id)->first();
      
      $getlistClientNew = CabangClient::leftJoin('master_client', 'cabang_client.id_client', '=', 'master_client.id')
                      ->select('cabang_client.*', 'master_client.id as client_id', 'master_client.kode_client as kode_client', 'master_client.nama_client as nama_client')
                      ->get();

      $getlistClientOld = CabangClient::leftJoin('master_client', 'cabang_client.id_client', '=', 'master_client.id')
                      ->join('komponen_gaji_tetap', 'cabang_client.id', '=', 'komponen_gaji_tetap.id_cabang_client')
                      ->select('cabang_client.*', 'master_client.id as client_id', 'master_client.kode_client as kode_client', 'master_client.nama_client as nama_client', 'komponen_gaji_tetap.id as id_komponen_gaji_tetap'
                        , 'komponen_gaji_tetap.keterangan as keterangan_komponen_gaji_tetap'
                        , 'komponen_gaji_tetap.komgaj_tetap_dibayarkan as komgaj_tetap_dibayarkan'
                        ,'komponen_gaji_tetap.id_komponen_gaji as id_komponen_gaji')
                      ->where('komponen_gaji_tetap.id_komponen_gaji', $id)
                      ->get();
      $getcabangclient = CabangClient::select('*')->get();

      return view('pages/params/kelolakomponengajitetapclient' ,compact('getlistClientOld','getlistClientNew', 
        'getcountCabang', 'getcountCabangKom', 'getdataKomponenGaji','getcabangclient'));
    }

    public function store(Request $request)
    {
      // dd($request);
      $message = [
        'komgaj_tetap_dibayarkan.required' => 'Wajib di isi',
        'keterangan.required' => 'Wajib di isi',
      ];

      $validator = Validator::make($request->all(), [
        'komgaj_tetap_dibayarkan' => 'required',
        'keterangan' => 'required',
      ], $message);

      if($validator->fails())
      {
        return redirect()->route('komgajitetapclient.index', $request->id_komponen_client)->withErrors($validator)->withInput();
      }

      if ($request->idcabangclient != null) {
        foreach ($request->idcabangclient as $id_cabang_client) 
        {
          $set = new KomponenGajiTetap;
          $set->keterangan = $request->keterangan;
          $set->komgaj_tetap_dibayarkan = $request->komgaj_tetap_dibayarkan;
          $set->id_cabang_client = $id_cabang_client;
          $set->id_komponen_gaji = $request->id_komponen_client;
          $set->save();
        }
        return redirect()->route('komgajitetapclient.index', $request->id_komponen_client)->with('message', 'Berhasil memasukkan komponen gaji client.');
      }else{
        return redirect()->route('komgajitetapclient.index', $request->id_komponen_client)->withInput()->with('messagefail', 'Pilih data client tersebuh dahulu.');
      }
    }


    public function bind($id)
    {
      $get = KomponenGajiTetap::find($id);
      return $get;
    }


    public function update(Request $request)
    {
      $set = KomponenGajiTetap::find($request->id);
      $set->keterangan = $request->keterangan_edit;
      $set->komgaj_tetap_dibayarkan = $request->komgaj_tetap_dibayarkan_edit;
      $set->id_cabang_client = $request->id_cabang_client_edit;
      $set->id_komponen_gaji = $request->id_komponen_client_edit;
      $set->save();

      return redirect()->route('komgajitetapclient.index', $request->id_komponen_client_edit)->with('message', 'Data komponen gaji berhasil diubah.');
    }

    public function delete($id1, $id2)
    {
      // dd($id1);
      $set = KomponenGajiTetap::find($id1);
      $set->delete();
      return redirect()->route('komgajitetapclient.index', $id2)->with('message', 'Berhasil menghapus data komponen gaji client.');
    }
}
