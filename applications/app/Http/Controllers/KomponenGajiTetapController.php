<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\KomponenGajiTetap;
use App\Models\DetailKomponenGaji;
use App\Models\MasterClient;

use Validator;


class KomponenGajiTetapController extends Controller
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
      $getkomponentetap = KomponenGajiTetap::leftJoin('master_client', 'komponen_gaji_tetap.id_client', '=', 'master_client.id')
                        ->select('komponen_gaji_tetap.*', 'master_client.id as client_id', 'master_client.kode_client as kode_client', 'master_client.nama_client as nama_client')->paginate(10);
      // dd($getkomponentetap);
      $getClient  = MasterClient::get();
      return view('pages/params/kelolakomponengajitetap', compact('getkomponentetap', 'getClient'));
    }

    public function store(Request $request)
    {
      $message = [
        'nama_komponen.required' => 'Wajib di isi',
        'tipe_komponen.required' => 'Wajib di isi',
        'periode_perhitungan.required' => 'Wajib di isi',
        'keterangan.required' => 'Wajib di isi',
        'komgaj_tetap_dibayarkan.required' => 'Wajib di isi',
        'id_client.required' => 'Wajib di isi',
      ];

      $validator = Validator::make($request->all(), [
        'nama_komponen' => 'required',
        'tipe_komponen' => 'required',
        'periode_perhitungan' => 'required',
        'keterangan' => 'required',
        'komgaj_tetap_dibayarkan' => 'required',
        'id_client' => 'required',
      ], $message);

      if($validator->fails())
      {
        return redirect()->route('komgajitetap.index')->withErrors($validator)->withInput();
      }

      $set = new KomponenGajiTetap;
      $set->nama_komponen = $request->nama_komponen;
      $set->tipe_komponen = $request->tipe_komponen;
      $set->periode_perhitungan = $request->periode_perhitungan;
      $set->keterangan = $request->keterangan;
      $set->komgaj_tetap_dibayarkan = $request->komgaj_tetap_dibayarkan;
      $set->id_client = $request->id_client;
      $set->save();

      return redirect()->route('komgajitetap.index')->with('message', 'Berhasil memasukkan komponen gaji tetap.');
    }

    public function bind($id)
    {
      $get = KomponenGajiTetap::find($id);
      return $get;
    }

    public function update(Request $request)
    {
      // dd($request);
      $dataChage = KomponenGajiTetap::find($request->id);
      $dataChage->nama_komponen = $request->nama_komponen_edit;
      $dataChage->tipe_komponen = $request->tipe_komponen_edit;
      $dataChage->periode_perhitungan = $request->periode_perhitungan_edit;
      $dataChage->keterangan = $request->keterangan_edit;
      $dataChage->komgaj_tetap_dibayarkan = $request->komgaj_tetap_dibayarkan_edit;
      $dataChage->id_client = $request->id_client_edit;
      $dataChage->save();

      return redirect()->route('komgajitetap.index')->with('message', 'Data komponen gaji berhasil diubah.');
    }

    public function delete($id)
    {
      $set = KomponenGajiTetap::find($id);
      $set->delete();
      return redirect()->route('komgajitetap.index')->with('message', 'Berhasil menghapus data komponen gaji tetap.');
    }
}
