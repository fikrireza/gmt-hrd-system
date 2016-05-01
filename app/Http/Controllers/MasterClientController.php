<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use DB;
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
        //$MasterClient = MasterClient::latest('updated_at')->get();
        $CountAll = DB::table('master_client')
            ->select(DB::raw('IFNULL(count(cabang_client.id_client),0) as hitungCabang, master_client.*'))//IFNULL(COUNT(pof.ID), 0)
            ->leftjoin('cabang_client', 'cabang_client.id_client' , '=', 'master_client.id')
            ->groupBy('master_client.id')
            ->latest('master_client.updated_at')
            ->get();
            //print_r($CountAll);
        return view('pages/MasterClient/index', compact('CountAll'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/MasterClient/formClient');
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
        $CabangClient = CabangClient::where('id_client', '=', $id)->paginate(10);

        return view('pages/MasterClient/cabangclient', compact('MasterClient','CabangClient'));
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

        return view('pages/MasterClient/formClient', compact('MasterClient'));
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
