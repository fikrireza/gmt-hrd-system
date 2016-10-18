<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Datatables;
use App\Models\PKWT;
use App\Http\Requests;
use App\Models\Pendidikan;
use App\Models\BahasaAsing;
use App\Models\DataKeluarga;
use App\Models\MasterJabatan;
use App\Models\MasterPegawai;
use App\Models\UploadDocument;
use App\Models\DataPeringatan;
use App\Models\HistoriPegawai;
use App\Models\RiwayatPenyakit;
use App\Models\PengalamanKerja;
use App\Models\KondisiKesehatan;
use App\Models\KeahlianKomputer;
use App\Http\Requests\MasterPegawaiRequest;

class SetGajiController extends Controller
{
  public function index()
  {
    return view('pages/setgajipegawai');
  }

  public function detailpegawai($id)
  {
    $DataPegawai    = MasterPegawai::join('master_jabatan', 'master_pegawai.id_jabatan', '=', 'master_jabatan.id')
                      ->select('master_pegawai.*', 'master_jabatan.nama_jabatan')
                      ->where('master_pegawai.id', '=', $id)
                      ->get();

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

  public function getdata()
  {
    $users = MasterPegawai::select(['master_pegawai.id as id',                                                  'nip','nama','no_telp','nama_jabatan',DB::raw("if(master_pegawai.status = 1, 'Aktif', 'Tidak Aktif') as status")])
      ->join('master_jabatan','master_pegawai.id_jabatan','=', 'master_jabatan.id')
      ->get();

    return Datatables::of($users)
      ->addColumn('action', function($user){
          return '<a href="detail-pegawai/'.$user->id.'" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Lihat Detail"><i class="fa fa-eye"></i></a> <span data-toggle="tooltip" title="Edit Gaji"> <a href="" class="btn btn-xs btn-warning hapus" data-toggle="modal" data-target="#myModal" data-value="'.$user->id.'"><i class="fa fa-edit"></i></a></span>';
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
}
