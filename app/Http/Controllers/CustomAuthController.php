<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Illuminate\Http\RedirectResponse;
use App\MasterPegawai;

class CustomAuthController extends Controller
{
  public function gotodashboard()
  {
    // $id = Auth::user()->pegawai_id;
    // $getpegawai = MasterPegawai::where('id', $id)->first();
    // return view('pages.dashboard')->with('getpegawai', $getpegawai);
    return view('pages.dashboard');
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
