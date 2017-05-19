<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use DB;
use App\Http\Requests\CabangClientRequest;
use App\Models\MasterClient;
use App\Models\CabangClient;

class CabangClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }


    public function store(CabangClientRequest $request)
    {
      $save = $request->all();
      CabangClient::create($save);

      return back()->with('tambah', 'Berhasil Menambah Cabang Client Baru');
    }


    public function edit($id)
    {
      $CabangEdit = CabangClient::findOrFail($id);
      $MasterClient = MasterClient::where('id', '=', $CabangEdit->id_client)->first();
      $CabangClient = CabangClient::where('id_client', '=', $MasterClient->id)->paginate(10);
      return view('pages/MasterClient/cabangclient', compact('CabangEdit','CabangClient','MasterClient'));
    }


    public function update($id, CabangClientRequest $request)
    {
      $cabangClient = CabangClient::find($id);
      $lempar = $cabangClient->id_client;
      $cabangClient->update($request->all());

      return redirect('masterclient/cabang/'.$lempar)->with('ubah', 'Berhasil Mengubah Cabang Client');
    }

}
