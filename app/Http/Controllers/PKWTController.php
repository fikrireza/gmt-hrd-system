<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\PKWT;
use App\MasterPegawai;
use App\Models\MasterClient;
use App\Models\CabangClient;
use App\Models\HistoriPegawai;
use Datatables;
use Carbon\Carbon;
use DB;

class PKWTController extends Controller
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
    return view('pages.PKWT.viewpkwt', compact('getcountpegawai'));
  }

  public function create()
  {
    $getnip = MasterPegawai::select('id','nip','nama')->where('id_jabatan', '<', '990')->get();
    $get_kel_jabatan = MasterPegawai::select('id','nip','nama')->where('id_jabatan', '=', '999')->get();

    $getclient  = MasterClient::select('id', 'nama_client')->get();
    $getcabang = CabangClient::select('id','kode_cabang','nama_cabang', 'id_client')->get();

    return view('pages.PKWT.tambahpkwt', compact('getnip', 'get_kel_jabatan', 'getclient', 'getcabang'));
  }

  public function store(Request $request)
  {
    $set = new PKWT;
    $set->tanggal_masuk_gmt = $request->tanggal_masuk_gmt;
    $set->tanggal_masuk_client = $request->tanggal_masuk_client;
    $set->status_pkwt = $request->status_pkwt;
    $set->tanggal_awal_pkwt = $request->tanggal_awal_pkwt;
    $set->tanggal_akhir_pkwt = $request->tanggal_akhir_pkwt;
    $set->status_karyawan_pkwt = $request->status_karyawan_pkwt;
    $set->id_pegawai = $request->id_pegawai;
    $set->id_kelompok_jabatan = $request->id_kelompok_jabatan;
    $set->id_cabang_client = $request->id_cabang_client;
    $set->flag_terminate = '1';
    $set->save();

    return redirect()->route('kelola.pkwt');
  }

  public function getPKWTforDataTables()
  {
    $pkwt = PKWT::select(['pegawai.nip as nip','pegawai.nama as nama','tanggal_awal_pkwt', 'tanggal_akhir_pkwt', 'spv.nama as id_kelompok_jabatan', 'status_karyawan_pkwt'])
              ->join('master_pegawai as pegawai','data_pkwt.id_pegawai','=', 'pegawai.id')
              ->join('master_pegawai as spv', 'data_pkwt.id_kelompok_jabatan', '=', 'spv.id')
              ->where('status_pkwt', 1)
              ->get();

    return Datatables::of($pkwt)
      ->addColumn('keterangan', function($pkwt){
        $tgl = explode('-', $pkwt->tanggal_akhir_pkwt);
        $tglakhir = Carbon::createFromDate($tgl[0], $tgl[1], $tgl[2]);
        // $result = Carbon::createFromDate($tgl[0], $tgl[1], $tgl[2]);
        $now = gmdate("Y-m-d", time()+60*60*7);
        $tglskrg = explode('-', $now);
        $result = Carbon::createFromDate($tglskrg[0],$tglskrg[1],$tglskrg[2])->diffInDays($tglakhir, false);
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
        return '<a href="view-detail-pkwt/'.$pkwt->nip.'" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Lihat Detail"><i class="fa fa-eye"></i></a>';
      })
      ->editColumn('status_karyawan_pkwt', function($pkwt){
        if($pkwt->status_karyawan_pkwt==1)
          return "Kontrak";
        else if($pkwt->status_karyawan_pkwt==2)
          return "Freelance";
        else if($pkwt->status_karyawan_pkwt==3)
          return "Tetap";
      })
      ->make();
  }

  public function getPKWTforDashboard()
  {
    $pkwt = PKWT::select(['nip','nama','tanggal_awal_pkwt', 'tanggal_akhir_pkwt', 'status_karyawan_pkwt'])
      ->join('master_pegawai','data_pkwt.id_pegawai','=', 'master_pegawai.id')->get();

    return Datatables::of($pkwt)
      ->addColumn('keterangan', function($pkwt){
        $tgl = explode('-', $pkwt->tanggal_akhir_pkwt);
        $tglakhir = Carbon::createFromDate($tgl[0], $tgl[1], $tgl[2]);
        $now = gmdate("Y-m-d", time()+60*60*7);
        $tglskrg = explode('-', $now);
        $result = Carbon::createFromDate($tglskrg[0],$tglskrg[1],$tglskrg[2])->diffInDays($tglakhir, false);
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
      ->editColumn('status_karyawan_pkwt', function($pkwt){
        if($pkwt->status_karyawan_pkwt==1)
          return "Kontrak";
        else if($pkwt->status_karyawan_pkwt==2)
          return "Freelance";
        else if($pkwt->status_karyawan_pkwt==3)
          return "Tetap";
      })
      ->make();
  }

  public function detail($nip)
  {
    $getnip = MasterPegawai::where('nip', $nip)->get();
    $id_pegawai = $getnip[0]->id;

    $getpkwt = PKWT::join('master_pegawai as spv', 'spv.id', '=', 'data_pkwt.id_kelompok_jabatan')
                    ->join('master_pegawai', 'master_pegawai.id', '=', 'data_pkwt.id_pegawai')
                    ->join('cabang_client', 'cabang_client.id', '=', 'data_pkwt.id_cabang_client')
                    ->join('master_client', 'master_client.id', '=', 'cabang_client.id_client')
                    ->join('master_jabatan', 'master_jabatan.id', '=', 'master_pegawai.id_jabatan')
                    ->select('data_pkwt.*', 'master_pegawai.nama', 'spv.nama', 'master_client.nama_client', 'cabang_client.nama_cabang')
                    ->where('data_pkwt.id_pegawai', $id_pegawai)
                    ->orderBy('tanggal_akhir_pkwt', 'DESC')
                    ->get();

    $get_kel_jabatan = MasterPegawai::select('id','nip','nama')->where('id_jabatan', '=', '999')->get();

    return view('pages.PKWT.viewdetailpkwt', compact('getnip', 'getpkwt', 'get_kel_jabatan'));
  }

  public function bind($id)
  {
    $get = PKWT::find($id);
    return $get;
  }

  public function saveChangesPKWT(Request $request)
  {
    dd($request->id_kel_jabatan);
    $set = PKWT::find($request->id_pkwt);
    $set->tanggal_masuk_gmt = $request->tanggal_masuk_gmt;
    $set->tanggal_masuk_client = $request->tanggal_masuk_client;
    $set->tanggal_awal_pkwt = $request->tanggal_awal_pkwt;
    $set->tanggal_akhir_pkwt = $request->tanggal_akhir_pkwt;
    $set->status_karyawan_pkwt = $request->status_karyawan;
    $set->status_pkwt = $request->status_pkwt;
    $set->id_supervisor = $request->id_kelompok_jabatan;
    $set->save();

    return redirect()->route('detail.pkwt', $request->nip)->with('message', 'Berhasil mengubah data PKWT.');
  }

  public function terminatePKWT(Request $request)
  {
    $setPKWT = PKWT::find($request->id_pkwt);
    $setPKWT->flag_terminate = '0';
    $setPKWT->status_pkwt = '0';
    $setPKWT->save();

    $bindPegawai = PKWT::join('master_pegawai', 'master_pegawai.id', '=', 'data_pkwt.id_pegawai')
                  ->select('master_pegawai.id', 'master_pegawai.nip')
                  ->where('data_pkwt.id', $request->id_pkwt)
                  ->first();

    $setHistori = new HistoriPegawai;
    $setHistori->keterangan = $request->keterangan;
    $setHistori->id_pegawai = $bindPegawai->id;
    $setHistori->save();

    return redirect()->route('detail.pkwt', $bindPegawai->nip)->with('terminate', 'PKWT Berhasil di-Terminate.');
  }

  public function viewSPV()
  {
    $getClient  = MasterClient::get();

    return view('pages.PKWT.viewSPV', compact('getClient'));
  }

  public function proses(Request $request)
  {
    $id_client = $request->id_client;

    $getClient  = MasterClient::get();

    $getExistClient = MasterClient::where('id', $id_client)->get();

    $getSpv  = MasterClient::join('cabang_client as A', 'A.id_client', '=', 'master_client.id')
                        ->join('data_pkwt as D', 'A.id', '=', 'D.id_cabang_client')
                        ->join('master_pegawai as C', 'C.id', '=', 'D.id_pegawai')
                        ->join('master_pegawai as SPV', 'SPV.id', '=', 'D.id_kelompok_jabatan')
                        ->join('master_jabatan as E', 'SPV.id_jabatan', '=', 'E.id')
                        ->select('master_client.nama_client', 'A.nama_cabang', 'C.nama as nama_karyawan', 'D.tanggal_awal_pkwt', 'D.tanggal_akhir_pkwt', 'E.nama_jabatan', 'SPV.nama as spv')
                        ->where('E.id', '999')
                        ->where('master_client.id',  $id_client)
                        ->where('D.status_pkwt', '1')
                        ->where('D.flag_terminate', '1')
                        ->get();

    $spvExist = MasterPegawai::join('data_pkwt', 'data_pkwt.id_kelompok_jabatan', '=', 'master_pegawai.id')
                              ->select('master_pegawai.id','master_pegawai.nip','master_pegawai.nama')
                              ->where('id_jabatan', '=', '999')
                              ->groupBy('master_pegawai.id')
                              ->get();

    $get_kel_jabatan = MasterPegawai::select('id','nip','nama')->where('id_jabatan', '=', '999')->get();

    return view('pages.PKWT.viewSPV', compact('getSpv', 'getClient', 'getExistClient', 'spvExist', 'get_kel_jabatan'));
  }

  public function changeSPV(Request $request)
  {
    // dd($request);
    $change = DB::table('data_pkwt')
                  ->join('cabang_client', 'cabang_client.id', '=', 'data_pkwt.id_cabang_client')
                  ->join('master_client', 'cabang_client.id_client', '=', 'master_client.id')
                  ->where('data_pkwt.id_kelompok_jabatan', $request->spv_lama)
                  ->where('master_client.id', $request->id_client)
                  ->where('data_pkwt.status_pkwt', '1')
                  ->where('data_pkwt.flag_terminate', '1')
                  ->update(['data_pkwt.id_kelompok_jabatan' => $request->new_spv]);

    $getClient  = MasterClient::get();

    $getExistClient = MasterClient::where('id', $request->id_client)->get();

    return redirect()->route('spv-manajemen')->with('message', 'SPV Berhasil Digantikan.');
  }
}
