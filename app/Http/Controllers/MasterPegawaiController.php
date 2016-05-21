<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use DB;

use App\Http\Requests;
use App\Http\Requests\MasterPegawaiRequest;
use App\MasterPegawai;
use App\Models\DataKeluarga;
use App\Models\KondisiKesehatan;
use App\Models\PengalamanKerja;
use App\Models\Pendidikan;
use App\Models\BahasaAsing;
use App\Models\KeahlianKomputer;
use App\Models\RiwayatPenyakit;

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
      //$getjabatan = MasterJabatan::where('status', 1)->get();
      $getjabatan = MasterJabatan::where('status', '=', '1')->lists('nama_jabatan','id');

      return view('pages/MasterPegawai/tambahdatapegawai')->with('getjabatan', $getjabatan);
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
      //dd($request);
      DB::transaction(function() use($request) {
        $pegawai = MasterPegawai::create([
                      'nip'           => $request->nip,
                      'nip_lama'      => $request->nip_lama,
                      'no_ktp'        => $request->no_ktp,
                      'no_kk'         => $request->no_kk,
                      'no_npwp'       => $request->no_npwp,
                      'nama'          => $request->nama,
                      'tanggal_lahir' => $request->tanggal_lahir,
                      'jenis_kelamin' => $request->jenis_kelamin,
                      'email'         => $request->email,
                      'alamat'        => $request->alamat,
                      'agama'         => $request->agama,
                      'status_kontrak'=> $request->status_kontrak,
                      'no_telp'       => $request->no_telp,
                      'status_pajak'  => $request->status_pajak,
                      'kewarganegaraan' => $request->kewarganegaraan,
                      'bpjs_kesehatan'  => $request->bpjs_kesehatan,
                      'bpjs_ketenagakerjaan'  => $request->bpjs_ketenagakerjaan,
                      'no_rekening'   => $request->no_rekening,
                      'id_jabatan'     => $request->jabatan,
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

        $keluargas = $request->input('data_keluarga');
        if($keluargas == !null){
          foreach($keluargas as $keluarga){
            $isiKeluarga = new DataKeluarga;
            $isiKeluarga->nama_keluarga           = $keluarga['nama_keluarga'];
            $isiKeluarga->hubungan_keluarga       = $keluarga['hubungan_keluarga'];
            $isiKeluarga->tanggal_lahir_keluarga  = $keluarga['tanggal_lahir_keluarga'];
            $isiKeluarga->alamat_keluarga         = $keluarga['alamat_keluarga'];
            $isiKeluarga->jenis_kelamin_keluarga  = $keluarga['jenis_kelamin_keluarga'];
            $isiKeluarga->pekerjaan_keluarga      = $keluarga['pekerjaan_keluarga'];
            $isiKeluarga->id_pegawai              = $pegawai->id;
            $isiKeluarga->save();
          }
        }

        $pengalaman_kerjas = $request->input('pengalaman');
        if($pengalaman_kerjas == !null){
          foreach($pengalaman_kerjas as $pengalaman_kerja){
            $isiPengalaman  = new PengalamanKerja;
            $isiPengalaman->nama_perusahaan   = $pengalaman_kerja['nama_perusahaan'];
            $isiPengalaman->posisi_perusahaan = $pengalaman_kerja['posisi'];
            $isiPengalaman->tahun_awal_kerja  = $pengalaman_kerja['tahun_awal_kerja'];
            $isiPengalaman->tahun_akhir_kerja = $pengalaman_kerja['tahun_akhir_kerja'];
            $isiPengalaman->id_pegawai        = $pegawai->id;
            $isiPengalaman->save();
          }
        }

        $pendidikans = $request->input('pendidikan');
        if($pendidikans == !null){
          foreach($pendidikans as $pendidikan){
            $isiPendidikan  = new Pendidikan;
            $isiPendidikan->jenjang_pendidikan      = $pendidikan['jenjang_pendidikan'];
            $isiPendidikan->institusi_pendidikan    = $pendidikan['institusi_pendidikan'];
            $isiPendidikan->tahun_masuk_pendidikan  = $pendidikan['tahun_masuk_pendidikan'];
            $isiPendidikan->tahun_lulus_pendidikan  = $pendidikan['tahun_lulus_pendidikan'];
            $isiPendidikan->gelar_akademik          = $pendidikan['gelar_akademik'];
            $isiPendidikan->id_pegawai              = $pegawai->id;
            $isiPendidikan->save();
          }
        }

        $bahasas = $request->input('bahasa');
        if($bahasas == !null){
          foreach ($bahasas as $bahasa) {
            $isiBahasa = new BahasaAsing;
            $isiBahasa->bahasa      = $bahasa['bahasa'];
            $isiBahasa->berbicara   = $bahasa['berbicara'];
            $isiBahasa->menulis     = $bahasa['menulis'];
            $isiBahasa->mengerti    = $bahasa['mengerti'];
            $isiBahasa->id_pegawai  = $pegawai->id;
            $isiBahasa->save();
          }
        }

        $komputers = $request->input('komputer');
        if($komputers == !null){
          foreach ($komputers as $komputer) {
            $isiKomputer  = new KeahlianKomputer;
            $isiKomputer->nama_program  = $komputer['nama_program'];
            $isiKomputer->nilai_komputer= $komputer['nilai'];
            $isiKomputer->id_pegawai    = $pegawai->id;
            $isiKomputer->save();
          }
        }

        $penyakits = $request->input('penyakit');
        if($penyakits == !null){
          foreach ($penyakits as $penyakit) {
            $isiPenyakit  = new RiwayatPenyakit;
            $isiPenyakit->nama_penyakit       = $penyakit['nama_penyakit'];
            $isiPenyakit->keterangan_penyakit = $penyakit['keterangan'];
            $isiPenyakit->id_pegawai          = $pegawai->id;
            $isiPenyakit->save();
          }
        }

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
      $DataPegawai    = MasterPegawai::where('id', '=', $id)->get();
      $DataKeluarga   = DataKeluarga::where('id_pegawai', '=', $id)->get();
      $DataPendidikan = Pendidikan::where('id_pegawai', '=', $id)->get();
      $DataPengalaman = PengalamanKerja::where('id_pegawai', '=', $id)->get();
      $DataKomputer   = KeahlianKomputer::where('id_pegawai', '=', $id)->get();
      $DataBahasa     = BahasaAsing::where('id_pegawai', '=', $id)->get();
      $DataKesehatan  = KondisiKesehatan::where('id_pegawai', '=', $id)->get();
      $DataPenyakit   = RiwayatPenyakit::where('id_pegawai', '=', $id)->get();

      return view('pages/MasterPegawai/lihatdatapegawai', compact('DataPegawai', 'DataKeluarga', 'DataPendidikan', 'DataPengalaman', 'DataKomputer', 'DataBahasa', 'DataKesehatan', 'DataPenyakit'));
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
