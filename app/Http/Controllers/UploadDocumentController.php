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

    $imageKK = $request->upload_kk . '.' .
    $request->file('upload_kk')->getClientOriginalExtension();
    $request->file('upload_kk')->move(base_path() . '/public/images/kk/', $imageKK);

    $imageKTP = $request->upload_ktp . '.' .
    $request->file('upload_ktp')->getClientOriginalExtension();
    $request->file('upload_ktp')->move(base_path() . '/public/images/ktp/', $imageKTP);

    $imageIjazah = $request->upload_ijazah . '.' .
    $request->file('upload_ijazah')->getClientOriginalExtension();
    $request->file('upload_ijazah')->move(base_path() . '/public/images/ijazah/', $imageIjazah);

    $imageFoto = $request->upload_foto . '.' .
    $request->file('upload_foto')->getClientOriginalExtension();
    $request->file('upload_foto')->move(base_path() . '/public/images/foto/', $imageFoto);

    $dataNew->save();

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

  public function show($id)
  {
      //
  }

  public function destroy($id)
  {
      //
  }

  public function hapusDocument($id)
  {
    dd("asdasdasd");
  }

}
