<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Datatables;
use App\Http\Requests;
use App\Models\PeriodeGaji;
use App\Models\MasterPegawai;

class PeriodeGajiController extends Controller
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

    public function index()
    {
      $getperiode = PeriodeGaji::orderby('tanggal')->get();
      return view('pages/params/kelolaperiodegaji')->with('getperiode', $getperiode);
    }

    public function store(Request $request)
    {
      $set = new PeriodeGaji;
      $set->tanggal = $request->tanggal;
      $set->keterangan = $request->keterangan;
      $set->save();

      return redirect()->route('periodegaji.index')->with('message', 'Berhasil memasukkan periode gaji.');
    }

    public function detail($id)
    {
      $getperiode = PeriodeGaji::find($id);
      return view('pages/detailpegawaitoperiode')
        ->with('idperiode', $id)
        ->with('getperiode', $getperiode);
    }

    public function getdatafordatatable($id)
    {
      $users = MasterPegawai::select(['master_pegawai.id as id',                                                  'nip','nama','no_telp','nama_jabatan',DB::raw("if(master_pegawai.status = 1, 'Aktif', 'Tidak Aktif') as status"), 'detail_periode_gaji.id as id_periode_gaji'])
        ->join('master_jabatan','master_pegawai.id_jabatan','=', 'master_jabatan.id')
        ->join('detail_periode_gaji', 'master_pegawai.id', '=', 'detail_periode_gaji.id_pegawai')
        ->get();

      return Datatables::of($users)
        ->addColumn('action', function($user){
            return '<span data-toggle="tooltip" title="Hapus Dari Periode"> <a href="" class="btn btn-xs btn-danger hapus" data-toggle="modal" data-target="#myModal" data-value="'.$user->id_periode_gaji.'"><i class="fa fa-close"></i></a></span>';
        })
        ->editColumn('status', function($user){
          if ($user->status=="Aktif") {
            return "<span class='badge bg-green'>Aktif</span>";
          } else {
            return "<span class='badge bg-red'>Tidak Aktif</span>";
          }
        })
        ->removeColumn('id')
        ->removeColumn('id_periode_gaji')
        ->make();
    }
}
