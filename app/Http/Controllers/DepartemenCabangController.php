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
        //
    }
}
