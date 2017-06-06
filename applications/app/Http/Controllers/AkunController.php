<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
Use Hash;
use DB;
use Image;
use Validator;
use App\Models\MasterPegawai;
use App\Models\MasterUsers;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $getuser = MasterUsers::all();

      return view('pages/tambahakun')
        ->with('getuser', $getuser);
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
        'email.required' => 'Anda harus mengisi email',
        'username.required' => 'Username harus diisi',
        'username.unique' => 'Username sudah dipakai',
        'password.required' => 'Password harus diisi',
        'password.confirmed' => 'Konfirmasi password tidak valid',
        'level.required' => 'Anda harus memilih Level Akses',
        'nama.required' => 'Anda harus mengisi nama',
        'password_confirmation.required' => 'Konfirmasi password harus diisi',
      ];

      $validator = Validator::make($request->all(), [
            'username' => 'required|unique:master_users',
            'password' => 'required|confirmed',
            'email' => 'required',
            'level' => 'required',
            'nama' => 'required',
            'password_confirmation' => 'required',
        ], $messages);

      if ($validator->fails()) {
          return redirect()->route('useraccount.create')
                      ->withErrors($validator)
                      ->withInput();
        }

      $user = new MasterUsers;
      $user->nama = $request->nama;
      $user->username = $request->username;
      $user->password = Hash::make($request->password);
      $user->email = $request->email;
      $user->login_count = 1;
      $user->level = $request->level;
      $user->save();

      return redirect()->route('useraccount.create');
    }


    public function delete($id)
    {
      $get = MasterUsers::find($id);
      $get->delete();

      return redirect()->route('useraccount.create')->with('message', 'Berhasil menghapus akun.');
    }

    public function kelolaprofile($id)
    {
      $get = MasterUsers::find($id);
      return view('pages/kelolaprofile')->with('getuser', $get);
    }

    public function updateprofile(Request $request)
    {
      $file = $request->file('url_foto');
      if ($file!="") {
        $photo_name = time(). '.' . $file->getClientOriginalExtension();
        Image::make($file)->fit(160,160)->save('images/'. $photo_name);

        $setfoto = MasterUsers::where('id', $request->id)->first();
        $setfoto->url_foto = $photo_name;
        $set->nama = $request->name;
        $setfoto->update();
      } else {
        $set = MasterUsers::find($request->id);
        $set->nama = $request->name;
        $set->update();
      }

      $users = MasterUsers::where('id', $request->id)->first();


      return redirect()->route('kelola.profile', $users->id)->with('message', 'Berhasil mengubah profile.');
    }

    public function updatepassword(Request $request)
    {
      $get = MasterUsers::find($request->id);

      if(Hash::check($request->oldpassword, $get->password)) {
        $messages = [
          'oldpassword.required' => 'Password lama harus diisi.',
          'password.required' => 'Password baru harus diisi.',
          'password_confirmation.required' => 'Konfirmasi password baru harus diisi.',
          'password.confirmed' => 'Konfirmasi password tidak valid.',
        ];

        $validator = Validator::make($request->all(), [
          'oldpassword' => 'required',
          'password' => 'required|confirmed',
          'password_confirmation' => 'required'
        ], $messages);

        if ($validator->fails()) {
          return redirect()->route('kelola.profile', $request->id)
          ->withErrors($validator)
          ->with('messagefail', 'Terjadi kesalahan dalam perubahan password.')
          ->withInput();
        }

        $get->password = Hash::make($request->password);
        $get->save();

        return redirect()->route('kelola.profile', $request->id)
        ->with('message', 'Berhasil melakukan perubahan password.');
      } else {
        return redirect()->route('kelola.profile', $request->id)
          ->with('messagefail', 'Password lama tidak valid.');
      }
    }
}
