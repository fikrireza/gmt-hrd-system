<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests;
use App\MasterPegawai;
use App\Models\UploadDocument;
use App\MasterJabatan;
use Datatables;
use DB;

class UploadDocumentController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // return view('pages.tambahbahasaasing');
  }

  public function create()
  {

    $getpegawai = MasterPegawai::where('status', 1)->get();
    $data['getpegawai'] = $getpegawai;
    $getdocument = UploadDocument::where('id_pegawai', 1)->get();
    $data['getdocument'] = $getdocument;
    return view('pages/uploaddocument')->with('data', $data);
  }

  public function store(Request $request)
  {
    $dataNew = new UploadDocument;
    // $dataNew->id = $request->id;
    $dataNew->upload_kk = $request->upload_kk;
    $dataNew->upload_ktp = $request->upload_ktp;
    $dataNew->upload_ijazah = $request->upload_ijazah;
    $dataNew->upload_foto = $request->upload_foto;
    $dataNew->id_pegawai = $request->nip;
    // dd($dataNew);
    // $dataNew->save();

    $destinationPath = '/public/images/kk/'; // upload path
    $extension = $request("upload_kk")->getClientOriginalExtension(); // getting image extension
    $fileName = rand(11111,99999).'.'.$extension; // renameing image
    $request->file('image')->move(
        base_path() . $destinationPath, $imageName
    );
    Input::file('upload_kk')->move($destinationPath, $fileName); // uploading file to given path

    return redirect()->route('uploaddocument.create')->with('message', 'Dokument Pegawai berhasil dimasukkan');

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
