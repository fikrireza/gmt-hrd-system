<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use DB;


use App\Http\Requests;
use App\Http\Requests\MasterPegawaiRequest;
use App\MasterPegawai;
use App\Models\DataKeluarga;
use App\Models\PengalamanKerja;
use App\Models\KondisiKesehatan;

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
      // $getjabatan = MasterJabatan::where('status', 1)->get();
      $getjabatan = MasterJabatan::where('status', '=', '1')->lists('nama_jabatan','id');

      return view('pages/tambahdatapegawai')->with('getjabatan', $getjabatan);
      // return view('pages/tambahdatapegawai');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterPegawaiRequest $request)
    {
      //dd($request->input('data_keluarga.*.nama_keluarga'));
      DB::transaction(function() use($request) {
        $pegawai = MasterPegawai::create([
                      'nip'       => $request->nip,
                      'nip_lama'  => $request->nip_lama,
                      'no_ktp'    => $request->no_ktp,
                      'no_kk'     => $request->no_kk,
                      'no_npwp'   => $request->no_npwp,
                      'nama'      => $request->nama,
                      'tanggal_lahir' => $request->tanggal_lahir,
                      'jenis_kelamin' => $request->jenis_kelamin,
                      'email'     => $request->email,
                      'alamat'    => $request->alamat,
                      'agama'     => $request->agama,
                      'no_telp'   => $request->no_telp,
                      'status_pajak'  => $request->status_pajak,
                      'kewarganegaraan' => $request->kewarganegaraan,
                      'bpjs_kesehatan'  => $request->bpjs_kesehatan,
                      'bpjs_ketenagakerjaan'  => $request->bpjs_ketenagakerjaan,
                      'no_rekening' => $request->no_rekening,
                      'id_jabatan'  => $request->jabatan,
        ]);

        $data_keluarga = array(
                      'nama_keluarga'           => $request->input('data_keluarga.*.nama_keluarga'),
                      'hubungan_keluarga'       => $request->input('data_keluarga.*.hubungan_keluarga'),
                      'tanggal_lahir_keluarga'  => $request->input('data_keluarga.*.tanggal_lahir_keluarga'),
                      'pekerjaan_keluarga'      => $request->input('data_keluarga.*.pekerjaan_keluarga'),
                      'jenis_kelamin_keluarga'  => $request->input('data_keluarga.*.jenis_kelamin_keluarga'),
                      'alamat_keluarga'         => $request->input('data_keluarga.*.alamat_keluarga'),
                      // 'id_pegawai'              => $pegawai->id
        );
        DataKeluarga::insert($data_keluarga);
        dd($data_keluarga);
        //DB::table('data_keluarga')->insert($data_keluarga );

        $pengalaman_kerja = PengalamanKerja::create([

                      'id_pegawai'    => $pegawai->id
        ]);

        $kondisi_kesehatan = KondisiKesehatan::create([
                      'tinggi_badan'  => $request->input('tinggi_badan'),
                      'berat_badan'   => $request->input('berat_badan'),
                      'warna_rambut'  => $request->input('warna_rambut'),
                      'warna_mata'    => $request->input('warna_mata'),
                      'berkacamata'   => $request->input('berkacamata'),
                      'merokok'       => $request->input('merokok'),
                      'id_pegawai'    => $pegawai->id
        ]);

      });

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
