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
      return view('pages/MasterPegawai/viewpegawai');
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
                      'status_kontrak'=> $request->status_karyawan,
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
      $DataPegawai    = MasterPegawai::where('nip', '=', $id)->get();

      //bukan metode yang terbaik, cari lagi cuuuuuy metodenya..
      $idofpegawai;
      foreach ($DataPegawai as $k) {
        $idofpegawai = $k->id;
      }

      $DataKeluarga   = DataKeluarga::where('id_pegawai', '=', $idofpegawai)->get();
      $DataPendidikan = Pendidikan::where('id_pegawai', '=', $idofpegawai)->get();
      $DataPengalaman = PengalamanKerja::where('id_pegawai', '=', $idofpegawai)->get();
      $DataKomputer   = KeahlianKomputer::where('id_pegawai', '=', $idofpegawai)->get();
      $DataBahasa     = BahasaAsing::where('id_pegawai', '=', $idofpegawai)->get();
      $DataKesehatan  = KondisiKesehatan::where('id_pegawai', '=', $idofpegawai)->get();
      $DataPenyakit   = RiwayatPenyakit::where('id_pegawai', '=', $idofpegawai)->get();

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
      $users = MasterPegawai::select(['nip','nama','jenis_kelamin', 'no_telp', 'nama_jabatan', 'status_kontrak'])
        ->join('master_jabatan','master_pegawai.id_jabatan','=', 'master_jabatan.id')->get();
      // dd($users);
      return Datatables::of($users)
        ->addColumn('action', function($user){
          return '<a href="masterpegawai/'.$user->nip.'" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Lihat Detail"><i class="fa fa-eye"></i> Lihat</a>&nbsp;<a href="masterpegawai/'.$user->nip.'/edit" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit Pegawai"><i class="fa fa-edit"></i> Edit</a>';
        })
        ->editColumn('jenis_kelamin', function($users){
          if($users->jenis_kelamin=="L")
            return "Pria";
          else
            return "Wanita";
        })
        ->make();
    }

    public function addKeluarga(Request $request)
    {
      $keluarga = new DataKeluarga;
      $keluarga->nama_keluarga = $request->nama_keluarga;
      $keluarga->hubungan_keluarga = $request->hubungan_keluarga;
      $keluarga->tanggal_lahir_keluarga = $request->tanggal_lahir_keluarga;
      $keluarga->alamat_keluarga = $request->alamat_keluarga;
      $keluarga->pekerjaan_keluarga = $request->pekerjaan_keluarga;
      $keluarga->jenis_kelamin_keluarga = $request->jenis_kelamin_keluarga;
      $keluarga->id_pegawai = $request->id_pegawai;
      $keluarga->save();

      return redirect()->route('masterpegawai.show', $request->nip)->with('message','Berhasil memasukkan data keluarga.');
    }

    public function hapusKeluarga($id)
    {
      $keluarga = DataKeluarga::find($id);
      $getnip = MasterPegawai::find($keluarga->id_pegawai);
      $keluarga->delete();

      return redirect()->route('masterpegawai.show', $getnip->nip)->with('message','Berhasil menghapus data keluarga.');
    }

    public function addPendidikan(Request $request)
    {
      $didik = new Pendidikan;
      $didik->jenjang_pendidikan = $request->jenjang_pendidikan;
      $didik->institusi_pendidikan = $request->institusi_pendidikan;
      $didik->tahun_masuk_pendidikan = $request->tahun_masuk_pendidikan;
      $didik->tahun_lulus_pendidikan = $request->tahun_lulus_pendidikan;
      $didik->gelar_akademik = $request->gelar_akademik;
      $didik->id_pegawai = $request->id_pegawai;
      $didik->save();

      return redirect()->route('masterpegawai.show', $request->nip)->with('message','Berhasil memasukkan data pendidikan.');
    }

    public function hapusPendidikan($id)
    {
      $didik = Pendidikan::find($id);
      $getnip = MasterPegawai::find($didik->id_pegawai);
      $didik->delete();

      return redirect()->route('masterpegawai.show', $getnip->nip)->with('message','Berhasil menghapus data pendidikan.');
    }

    public function addPengalaman(Request $request)
    {
      $kerja = new PengalamanKerja;
      $kerja->nama_perusahaan = $request->nama_perusahaan;
      $kerja->posisi_perusahaan = $request->posisi_perusahaan;
      $kerja->tahun_awal_kerja = $request->tahun_awal_kerja;
      $kerja->tahun_akhir_kerja = $request->tahun_akhir_kerja;
      $kerja->id_pegawai = $request->id_pegawai;
      $kerja->save();

      return redirect()->route('masterpegawai.show', $request->nip)->with('message','Berhasil memasukkan data pengalaman kerja.');
    }

    public function hapusPengalaman($id)
    {
      $kerja = PengalamanKerja::find($id);
      $getnip = MasterPegawai::find($kerja->id_pegawai);
      $kerja->delete();

      return redirect()->route('masterpegawai.show', $getnip->nip)->with('message','Berhasil menghapus data pengalaman kerja.');
    }

    public function addKomputer(Request $request)
    {
      $komp = new KeahlianKomputer;
      $komp->nama_program = $request->nama_program;
      $komp->nilai_komputer = $request->nilai_komputer;
      $komp->id_pegawai = $request->id_pegawai;
      $komp->save();

      return redirect()->route('masterpegawai.show', $request->nip)->with('message','Berhasil memasukkan data keahlian komputer.');
    }

    public function hapusKomputer($id)
    {
      $komp = KeahlianKomputer::find($id);
      $getnip = MasterPegawai::find($komp->id_pegawai);
      $komp->delete();

      return redirect()->route('masterpegawai.show', $getnip->nip)->with('message','Berhasil menghapus data keahlian komputer.');
    }

    public function addBahasa(Request $request)
    {
      $bahasa = new BahasaAsing;
      $bahasa->bahasa = $request->bahasa;
      $bahasa->berbicara = $request->berbicara;
      $bahasa->menulis = $request->menulis;
      $bahasa->mengerti = $request->mengerti;
      $bahasa->id_pegawai = $request->id_pegawai;
      $bahasa->save();

      return redirect()->route('masterpegawai.show', $request->nip)->with('message','Berhasil memasukkan data bahasa asing.');
    }

    public function hapusBahasa($id)
    {
      $x = BahasaAsing::find($id);
      $getnip = MasterPegawai::find($x->id_pegawai);
      $x->delete();

      return redirect()->route('masterpegawai.show', $getnip->nip)->with('message','Berhasil menghapus data bahasa asing.');
    }

    public function addPenyakit(Request $request)
    {
      $peny = new RiwayatPenyakit;
      $peny->nama_penyakit = $request->nama_penyakit;
      $peny->keterangan_penyakit = $request->keterangan_penyakit;
      $peny->id_pegawai = $request->id_pegawai;
      $peny->save();

      return redirect()->route('masterpegawai.show', $request->nip)->with('message','Berhasil memasukkan data riwayat penyakit.');
    }

    public function hapusPenyakit($id)
    {
      $x = RiwayatPenyakit::find($id);
      $getnip = MasterPegawai::find($x->id_pegawai);
      $x->delete();

      return redirect()->route('masterpegawai.show', $getnip->nip)->with('message','Berhasil menghapus data riwayat penyakit.');
    }

    public function getDataKeluargaByID($id)
    {
      $get = DataKeluarga::find($id);
      return $get;
    }

    public function saveChangesKeluarga(Request $request)
    {
      $set = DataKeluarga::find($request->id_keluarga);
      $set->nama_keluarga = $request->nama_keluarga;
      $set->hubungan_keluarga = $request->hubungan_keluarga;
      $set->tanggal_lahir_keluarga = $request->tanggal_lahir_keluarga;
      $set->pekerjaan_keluarga = $request->pekerjaan_keluarga;
      $set->jenis_kelamin_keluarga = $request->jenis_kelamin_keluarga;
      $set->alamat_keluarga = $request->alamat_keluarga;
      $set->save();

      return redirect()->route('masterpegawai.show', $request->nip)->with('message','Berhasil mengubah data keluarga.');
    }

    public function getPendidikanByID($id)
    {
      $get = Pendidikan::find($id);
      return $get;
    }

    public function saveChangesPendidikan(Request $request)
    {
      // dd($request);
      $set = Pendidikan::find($request->id_pendidikan);
      $set->jenjang_pendidikan = $request->edit_jenjang_pendidikan;
      $set->institusi_pendidikan = $request->institusi_pendidikan;
      $set->tahun_masuk_pendidikan = $request->tahun_masuk_pendidikan;
      $set->tahun_lulus_pendidikan = $request->tahun_lulus_pendidikan;
      $set->gelar_akademik = $request->gelar_akademik;
      $set->save();

      return redirect()->route('masterpegawai.show', $request->nip)->with('message','Berhasil mengubah data pendidikan.');
    }

    public function getPengalamanByID($id)
    {
      $get = PengalamanKerja::find($id);
      return $get;
    }

    public function saveChangesPengalaman(Request $request)
    {
      // dd($request);
      $set = PengalamanKerja::find($request->id_pengalaman);
      $set->nama_perusahaan = $request->nama_perusahaan;
      $set->posisi_perusahaan = $request->posisi_perusahaan;
      $set->tahun_awal_kerja = $request->tahun_awal_kerja;
      $set->tahun_akhir_kerja = $request->tahun_akhir_kerja;
      $set->save();

      return redirect()->route('masterpegawai.show', $request->nip)->with('message','Berhasil mengubah data pengalaman.');
    }

    public function saveChangesKesehatan(Request $request)
    {
      // dd($request);
      $set = KondisiKesehatan::find($request->id_kesehatan);
      $set->tinggi_badan = $request->tinggi_badan;
      $set->berat_badan = $request->berat_badan;
      $set->warna_rambut = $request->warna_rambut;
      $set->warna_mata = $request->warna_mata;
      $set->berkacamata = $request->berkacamata;
      $set->merokok = $request->merokok;
      $set->save();

      return redirect()->route('masterpegawai.show', $request->nip)->with('message','Berhasil mengubah data kesehatan.');
    }
}
