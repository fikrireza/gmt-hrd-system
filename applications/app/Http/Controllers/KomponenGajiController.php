<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\KomponenGaji;

class KomponenGajiController extends Controller
{
    public function index()
    {
      $getkomponen = KomponenGaji::paginate(10);
      return view('pages/kelolakomponengaji')->with('getkomponen', $getkomponen);
    }

    public function store(Request $request)
    {
      $set = new KomponenGaji;
      $set->nama_komponen = $request->nama_komponen;
      $set->tipe_komponen = $request->tipe_komponen;
      $set->periode_perhitungan = $request->periode_perhitungan;
      $set->save();

      return redirect()->route('komgaji.index')->with('message', 'Berhasil memasukkan komponen gaji.');
    }
}
