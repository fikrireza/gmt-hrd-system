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
    $i = 0;
    foreach ($request->nama_dokumen as $key) {
      $file = $request->file_dokumen[$i];
      $file_name = time(). '.' . $file->getClientOriginalExtension();
      $file->move('documents', $file_name);

      $set = new uploaddocument;
      $set->id_pegawai = $request->id_pegawai;
      $set->nama_dokumen = $request->nama_dokumen[$i];
      $set->file_dokumen = $file_name;
      $set->save();

      $i++;
    }

    return redirect()->route('uploaddocument.create')->with('message', "Berhasil menyimpan dokumen pegawai.");
  }

  public function edit($id)
  {
      //
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

  public function getDocforDataTables()
  {
    $dokumen = UploadDocument::select(['dokumen_pegawai.id as id_doc','nip','nama','nama_dokumen', 'file_dokumen', 'dokumen_pegawai.created_at as tanggal_upload'])
      ->join('master_pegawai','dokumen_pegawai.id_pegawai','=', 'master_pegawai.id')->get();

    return Datatables::of($dokumen)
      ->editColumn('file_dokumen', function($dokumen){
        return '<a href='.url('documents').'/'.$dokumen->file_dokumen.' download>'.$dokumen->file_dokumen.'</a>';
      })
      ->addColumn('action', function($dokumen){
        return '<span data-toggle="tooltip" title="Hapus Data"><a href="#" class="btn btn-xs btn-danger hapusdoc" data-value="'.$dokumen->id_doc.'" data-toggle="modal" data-target="#modalDelete"><i class="fa fa-remove" ></i></a></span> <span data-toggle="tooltip" title="Edit Data"><a href="#" class="btn btn-xs btn-warning editdoc" data-value="'.$dokumen->id_doc.'" data-toggle="modal" data-target="#modalEdit"><i class="fa fa-edit"></i></a></span>';
      })
      ->removeColumn('id_doc')
      ->make();
  }

  public function show($id)
  {
      //
  }

  public function destroy($id)
  {
      //
  }

  public function hapusDokumen($id)
  {
      $dokumen = UploadDocument::find($id);
      $dokumen->delete();

      return redirect()->route('uploaddocument.create')->with('message','Berhasil menghapus dokumen pegawai.');
  }

  public function bindData($id)
  {
      $dokumen = UploadDocument::find($id);

      return $dokumen;
  }
}
