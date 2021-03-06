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
      $CountAll = DB::table('master_client')
          ->select(DB::raw('IFNULL(count(cabang_client.id_client),0) as hitungCabang, master_client.*'))
          ->leftjoin('cabang_client', 'cabang_client.id_client' , '=', 'master_client.id')
          ->groupBy('master_client.id')
          ->latest('master_client.updated_at')
          ->paginate(12);
      return view('pages/MasterClient/index', compact('CountAll'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $getclient = MasterClient::get();
      $get = array();
      $kode = 0;
      foreach ($getclient as $key) {
        $get[$kode] = $key->kode_jabatan;
        $kode++;
      }
        if ($kode != 0) {
           $kodegenerate = $kode + 1;
           $kodegenerate = "CL".str_pad($kodegenerate, 3, "0", STR_PAD_LEFT);
        } else {
            $kodegenerate = "CL001";
        }

        $data['kodegenerate'] = $kodegenerate;
        return view('pages/MasterClient/formClient')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterClientRequest $request)
    {
      $set = new MasterClient;
      $set->kode_client  = $request->kode_client;
      $set->nama_client  = $request->nama_client;
      $set->token        = hash('sha256', (random_bytes(32)));
      $set->save();

      return redirect('masterclient')->with('tambah', 'Berhasil Menambah Client Baru');
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

        $AutoNum   = CabangClient::latest('created_at')->first();
        if($AutoNum == null){
          $AutoNumber = '1';
        }else{
          $AutoNumber = substr($AutoNum->kode_cabang, 3)+1;
        }
        return view('pages/MasterClient/cabangclient', compact('MasterClient','CabangClient','AutoNumber'));
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
      $set = MasterClient::find($id);
      $set->kode_client  = $request->kode_client;
      $set->nama_client  = $request->nama_client;
      $set->token        = hash('sha256', (random_bytes(32)));
      $set->update();
      //
      // $MasterClient = MasterClient::findOrFail($id);
      // $MasterClient->update($request->all());

      return redirect('masterclient')->with('update', 'Berhasil Mengubah Data Client');
    }

}
