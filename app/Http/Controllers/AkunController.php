<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MasterPegawai;
use App\User;
Use Hash;
use DB;
use Image;
use Validator;

class AkunController extends Controller
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
      $messages = [
        'nip.required' => 'Anda harus memilih NIP',
        'username.required' => 'Username harus diisi',
        'password.required' => 'Password harus diisi',
        'password.confirmed' => 'Konfirmasi password tidak valid',
        'level.required' => 'Anda harus memilih Level Akses',
        'password_confirmation.required' => 'Konfirmasi password harus diisi',
      ];

      $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
            'level' => 'required',
            'password_confirmation' => 'required',
        ], $messages);

      if ($validator->fails()) {
          return redirect()->route('useraccount.create')
                      ->withErrors($validator)
                      ->withInput();
        }

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

    public function kelolaprofile($id)
    {
      $get = User::find($id);
      return view('pages/kelolaprofile')->with('getuser', $get);
    }

    public function updateprofile(Request $request)
    {
      $file = $request->file('url_foto');
      if ($file!="") {
        $photo_name = time(). '.' . $file->getClientOriginalExtension();
        Image::make($file)->fit(160,160)->save('images/'. $photo_name);

        $set = MasterPegawai::find($request->id);
        $set->nama = $request->name;
        $set->save();

        $setfoto = User::where('pegawai_id', $request->id)->first();
        $setfoto->url_foto = $photo_name;
        $setfoto->save();
      } else {
        $set = MasterPegawai::find($request->id);
        $set->nama = $request->name;
        $set->save();
      }

      return redirect()->route('kelola.profile', $request->id)->with('message', 'Berhasil mengubah profile.');
    }
}
