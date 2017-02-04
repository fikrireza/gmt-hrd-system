<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\KomponenGaji;
use App\Models\DetailKomponenGaji;


class KomponenGajiController extends Controller
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
      $getkomponen = KomponenGaji::paginate(10);
      return view('pages/params/kelolakomponengaji')->with('getkomponen', $getkomponen);
    }

    public function store(Request $request)
    {
    
      $set = new KomponenGaji;
      $set->nama_komponen = $request->nama_komponen;
      $set->tipe_komponen = $request->tipe_komponen;
      $set->periode_perhitungan = $request->periode_perhitungan;
      $set->flag_status = $request->flag_status;
      $set->save();

      return redirect()->route('komgaji.index')->with('message', 'Berhasil memasukkan komponen gaji.');
    }

    public function bind($id)
    {
      $get = KomponenGaji::find($id); 
      return $get;
    }

    public function update(Request $request)
    {
      // dd($request);
      $message = [
        'nama_komponen.required' => 'Wajib di isi',
        'tipe_komponen.required' => 'Wajib di isi',
        'periode_perhitungan.required' => 'Wajib di isi',
        'flag_status.required' => 'Wajib di isi',
      ];

      $validator = Validator::make($request->all(), [
        'nama_komponen' => 'required',
        'tipe_komponen' => 'required',
        'periode_perhitungan' => 'required',
        'flag_status' => 'required',
      ], $message);

      $dataChage = KomponenGaji::find($request->id);
      $dataChage->nama_komponen = $request->nama_komponen;
      $dataChage->tipe_komponen = $request->tipe_komponen;
      $dataChage->periode_perhitungan = $request->periode_perhitungan;
      $dataChage->flag_status = $request->flag_status;
      $dataChage->save();

      return redirect()->route('komgaji.index')->with('message', 'Data komponen gaji berhasil diubah.');
    }

    public function delete($id)
    {
      $check = DetailKomponenGaji::where('id_komponen_gaji', $id)->first();
      if($check=="") {
        $set = KomponenGaji::find($id);
        $set->delete();
        return redirect()->route('komgaji.index')->with('message', 'Berhasil menghapus data komponen gaji.');
      } else {
        return redirect()->route('komgaji.index')->with('messagefail', 'Gagal melakukan hapus data. Data telah memiliki relasi dengan data yang lain.');
      }
    }

}
