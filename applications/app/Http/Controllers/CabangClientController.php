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
      //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CabangClientRequest $request)
    {
      $save = $request->all();
      CabangClient::create($save);

      return back()->with('tambah', 'Berhasil Menambah Cabang Client Baru');
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
      $CabangEdit = CabangClient::findOrFail($id);
      $MasterClient = MasterClient::where('id', '=', $CabangEdit->id_client)->first();
      $CabangClient = CabangClient::where('id_client', '=', $MasterClient->id)->paginate(10);
      return view('pages/MasterClient/cabangclient', compact('CabangEdit','CabangClient','MasterClient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, CabangClientRequest $request)
    {
      $cabangClient = CabangClient::find($id);
      $lempar = $cabangClient->id_client;
      $cabangClient->update($request->all());

      return redirect('masterclient/cabang/'.$lempar)->with('ubah', 'Berhasil Mengubah Cabang Client');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
