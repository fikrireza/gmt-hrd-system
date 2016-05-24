<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\PKWT;
use App\MasterPegawai;
use App\Models\MasterClient;
use Datatables;
use Carbon\Carbon;
use DB;

class PKWTController extends Controller
{
  public function index()
  {
    return view('pages.viewpkwt');
  }

  public function create()
  {
    $getnip = MasterPegawai::select('id','nip','nama')->get();
    $getclient = MasterClient::select('id','kode_client','nama_client')->get();
    return view('pages.tambahpkwt', compact('getnip', 'getclient'));
  }

  public function store(Request $request)
  {
    $set = new PKWT;
    $set->tanggal_masuk_gmt = $request->tanggal_masuk_gmt;
    $set->tanggal_masuk_client = $request->tanggal_masuk_client;
    $set->status_pkwt = $request->status_pkwt;
    $set->tanggal_awal_pkwt = $request->tanggal_awal_pkwt;
    $set->tanggal_akhir_pkwt = $request->tanggal_akhir_pkwt;
    $set->status_karyawan_pkwt = $request->status_karyawan;
    $set->id_pegawai = $request->id_pegawai;
    $set->id_client = $request->id_client;
    $set->save();

    return view('pages.viewpkwt');
  }

  public function getPKWTforDataTables()
  {
    $pkwt = PKWT::select(['nip','nama','tanggal_awal_pkwt', 'tanggal_akhir_pkwt', 'status_pkwt'])
      ->join('master_pegawai','data_pkwt.id_pegawai','=', 'master_pegawai.id')->get();

    return Datatables::of($pkwt)
      ->addColumn('keterangan', function($pkwt){
        $tgl = explode('-', $pkwt->tanggal_akhir_pkwt);
        $tglakhir = Carbon::createFromDate($tgl[0], $tgl[1], $tgl[2]);
        // $result = Carbon::createFromDate($tgl[0], $tgl[1], $tgl[2]);
        $result = Carbon::now()->diffInDays($tglakhir, false);
        if($result == 0)
        {
          return "<span class='label bg-yellow'>Expired Hari Ini</span>";
        }
        else if($result < 0)
        {
          return "<span class='label bg-red'>Telah Expired</span>";
        }
        else if($result > 30)
        {
          return "<span class='label bg-green'>PKWT Aktif</span>";
        }
        else if($result > 0)
        {
          return "<span class='label bg-yellow'>Expired Dalam ".$result." Hari</span>";
        }
      })
      ->addColumn('action', function($pkwt){
        return '<a href="view-detail-pkwt/'.$pkwt->nip.'" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Lihat Detail"><i class="fa fa-eye"></i> Lihat</a>';
      })
      ->editColumn('status_pkwt', function($pkwt){
        if($pkwt->status_pkwt==1)
          return "Kontrak";
        else if($pkwt->status_pkwt==2)
          return "Freelance";
        else if($pkwt->status_pkwt==3)
          return "Tetap";
      })
      ->make();
  }

  public function detail($nip)
  {
    $getnip = MasterPegawai::where('nip', $nip)->get();
    $id_pegawai = $getnip[0]->id;
    $getpkwt = PKWT::where('id_pegawai', $id_pegawai)->get();

    // $tgl = explode('-', $getpkwt[0]->tanggal_akhir_pkwt);
    // $tglakhir = Carbon::createFromDate($tgl[0], $tgl[1], $tgl[2]);
    // $result = Carbon::now()->diffInDays($tglakhir, false);
    // $keterangan;
    // if($result == 0)
    // {
    //   $keterangan = "<span class='label bg-yellow'>Expired Hari Ini</span>";
    // }
    // else if($result < 0)
    // {
    //   $keterangan = "<span class='label bg-red'>Telah Expired</span>";
    // }
    // else if($result > 30)
    // {
    //   $keterangan = "<span class='label bg-green'>PKWT Aktif</span>";
    // }
    // else if($result > 0)
    // {
    //   $keterangan = "<span class='label bg-yellow'>Expired Dalam ".$result." Hari</span>";
    // }

    return view('pages.viewdetailpkwt', compact('getnip', 'getpkwt'));
  }
}
