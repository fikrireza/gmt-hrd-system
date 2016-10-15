<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Auth;
use App\Models\User;
use App\Models\PKWT;
use App\Models\MasterPegawai;
use App\Models\MasterClient;

use App\Http\Requests;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('isAdmin');
    }

    public function gotodashboard()
    {
      $id = Auth::user()->pegawai_id;
      $getpegawai = MasterPegawai::where('id', $id)->first();

      $jumlah_pegawai = MasterPegawai::where('status' , '1')->count();
      $jumlah_client = MasterClient::count();
      $jumlah_pkwt_expired = PKWT::where('tanggal_akhir_pkwt', '<', Carbon::now())->count();
      $jumlah_pkwt = PKWT::all();

      $jumlah_pkwt_menuju_expired=0;
      foreach ($jumlah_pkwt as $key) {
        $tgl = explode('-', $key->tanggal_akhir_pkwt);
        $tglakhir = Carbon::createFromDate($tgl[0], $tgl[1], $tgl[2]);
        $now = gmdate("Y-m-d", time()+60*60*7);
        $tglskrg = explode('-', $now);
        $result = Carbon::createFromDate($tglskrg[0],$tglskrg[1],$tglskrg[2])->diffInDays($tglakhir, false);
        if($result > 0 && $result < 30) {
          $jumlah_pkwt_menuju_expired++;
        }
      }

      return view('pages.dashboard', compact('getpegawai', 'jumlah_pegawai', 'jumlah_client', 'jumlah_pkwt_expired', 'jumlah_pkwt_menuju_expired'));
    }
}
