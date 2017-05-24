<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterClient;
use App\Models\CabangClient;
use App\Models\HistoriGajiPokokPerClient;

class RapelGajiController extends Controller
{
    public function index()
    {
      $getClient  = MasterClient::select('id', 'nama_client')->get();
      $getCabang = CabangClient::select('id','kode_cabang','nama_cabang', 'id_client')->get();


      return view('pages.rapelgaji.rapelgaji')
        ->with('getClient', $getClient)
        ->with('getCabang', $getCabang);
    }

    public function list()
    {
      return view('pages.rapelgaji.listrapelgaji');
    }

    public function detail()
    {
      return view('pages.rapelgaji.detailrapelgaji');
    }

    public function getclienthistory(Request $request)
    {
      $get = HistoriGajiPokokPerClient::where('id_cabang_client', $request->id_cabang_client)->get();
      $getClient  = MasterClient::select('id', 'nama_client')->get();
      $getCabang = CabangClient::select('id','kode_cabang','nama_cabang', 'id_client')->get();
      $getClientByID = CabangClient::select('*', 'cabang_client.id as id_cabang')
        ->join('master_client', 'master_client.id', '=', 'cabang_client.id_client')
        ->where('cabang_client.id', $request->id_cabang_client)
        ->get();

      return view('pages.rapelgaji.rapelgaji')
        ->with('historydata', $get)
        ->with('getClient', $getClient)
        ->with('getClientByID', $getClientByID)
        ->with('getCabang', $getCabang);
    }
}
