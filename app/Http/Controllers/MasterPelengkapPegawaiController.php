<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests;
use App\MasterPegawai;
use App\Models\MasterDataKeluarga;
use App\Models\MasterDataKondisiKesehatan;
use App\Models\MasterDataPendidikan;
use App\Models\MasterBahasaAsing;
use Datatables;
use DB;

class MasterPelengkapPegawaiController extends Controller
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
    $data['getpegawai'] =$getpegawai;

    return view('pages/tambahdatapelengkappegawai')->with('data', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function store(Request $request)
  {
    $dataNewKeluarga = new MasterDataKeluarga;
    $dataNewKeluarga->nama = $request->namakeluarga;
    $dataNewKeluarga->hubungan = $request->hubungan;
    $dataNewKeluarga->tanggal_lahir = $request->tanggal_lahir;
    $dataNewKeluarga->alamat = $request->alamat;
    $dataNewKeluarga->pekerjaan = $request->pekerjaan;
    $dataNewKeluarga->jenis_kelamin = $request->jk;
    $dataNewKeluarga->id_pegawai = $request->id_pegawai;
    $dataNewKeluarga->save();

    $dataNewKondisiKesehatan = new MasterDataKondisiKesehatan;
    $dataNewKondisiKesehatan->tinggi_badan = $request->tinggibadan;
    $dataNewKondisiKesehatan->berat_badan = $request->beratbadan;
    $dataNewKondisiKesehatan->warna_rambut = $request->warnarambut;
    $dataNewKondisiKesehatan->warna_mata = $request->warnamata;
    $dataNewKondisiKesehatan->berkacamata = $request->kacamata;
    $dataNewKondisiKesehatan->merokok = $request->merokok;
    $dataNewKondisiKesehatan->id_pegawai = $request->id_pegawai;
    $dataNewKondisiKesehatan->save();

    $dataNewPendidikan = new MasterDataPendidikan;
    $dataNewPendidikan->jenjang_pendidikan = $request->jenjangpendidikan;
    $dataNewPendidikan->institusi_pendidikan = $request->institusipendidikan;
    $dataNewPendidikan->tahun_masuk = $request->tahunmasuk;
    $dataNewPendidikan->tahun_lulus = $request->tahunlulus;
    $dataNewPendidikan->gelar_akademik = $request->gelarakademik;
    $dataNewPendidikan->id_pegawai = $request->id_pegawai;
    $dataNewPendidikan->save();

    $dataNewBahasaAsing = new MasterBahasaAsing;
    $dataNewBahasaAsing->bahasa = $request->bahasa;
    $dataNewBahasaAsing->berbicara = $request->berbicara;
    $dataNewBahasaAsing->menulis = $request->menulis;
    $dataNewBahasaAsing->mengerti = $request->mengerti;
    $dataNewBahasaAsing->id_pegawai = $request->id_pegawai;
    $dataNewBahasaAsing->save();
    //
    return redirect()->route('masterpelengkappegawai.create')->with('message', 'Data berhasil dimasukkan');
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

   public function show($key)
   {
     dd($key);
     // return view('pages/tambahdatapelengkappegawai')->with('data', $data);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

   public function edit($id)
   {

   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(MasterJabatanEditRequest $request, $id)
   {

   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      //
   }

   public function delete($id)
   {

   }

}
