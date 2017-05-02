<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use DB;

use App\Http\Requests;
use App\Http\Requests\MasterPegawaiRequest;
use App\Models\MasterPegawai;
use App\Models\DataKeluarga;
use App\Models\KondisiKesehatan;
use App\Models\PengalamanKerja;
use App\Models\Pendidikan;
use App\Models\BahasaAsing;
use App\Models\KeahlianKomputer;
use App\Models\RiwayatPenyakit;
use App\Models\UploadDocument;
use App\Models\PKWT;
use App\Models\DataPeringatan;
use App\Models\HistoriPegawai;

use App\Models\MasterJabatan;
use Datatables;
use Image;
use Validator;

class MasterPegawaiController extends Controller
{

    /**
    * Authentication controller.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
      return view('pages/MasterPegawai/viewpegawai');
    }

    public function create()
    {
      $getjabatan = MasterJabatan::where('status', '=', '1')->pluck('nama_jabatan','id');
      $getid = MasterPegawai::select('nip')->orderby('id', 'desc')->first();
      $sub = substr($getid->nip, 8, 4)+1;
      $thn = substr(date('Y'), -2);
      $bln = date('m');
      $nextid = "GMT".$thn.$bln."-".$sub;

      return view('pages/MasterPegawai/tambahdatapegawai')
        ->with('nextid', $nextid)
        ->with('getjabatan', $getjabatan);
    }

    public function store(Request $request)
    {

      $message = [
        'nip.required' => 'Wajib di isi.',
        'nama.required' => 'Wajib di isi.',
        'alamat.required' => 'Wajib di isi.',
        'tanggal_lahir.required' => 'Wajib di isi.',
        'jenis_kelamin.required' => 'Wajib di isi.',
        'agama.required' => 'Wajib di isi.',
        'jabatan.required' => 'Wajib di isi.'
      ];

      $validator = Validator::make($request->all(), [
        'nip' => 'required',
        'nama' => 'required',
        'alamat' => 'required',
        'tanggal_lahir' => 'required',
        'jenis_kelamin' => 'required',
        'agama' => 'required',
        'jabatan' => 'required'
      ], $message);

      if($validator->fails())
      {
        return redirect()->route('masterpegawai.create')->withErrors($validator)->withInput();
      }

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
          // 'status_kontrak'=> $request->status_karyawan,
          'no_telp'       => $request->no_telp,
          'status_pajak'  => $request->status_pajak,
          'kewarganegaraan' => $request->kewarganegaraan,
          'bpjs_kesehatan'  => $request->bpjs_kesehatan,
          'bpjs_ketenagakerjaan'  => $request->bpjs_ketenagakerjaan,
          'no_rekening'   => $request->no_rekening,
          'nama_darurat'   => $request->nama_darurat,
          'alamat_darurat'   => $request->alamat_darurat,
          'hubungan_darurat'   => $request->hubungan_darurat,
          'telepon_darurat'   => $request->telepon_darurat,
          'id_jabatan'     => $request->jabatan,
          'bank' => $request->bank,
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
        foreach($keluargas as $keluarga){
          if ($keluarga['nama_keluarga']!="" && $keluarga['hubungan_keluarga']!="" && $keluarga['tanggal_lahir_keluarga']!="" && $keluarga['alamat_keluarga']!="" && $keluarga['pekerjaan_keluarga']!="") {
            $isiKeluarga = new DataKeluarga;
            $isiKeluarga->nama_keluarga           = $keluarga['nama_keluarga'];
            $isiKeluarga->hubungan_keluarga       = $keluarga['hubungan_keluarga'];
            $isiKeluarga->tanggal_lahir_keluarga  = $keluarga['tanggal_lahir_keluarga'];
            $isiKeluarga->alamat_keluarga         = $keluarga['alamat_keluarga'];
            // $isiKeluarga->jenis_kelamin_keluarga  = $keluarga['jenis_kelamin_keluarga'];
            $isiKeluarga->pekerjaan_keluarga      = $keluarga['pekerjaan_keluarga'];
            $isiKeluarga->id_pegawai              = $pegawai->id;
            $isiKeluarga->save();
          }
        }

        $pengalaman_kerjas = $request->input('pengalaman');
        foreach($pengalaman_kerjas as $pengalaman_kerja){
          if ($pengalaman_kerja['nama_perusahaan']!="" && $pengalaman_kerja['posisi']!="" && $pengalaman_kerja['tahun_awal_kerja']!="" && $pengalaman_kerja['tahun_akhir_kerja']!="") {
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
        foreach($pendidikans as $pendidikan){
          if ($pendidikan['jenjang_pendidikan']!="" && $pendidikan['institusi_pendidikan']!="" && $pendidikan['tahun_masuk_pendidikan']!="" && $pendidikan['tahun_lulus_pendidikan']!="" && $pendidikan['gelar_akademik']!="") {
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
        foreach ($bahasas as $bahasa) {
          if ($bahasa['bahasa']!="" && $bahasa['berbicara']!="" && $bahasa['menulis']!="" && $bahasa['mengerti']!="") {
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
        foreach ($komputers as $komputer) {
          if ($komputer['nama_program']!="" && $komputer['nilai']!="") {
            $isiKomputer  = new KeahlianKomputer;
            $isiKomputer->nama_program  = $komputer['nama_program'];
            $isiKomputer->nilai_komputer= $komputer['nilai'];
            $isiKomputer->id_pegawai    = $pegawai->id;
            $isiKomputer->save();
          }
        }


        $penyakits = $request->input('penyakit');
        foreach ($penyakits as $penyakit) {
          if ($penyakit['nama_penyakit']!="" && $penyakit['keterangan']!="") {
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

    public function show($id)
    {
      $DataPegawai    = MasterPegawai::join('master_jabatan', 'master_pegawai.id_jabatan', '=', 'master_jabatan.id')
                        ->select('master_pegawai.*', 'master_jabatan.nama_jabatan')
                        ->where('master_pegawai.id', '=', $id)
                        ->get();
                        // dd($id);
      $DataJabatan    = MasterJabatan::all();

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
      $DokumenPegawai = UploadDocument::where('id_pegawai', '=', $idofpegawai)->get();
      $DataPKWT       = PKWT::join('cabang_client', 'data_pkwt.id_cabang_client','=','cabang_client.id')
                          ->join('master_client', 'cabang_client.id_client', '=', 'master_client.id')
                          ->select('master_client.nama_client', 'cabang_client.nama_cabang', 'data_pkwt.tanggal_awal_pkwt as tahun_awal', 'data_pkwt.tanggal_akhir_pkwt as tahun_akhir', 'data_pkwt.status_karyawan_pkwt')
                          ->where('data_pkwt.id_pegawai', $idofpegawai)
                          ->orderby('data_pkwt.tanggal_awal_pkwt','asc')
                          ->get();
      $DataPeringatan = DataPeringatan::where('id_pegawai', '=', $idofpegawai)->get();
      $DataHistoriPegawai = HistoriPegawai::where('id_pegawai', $idofpegawai)->get();

      return view('pages/MasterPegawai/lihatdatapegawai', compact('DataJabatan', 'DataPegawai', 'DataKeluarga', 'DataPendidikan', 'DataPengalaman', 'DataKomputer', 'DataBahasa', 'DataKesehatan', 'DataPenyakit', 'DokumenPegawai', 'DataPKWT', 'DataPeringatan', 'DataHistoriPegawai'));
    }

    public function getDataForDataTable()
    {
      $users = MasterPegawai::select(['master_pegawai.id as id', 'nip', 'nip_lama','nama','nama_jabatan',DB::raw("if(master_pegawai.status = 1, 'Aktif', 'Tidak Aktif') as status")])
        ->join('master_jabatan','master_pegawai.id_jabatan','=', 'master_jabatan.id')
        ->get();

      return Datatables::of($users)
        ->addColumn('action', function($user){
          if ($user->status=="Aktif") {
            return '<a href="masterpegawai/'.$user->id.'" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Lihat Detail"><i class="fa fa-eye"></i></a> <span data-toggle="tooltip" title="Non Aktifkan"> <a href="" class="btn btn-xs btn-danger hapus" data-toggle="modal" data-target="#myModal" data-value="'.$user->id.'"><i class="fa fa-ban"></i></a></span>';
          } else {
            return '<a href="masterpegawai/'.$user->id.'" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Lihat Detail"><i class="fa fa-eye"></i></a> <span data-toggle="tooltip" title="Aktifkan"> <a href="" class="btn btn-xs btn-success hapus" data-toggle="modal" data-target="#myModal" data-value="'.$user->id.'"><i class="fa fa-check"></i></a></span>';
          }
        })
        ->editColumn('status', function($user){
          if ($user->status=="Aktif") {
            return "<span class='badge bg-green'>Aktif</span>";
          } else {
            return "<span class='badge bg-red'>Tidak Aktif</span>";
          }
        })
        ->removeColumn('id')
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

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil memasukkan data keluarga.');
    }

    public function hapusKeluarga($id)
    {
      $keluarga = DataKeluarga::find($id);
      $getnip = MasterPegawai::find($keluarga->id_pegawai);
      $keluarga->delete();

      return redirect()->route('masterpegawai.show', $getnip->id)->with('message','Berhasil menghapus data keluarga.');
    }

    public function hapusRiwayatPekerjaan($id)
    {
      $histori = HistoriPegawai::find($id);
      $getnip = MasterPegawai::find($histori->id_pegawai);
      $histori->delete();

      return redirect()->route('masterpegawai.show', $getnip->id)->with('message','Berhasil menghapus data riwayat pekerjaan.');
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

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil memasukkan data pendidikan.');
    }

    public function hapusPendidikan($id)
    {
      $didik = Pendidikan::find($id);
      $getnip = MasterPegawai::find($didik->id_pegawai);
      $didik->delete();

      return redirect()->route('masterpegawai.show', $getnip->id)->with('message','Berhasil menghapus data pendidikan.');
    }

    public function hapusDokumen($id)
    {
      $dokumen = UploadDocument::find($id);
      $getnip = MasterPegawai::find($dokumen->id_pegawai);
      $dokumen->delete();

      return redirect()->route('masterpegawai.show', $getnip->id)->with('message','Berhasil menghapus dokumen pegawai.');
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

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil memasukkan data pengalaman kerja.');
    }

    public function hapusPengalaman($id)
    {
      $kerja = PengalamanKerja::find($id);
      $getnip = MasterPegawai::find($kerja->id_pegawai);
      $kerja->delete();

      return redirect()->route('masterpegawai.show', $getnip->id)->with('message','Berhasil menghapus data pengalaman kerja.');
    }

    public function addKomputer(Request $request)
    {
      // dd($request);
      $komp = new KeahlianKomputer;
      $komp->nama_program = $request->nama_program;
      $komp->nilai_komputer = $request->nilai_komputer;
      $komp->id_pegawai = $request->id_pegawai;
      $komp->save();

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil memasukkan data keahlian komputer.');
    }

    public function hapusKomputer($id)
    {
      $komp = KeahlianKomputer::find($id);
      $getnip = MasterPegawai::find($komp->id_pegawai);
      $komp->delete();

      return redirect()->route('masterpegawai.show', $getnip->id)->with('message','Berhasil menghapus data keahlian komputer.');
    }

    public function addBahasa(Request $request)
    {
      // dd($request);
      $bahasa = new BahasaAsing;
      $bahasa->bahasa = $request->bahasa;
      $bahasa->berbicara = $request->berbicara;
      $bahasa->menulis = $request->menulis;
      $bahasa->mengerti = $request->mengerti;
      $bahasa->id_pegawai = $request->id_pegawai;
      $bahasa->save();

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil memasukkan data bahasa asing.');
    }

    public function hapusBahasa($id)
    {
      $x = BahasaAsing::find($id);
      $getnip = MasterPegawai::find($x->id_pegawai);
      $x->delete();

      return redirect()->route('masterpegawai.show', $getnip->id)->with('message','Berhasil menghapus data bahasa asing.');
    }

    public function addPenyakit(Request $request)
    {
      $peny = new RiwayatPenyakit;
      $peny->nama_penyakit = $request->nama_penyakit;
      $peny->keterangan_penyakit = $request->keterangan_penyakit;
      $peny->id_pegawai = $request->id_pegawai;
      $peny->save();

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil memasukkan data riwayat penyakit.');
    }

    public function hapusPenyakit($id)
    {
      $x = RiwayatPenyakit::find($id);
      $getnip = MasterPegawai::find($x->id_pegawai);
      $x->delete();

      return redirect()->route('masterpegawai.show', $getnip->id)->with('message','Berhasil menghapus data riwayat penyakit.');
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

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil mengubah data keluarga.');
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

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil mengubah data pendidikan.');
    }

    public function getPengalamanByID($id)
    {
      $get = PengalamanKerja::find($id);
      return $get;
    }

    public function getdokumen($id)
    {
      $get = UploadDocument::where('id_pegawai', $id)->first();
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

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil mengubah data pengalaman.');
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

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil mengubah data kesehatan.');
    }

    public function setKondisiKesehatan(Request $request)
    {
      // dd($request);
      $set = new KondisiKesehatan;
      $set->tinggi_badan = $request->tinggi_badan;
      $set->berat_badan = $request->berat_badan;
      $set->warna_rambut = $request->warna_rambut;
      $set->warna_mata = $request->warna_mata;
      $set->berkacamata = $request->berkacamata;
      $set->merokok = $request->merokok;
      $set->id_pegawai = $request->id_pegawai;
      $set->save();

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil mengubah data kesehatan.');
    }

    public function getKomputerByID($id)
    {
      $get = KeahlianKomputer::find($id);
      return $get;
    }

    public function saveChangesKomputer(Request $request)
    {
      // dd($request);
      $komp = KeahlianKomputer::find($request->id_komputer);
      $komp->nama_program = $request->nama_program;
      $komp->nilai_komputer = $request->nilai_komputer;
      $komp->save();

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil mengubah data keahlian komputer.');
    }

    public function getBahasaByID($id)
    {
      $get = BahasaAsing::find($id);
      return $get;
    }

    public function saveChangesBahasa(Request $request)
    {
      $bahasa = BahasaAsing::find($request->id_bahasa);
      $bahasa->bahasa = $request->bahasa;
      $bahasa->berbicara = $request->berbicara;
      $bahasa->menulis = $request->menulis;
      $bahasa->mengerti = $request->mengerti;
      $bahasa->save();

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil mengubah data bahasa asing.');
    }

    public function getPenyakitByID($id)
    {
      $get = RiwayatPenyakit::find($id);
      return $get;
    }

    public function saveChangesPenyakit(Request $request)
    {
      $peny = RiwayatPenyakit::find($request->id_penyakit);
      $peny->nama_penyakit = $request->nama_penyakit;
      $peny->keterangan_penyakit = $request->keterangan_penyakit;
      $peny->save();

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil mengubah data riwayat penyakit.');
    }

    public function saveChangesPegawai(Request $request)
    {
      $messages = [
          'nama.required' => 'Nama harus diisi',
          'nip.required' => 'NIP harus diisi',
          'niplama.required' => 'NIP Lama harus diisi',
          'ktp.required' => 'KTP harus diisi',
          'kk.required' => 'KK harus diisi',
          'npwp.required' => 'NPWP harus diisi',
          'tgllahir.required' => 'Tanggal lahir harus diisi',
          'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
          'email.required' => 'Email harus diisi',
          'email.email' => 'Format email tidak valid',
          'alamat.required' => 'Alamat harus diisi',
          'agama.required' => 'Agama harus dipilih',
          'agama.not_in' => 'Agama harus dipilih',
          'telp.required' => 'Telp harus diisi',
          'telp.numeric' => 'Telp harus diisi dengan angka',
          'warga.required' => 'Kewarganegaraan harus diisi',
          'warga.not_in' => 'Kewarganegaraan harus diisi',
          'bpjssehat.required' => 'BPJS Kesehatan harus diisi',
          'bpjskerja.required' => 'BPJS Ketenagakerjaan harus diisi',
          'rekening.required' => 'Rekening harus diisi',
          'jabatan.required' => 'Jabatan harus diisi',
          'jabatan.not_in' => 'Jabatan harus diisi',
          'bank.required' => 'Bank harus diisi',
          'bank.not_in' => 'Bank harus diisi'
      ];

      $validator = Validator::make($request->all(), [
        'nama' => 'required',
        'nip' => 'required',
        'niplama' => 'required',
        'ktp' => 'required',
        'kk' => 'required',
        'npwp' => 'required',
        'tgllahir' => 'required',
        'jenis_kelamin' => 'required',
        'email' => 'required|email',
        'alamat' => 'required',
        'agama' => 'required|not_in:-- Pilih --',
        'telp' => 'required|numeric',
        'warga' => 'required|not_in:-- Pilih --',
        'bpjssehat' => 'required',
        'bpjskerja' => 'required',
        'rekening' => 'required',
        'jabatan' => 'required|not_in:-- Pilih --',
        'bank' => 'required|not_in:-- Pilih --'
      ], $messages);

      if ($validator->fails()) {
        return redirect()->route('masterpegawai.show', $request->nip)
          ->withErrors($validator)
          ->withInput();
      }

      $pegawai = MasterPegawai::find($request->id_pegawai);
      $pegawai->nama  = $request->nama;
      $pegawai->nip = $request->nip;
      $pegawai->nip_lama = $request->niplama;
      $pegawai->no_ktp = $request->ktp;
      $pegawai->no_kk = $request->kk;
      $pegawai->no_npwp = $request->npwp;
      $pegawai->tanggal_lahir = $request->tgllahir;
      $pegawai->jenis_kelamin = $request->jenis_kelamin;
      $pegawai->email = $request->email;
      $pegawai->alamat = $request->alamat;
      $pegawai->agama = $request->agama;
      $pegawai->no_telp = $request->telp;
      $pegawai->kewarganegaraan = $request->warga;
      $pegawai->bpjs_kesehatan = $request->bpjssehat;
      $pegawai->bpjs_ketenagakerjaan = $request->bpjskerja;
      $pegawai->no_rekening = $request->rekening;
      $pegawai->id_jabatan = $request->jabatan;
      $pegawai->bank = $request->bank;
      $pegawai->save();

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil mengubah data pegawai.');
    }

    public function saveChangesDarurat(Request $request)
    {
      $set = MasterPegawai::find($request->id_pegawai);
      $set->nama_darurat = $request->nama_darurat;
      $set->hubungan_darurat = $request->hubungan_darurat;
      $set->alamat_darurat = $request->alamat_darurat;
      $set->telepon_darurat = $request->telepon_darurat;
      $set->save();

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil mengubah data darurat.');
    }

    public function addDokumen(Request $request)
    {
      $file = $request->file('unggahdokumen');

      $fName  = MasterPegawai::select('nip', 'nama')->where('id', $request->id_pegawai)->get();

      if($file!=null)
      {
        $file_name = strtolower($fName[0]->nip.'-'.(str_slug($fName[0]->nama, '-')).'-'.$request->nama_dokumen).'-'.rand(). '.' . $file->getClientOriginalExtension();
        $file->move('documents', $file_name);

        $set = new UploadDocument;
        $set->id_pegawai = $request->id_pegawai;
        $set->nama_dokumen = $request->namadokumen;
        $set->file_dokumen = $file_name;
        $set->save();

        return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil memasukkan dokumen pegawai.');
      } else {
        return "gagal karena tidak meng-upload file.";
      }
    }

    public function editdokumenpegawai(Request $request)
    {
      $file = $request->file('unggahdokumen');
      if($file==null) {
        $set = UploadDocument::find($request->id);
        $set->nama_dokumen = $request->namadokumen;
        $set->save();

        return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil mengubah dokumen pegawai.');
      } else {
        $file_name = time(). '.' . $file->getClientOriginalExtension();
        $file->move('documents', $file_name);

        $set = UploadDocument::find($request->id);
        $set->nama_dokumen = $request->namadokumen;
        $set->file_dokumen = $file_name;
        $set->save();

        return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil mengubah dokumen pegawai.');
      }
    }

    public function addhistoripegawai(Request $request)
    {
      $set = new HistoriPegawai;
      $set->keterangan  = $request->keterangan;
      $set->id_pegawai  = $request->id_pegawai;
      $set->save();

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil Menambah Histori Pekerjaan Pegawai.');
    }

    public function bindhistoriperingatan($id)
    {
      $get  = HistoriPegawai::find($id);

      return $get;
    }

    public function updatehistoripegawai(Request $request)
    {
      $set  = HistoriPegawai::find($request->id);
      $set->keterangan  = $request->keterangan;
      $set->id_pegawai  = $request->id_pegawai;
      $set->save();

      return redirect()->route('masterpegawai.show', $request->id_pegawai)->with('message','Berhasil Merubah Histori Pekerjaan Pegawai.');

    }

    public function changestatus($id)
    {
      $set = MasterPegawai::find($id);
      if ($set->status=='1') {
        $set->status = '0';
        $set->save();
      } else {
        $set->status = '1';
        $set->save();
      }

      return redirect()->route('masterpegawai.index')->with('message', 'Berhasil mengubah status pegawai.');
    }

    public function bindDarurat($id)
    {
      $getdarurat = MasterPegawai::select('id', 'nama_darurat', 'alamat_darurat', 'hubungan_darurat', 'telepon_darurat')->where('id', $id)->first();

      return $getdarurat;
    }

}
