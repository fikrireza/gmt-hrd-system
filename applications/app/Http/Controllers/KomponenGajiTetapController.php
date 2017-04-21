<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\KomponenGajiTetap;
use App\Models\KomponenGaji;
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
      $getkomponentetap = KomponenGajiTetap::leftJoin('cabang_client', 'komponen_gaji_tetap.id_cabang_client', '=', 'cabang_client.id')->leftJoin('master_client', 'cabang_client.id_client', '=', 'master_client.id')
                        ->leftJoin('komponen_gaji', 'komponen_gaji_tetap.id_komponen_gaji', '=', 'komponen_gaji.id')
                        ->select('komponen_gaji_tetap.*', 'master_client.id as client_id', 'master_client.kode_client as kode_client', 'master_client.nama_client as nama_client', 'cabang_client.nama_cabang', 'cabang_client.alamat_cabang', 'komponen_gaji.id as id_komponen', 'komponen_gaji.nama_komponen', 'komponen_gaji.tipe_komponen')->paginate(10);

      $getClient  = MasterClient::select('id', 'nama_client')->get();
      $getKomponen  = KomponenGaji::select('*')->where('tipe_komponen_gaji','=', '0')->get();
      // dd($getKomponen);
      $getCabang = CabangClient::select('id','kode_cabang','nama_cabang', 'id_client')->get();


      return view('pages/params/kelolakomponengajitetap', compact('getkomponentetap', 'getClient', 'getCabang', 'getKomponen'));
    }

    public function store(Request $request)
    {
      $message = [
        'keterangan.required' => 'Wajib di isi',
        'komgaj_tetap_dibayarkan.required' => 'Wajib di isi',
        'id_cabang_client.required' => 'Wajib di isi',
        'id_komponen_gaji.required' => 'Wajib di isi',
      ];

      $validator = Validator::make($request->all(), [
        'keterangan' => 'required',
        'komgaj_tetap_dibayarkan' => 'required',
        'id_cabang_client' => 'required',
        'id_komponen_gaji' => 'required',
      ], $message);

      if($validator->fails())
      {
        return redirect()->route('komgajitetap.index')->withErrors($validator)->withInput();
      }

      $set = new KomponenGajiTetap;
      $set->keterangan = $request->keterangan;
      $set->komgaj_tetap_dibayarkan = $request->komgaj_tetap_dibayarkan;
      $set->id_cabang_client = $request->id_cabang_client;
      $set->id_komponen_gaji = $request->id_komponen_gaji;
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
      $dataChage->keterangan = $request->keterangan_edit;
      $dataChage->komgaj_tetap_dibayarkan = $request->komgaj_tetap_dibayarkan_edit;
      $dataChage->id_cabang_client = $request->id_cabang_client_edit;
      $dataChage->id_komponen_gaji = $request->id_komponen_gaji_edit;
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
