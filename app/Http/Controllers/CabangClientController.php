<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\CabangClientRequest;
use DB;
use App\Models\MasterClient;
use App\Models\CabangClient;

class CabangClientController extends Controller
{

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
        $CabangClient = new CabangClient;
        $CabangClient->kode_cabang = $request->kode_cabang;
        $CabangClient->nama_cabang = $request->nama_cabang;
        $CabangClient->alamat_cabang = $request->alamat_cabang;
        $CabangClient->id_client = $request->id_client;
        $CabangClient->save();

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
      $cabangClient->kode_cabang = $request->kode_cabang;
      $cabangClient->nama_cabang = $request->nama_cabang;
      $cabangClient->alamat_cabang = $request->alamat_cabang;
      $cabangClient->id_client = $request->id_client;
      $cabangClient->save();

      // $cabangClient = array(
      //   'kode_cabang' => $request->get('kode_cabang'),
      //   'nama_cabang' => $request->get('nama_cabang'),
      //   'alamat_cabang' => $request->get('alamat_cabang'),
      //   'id_client' => $request->get('id_client'),
      // );
      // $CabangClient->update($cabangClient);

      //return back()->with('ubah', 'Berhasil Mengubah Data Cabang');
      //return redirect()->route('cabangclient', ['id' => $id], 'edit');
      return redirect()->action('CabangClientController@edit', ['id' => $id]);
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
