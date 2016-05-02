<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests\MasterBahasaAsingRequest;
use App\MasterPegawai;
use App\Models\MasterBahasaAsing;
use Datatables;

class MasterBahasaAsingController extends Controller
{
  public function index()
  {
    // return view('pages.tambahbahasaasing');
  }

  public function create()
  {
    $getpegawai = MasterPegawai::all()->where('status', 1);
    $getbahasaasing = DB::table('bahasa_asing')->where('status', '1')->get();
    $data['getbahasaasing'] =$getbahasaasing;

    return view ('pages/tambahbahasaasing')->with('data', $data);
  }

  public function store(MasterBahasaAsingRequest $request)
  {
    $dataNew = new MasterBahasaAsing;
    $dataNew->bahasa = $request->bahasa;
    $dataNew->berbicara = $request->berbicara;
    $dataNew->menulis = $request->menulis;
    $dataNew->mengerti = $request->mengerti;
    $dataNew->id_pegawai = $request->id_pegawai;
    $dataNew->save();

    return redirect()->route('masterbahasaasing.create')->with('message', 'Data bahasa asing berhasil dimasukkan');
  }

  public function edit($id)
  {
    $getbahasaasing = DB::table('bahasa_asing')->where('status', '1');
    $data['getbahasaasing'] =$getbahasaasing;
    $bindbahasaasing = MasterBahasaAsing::find($id);
    $data['bindbahasaasing'] = $bindbahasaasing;

    return view ('pages/tambahbahasaasing')->with('data', $data);
  }

  public function update($id)
  {
    $dataChage = MasterBahasaAsing::find($id);
    $dataChage->bahasa = $request->bahasa;
    $dataChage->berbicara = $request->berbicara;
    $dataChage->menulis = $request->menulis;
    $dataChage->mengerti = $request->mengerti;
    $dataChage->id_pegawai = $request->id_pegawai;
    $dataChage->save();

    return redirect()->route('masterbahasaasing.create')->with('message', 'Data bahasa asing berhasil diubah.');
  }

  public function delete($id)
  {
    $dataOld = MasterBahasaAsing::find($id);
    $dataOld->status = 0;
    $dataOld->save();

    return redirect()->route('masterbahasaasing.create')->with('message', 'Data bahasa asing berhasil dihapus.');
  }

}
