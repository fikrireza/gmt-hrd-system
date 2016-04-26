<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\MasterClientRequest;
use App\Models\MasterClient;
use App\Models\CabangClient;
use App\Models\DepartemenCabang;

class MasterClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MasterClient = MasterClient::latest('updated_at')->get();

        return view('pages/MasterClient/index', compact('MasterClient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/MasterClient/tambahclient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterClientRequest $request)
    {
        $masterClient = new MasterClient;
        $masterClient->kode_client = $request->kode_client;
        $masterClient->nama_client = $request->nama_client;
        $masterClient->save();

        return redirect('masterclient')->with('tambah', 'Berhasil Menambah Client Baru');
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
    * Display the Client From Cabang
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function cabang_client_show($id)
    {
        $MasterClient = MasterClient::where('id', '=', $id)->first();
        $CabangClient = CabangClient::where('id_client', '=', $id)->paginate(2);

        return view('pages/MasterClient/cabangclient', compact('MasterClient','CabangClient'));
    }

    /**
    * Display the Client From Cabang
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function departemen_client_show($id)
    {
        $CabangClient = CabangClient::where('id', '=', $id)->first();
        $DepartemenCabang = DepartemenCabang::where('id_cabang', '=', $id)->paginate(2);

        return view('pages/MasterClient/departemencabang', compact('CabangClient', 'DepartemenCabang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $MasterClient = MasterClient::findOrFail($id);

        return view('pages/MasterClient/editclient', compact('MasterClient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, MasterClientRequest $request)
    {
        $MasterClient = MasterClient::findOrFail($id);

        $masterClient = array(
          'kode_client' => $request->get('kode_client'),
          'nama_client' => $request->get('nama_client'),
        );
        $MasterClient->update($masterClient);

        return redirect('masterclient')->with('update', 'Berhasil Mengubah Data Client');

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
