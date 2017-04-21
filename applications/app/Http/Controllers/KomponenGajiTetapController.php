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
      $getkomponen = KomponenGaji::where('tipe_komponen_gaji', '=', 0)->paginate(10);
      $getlistClientNew = CabangClient::leftJoin('master_client', 'cabang_client.id_client', '=', 'master_client.id')
                      ->select('cabang_client.*', 'master_client.id as client_id', 'master_client.kode_client as kode_client', 'master_client.nama_client as nama_client')->get();

      return view('pages/params/kelolakomponengajitetap' ,compact('getkomponen', 'getlistClientNew'));
    }

    public function store(Request $request)
    {
      $message = [
        'nama_komponen.required' => 'Wajib di isi',
        'tipe_komponen.required' => 'Wajib di isi',
        'periode_perhitungan.required' => 'Wajib di isi',
        // 'tipe_komponen_gaji.required' => 'Wajib di isi',
      ];

      $validator = Validator::make($request->all(), [
        'nama_komponen' => 'required',
        'tipe_komponen' => 'required',
        'periode_perhitungan' => 'required',
        // 'tipe_komponen_gaji' => 'required',
      ], $message);

      if($validator->fails())
      {
        return redirect()->route('komgajitetap.index')->withErrors($validator)->withInput();
      }

      $set = new KomponenGaji;
      $set->nama_komponen = $request->nama_komponen;
      $set->tipe_komponen = $request->tipe_komponen;
      $set->periode_perhitungan = $request->periode_perhitungan;
      $set->tipe_komponen_gaji = 0;
      $set->save();

      return redirect()->route('komgajitetap.index')->with('message', 'Berhasil memasukkan komponen gaji variabel.');
    }


    public function storeclient(Request $request)
    {
      if ($request->idcabangclient != null) {
        foreach ($request->idcabangclient as $id_cabang_client) 
        {
          $set = new KomponenGajiTetap;
          $set->keterangan = $request->keterangan_edit;
          $set->komgaj_tetap_dibayarkan = $request->komgaj_tetap_dibayarkan_edit;
          $set->id_cabang_client = $id_cabang_client;
          $set->id_komponen_gaji = $request->id_komponen_client;
          $set->save();
        }
        return redirect()->route('komgajitetap.index')->with('message', 'Berhasil memasukkan komponen gaji variabel.');
      }else{
        return redirect()->route('komgajitetap.index')->withInput()->with('messagefail', 'Pilih data client tersebuh dahulu.');
      }
    }

    public function update_nilai($id, $nilai) {
      $set = DetailKomponenGaji::find($id);
      $set->nilai = $nilai;
      $set->save();
    }

    public function bind($id)
    {
      $get = KomponenGaji::find($id);
      return $get;
    }

    public function bindclient($id)
    {
      $getlistClientOld = CabangClient::leftJoin('master_client', 'cabang_client.id_client', '=', 'master_client.id')
                      ->join('komponen_gaji_tetap', 'cabang_client.id', '=', 'komponen_gaji_tetap.id_cabang_client')
                      ->select('cabang_client.*', 'master_client.id as client_id', 'master_client.kode_client as kode_client', 'master_client.nama_client as nama_client')
                      ->where('komponen_gaji_tetap.id_komponen_gaji', $id)
                      ->paginate(10);
      return $getlistClientOld;
    }

    public function update(Request $request)
    {
      $dataChage = KomponenGaji::find($request->id);
      $dataChage->nama_komponen = $request->nama_komponen_edit;
      $dataChage->tipe_komponen = $request->tipe_komponen_edit;
      $dataChage->periode_perhitungan = $request->periode_perhitungan_edit;
      $dataChage->tipe_komponen_gaji = 0;
      $dataChage->save();

      return redirect()->route('komgajitetap.index')->with('message', 'Data komponen gaji berhasil diubah.');
    }

    public function delete($id)
    {
      $check = DetailKomponenGaji::where('id_komponen_gaji', $id)->first();
      if($check=="") {
        $set = KomponenGaji::find($id);
        $set->delete();
        return redirect()->route('komgajitetap.index')->with('message', 'Berhasil menghapus data komponen gaji variabel.');
      } else {
        return redirect()->route('komgajitetap.index')->with('messagefail', 'Gagal melakukan hapus data. Data telah memiliki relasi dengan data yang lain.');
      }
    }
}
