<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\DepartemenCabangRequest;
use App\Models\MasterClient;
use App\Models\CabangClient;
use App\Models\DepartemenCabang;

class DepartemenCabangController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/MasterClient/tambahdepartemencabang');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartemenCabangRequest $request)
    {
        $DepartemenCabang = new DepartemenCabang;
        $DepartemenCabang->kode_departemen = $request->kode_departemen;
        $DepartemenCabang->nama_departemen = $request->nama_departemen;
        $DepartemenCabang->id_cabang = $request->id_cabang;
        $DepartemenCabang->save();

        return back()->with('status', 'Berhasil Menambah Departemen Baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
      $DepartemenEdit = DepartemenCabang::findOrFail($id);
      $CabangClient     = CabangClient::where('id', '=', $DepartemenEdit->id_cabang)->first();
      $DepartemenCabang = DepartemenCabang::where('id_cabang', '=', $CabangClient->id)->paginate(10);

      return view('pages/MasterClient/departemencabang', compact('DepartemenEdit','CabangClient','DepartemenCabang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, DepartemenCabangRequest $request)
    {
      $DepartemenCabang = DepartemenCabang::find($id);
      $DepartemenCabang->update($request->all());

      return redirect()->action('DepartemenCabangController@edit', ['id' => $id]); 
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
