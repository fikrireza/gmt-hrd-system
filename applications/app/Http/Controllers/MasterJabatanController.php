<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MasterJabatanRequest;
use App\Http\Requests\MasterJabatanEditRequest;
use App\Http\Requests;
use App\Models\MasterJabatan;
use DB;

class MasterJabatanController extends Controller
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
        // return view('pages/tambahbahasaasing');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getjabatan = MasterJabatan::where('status', 1)->orderBy('kode_jabatan', 'ASC')->paginate(10);

        $getjabatan2 = MasterJabatan::get();
        $get = array();
        $kode = 0;
        foreach ($getjabatan2 as $key) {
          $get[$kode] = $key->kode_jabatan;
          $kode++;
        }
          if ($kode != 0) {
             $kodegenerate = $kode + 1;
             $kodegenerate = "JB".str_pad($kodegenerate, 3, "0", STR_PAD_LEFT);
          } else {
              $kodegenerate = "JB001";
          }

        $data['getjabatan'] = $getjabatan;
        $data['kodegenerate'] = $kodegenerate;
        return view('pages/tambahjabatan')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterJabatanRequest $request)
    {
        $jabatan = new MasterJabatan;
        $jabatan->kode_jabatan = $request->kode_jabatan;
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->save();

        return redirect()->route('masterjabatan.create')->with('message', 'Data jabatan berhasil dimasukkan.');
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
        $getjabatan = MasterJabatan::where('status', 1)->paginate(10);
        $data['getjabatan'] = $getjabatan;
        $bindjabatan = MasterJabatan::find($id);
        $data['bindjabatan'] = $bindjabatan;
        return view('pages/tambahjabatan')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MasterJabatanEditRequest $request, $id)
    {
        $newchanges = MasterJabatan::find($id);
        $newchanges->kode_jabatan = $request->kode_jabatan;
        $newchanges->nama_jabatan = $request->nama_jabatan;
        $newchanges->save();

        return redirect()->route('masterjabatan.create')->with('message', 'Data jabatan berhasil diubah.');
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

    public function hapusJabatan($id)
    {
      $updatestatus = MasterJabatan::find($id);
      $updatestatus->status = 0;
      $updatestatus->save();

      return redirect()->route('masterjabatan.create')->with('message', 'Berhasil menghapus data jabatan.');
    }
}
