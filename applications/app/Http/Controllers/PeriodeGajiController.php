<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\PeriodeGaji;

class PeriodeGajiController extends Controller
{
  public function index()
  {
    $getperiode = PeriodeGaji::orderby('tanggal')->get();
    return view('pages/kelolaperiodegaji')->with('getperiode', $getperiode);
  }

  public function store(Request $request)
  {
    $set = new PeriodeGaji;
    $set->tanggal = $request->tanggal;
    $set->keterangan = $request->keterangan;
    $set->save();

    return redirect()->route('periodegaji.index')->with('message', 'Berhasil memasukkan periode gaji.');
  }
}
