<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests;
use App\Http\Requests\MasterPegawaiRequest;
use App\MasterPegawai;
use App\MasterJabatan;
use Datatables;

class MasterPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('pages.viewpegawai');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $getjabatan = MasterJabatan::all()->where('status', 1);
      // dd($getjabatan);
      return view('pages/tambahdatapegawai')->with('getjabatan', $getjabatan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterPegawaiRequest $request)
    {
        $pegawai = new MasterPegawai;
        $pegawai->nip = $request->nip;
        $pegawai->nip_lama = $request->nip_lama;
        $pegawai->no_ktp = $request->no_ktp;
        $pegawai->no_kk = $request->no_kk;
        $pegawai->npwp = $request->no_npwp;
        $pegawai->nama = $request->nama;
        $tglexplode = explode("-", $request->tanggal_lahir);
        $tanggal_lahir = $tglexplode[2]."-".$tglexplode[1]."-".$tglexplode[0];
        $pegawai->tanggal_lahir = $tanggal_lahir;
        $pegawai->jenis_kelamin = $request->jk;
        $pegawai->email = $request->email;
        $pegawai->alamat = $request->alamat;
        $pegawai->agama = $request->agama;
        $pegawai->no_telp = $request->no_telp;
        $pegawai->status_pajak = $request->status_pajak;
        $pegawai->kewarganegaraan = $request->kewarganegaraan;
        $pegawai->bpjs_kesehatan = $request->bpjs_kesehatan;
        $pegawai->bpjs_ketenagakerjaan = $request->bpjs_ketenagakerjaan;
        $pegawai->no_rekening = $request->no_rekening;
        $pegawai->id_jabatan = $request->jabatan;
        $pegawai->save();

        return redirect()->route('masterpegawai.create')->with('message','Berhasil memasukkan pegawai baru.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function getDataForDataTable()
    {
      $users = MasterPegawai::select(['nip','nama','jenis_kelamin', 'no_telp', 'nama_jabatan'])
        ->join('master_jabatan','master_pegawai.id_jabatan','=', 'master_jabatan.id')->get();

      return Datatables::of($users)
        ->addColumn('action', function(){
          return "<a href='#' class='btn btn-primary' data-toggle='tooltip' title='Lihat Detail'><i class='fa fa-eye'></i></a>";
        })
        ->editColumn('jenis_kelamin', function($users){
          if($users->jenis_kelamin=="L")
            return "Laki-Laki";
          else
            return "Perempuan";
        })
        ->make();
    }
}
