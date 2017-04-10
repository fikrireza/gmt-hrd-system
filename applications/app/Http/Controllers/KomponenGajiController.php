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
      $set->tipe_komponen_gaji = $request->tipe_komponen_gaji;
      $set->save();

      return redirect()->route('komgaji.index')->with('message', 'Berhasil memasukkan komponen gaji.');
    }

    public function update_nilai($id, $nilai) {
      $set = DetailKomponenGaji::find($id);
      $set->nilai = $nilai;
      $set->save();
    }
}
