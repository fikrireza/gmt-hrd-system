<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterClient;
use App\Models\CabangClient;

class RapelGajiController extends Controller
{
    public function index()
    {
      $getClient  = MasterClient::select('id', 'nama_client')->get();
      $getCabang = CabangClient::select('id','kode_cabang','nama_cabang', 'id_client')->get();


      return view('pages.rapelgaji')
        ->with('getClient', $getClient)
        ->with('getCabang', $getCabang);
    }
}
