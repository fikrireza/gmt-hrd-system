<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\PKWT;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use App\MasterPegawai;
use App\Models\MasterClient;

class CustomAuthController extends Controller
{
  public function gotodashboard()
  {
    $id = Auth::user()->pegawai_id;
    $getpegawai = MasterPegawai::where('id', $id)->first();

    $jumlah_pegawai = MasterPegawai::count();
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

  public function loginprocess(Request $request)
  {
    if(Auth::attempt(['username'=>$request->username, 'password'=>$request->password]))
      return redirect('dashboard');
    else
      return redirect('/');
  }

  public function logoutprocess()
  {
    Auth::logout();
    return redirect('/');
  }
}
