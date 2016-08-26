<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MasterPegawai;
use App\User;
Use Hash;
use DB;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $getpegawaiid = DB::table('users')->select('pegawai_id')->get();

      $data = array();
      foreach ($getpegawaiid as $key) {
        $data[] = $key->pegawai_id;
      }

      $getnip = MasterPegawai::whereNotIn('id', $data)->get();
      $getuser = User::all();

      return view('pages/tambahakun')
        ->with('getuser', $getuser)
        ->with('getnip', $getnip);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = new User;
      $user->username = $request->username;
      $user->password = Hash::make($request->password);
      $user->pegawai_id = $request->nip;
      $user->level = $request->level;
      $user->save();

      return redirect()->route('useraccount.create');
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

    }

    public function delete($id)
    {
      $get = User::find($id);
      $get->delete();

      return redirect()->route('useraccount.create')->with('message', 'Berhasil menghapus akun.');
    }
}
