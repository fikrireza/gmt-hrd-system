<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Datatables;
use App\Http\Requests;
use App\Models\PeriodeGaji;
use App\Models\BatchPayroll;
use App\Models\KomponenGaji;
use App\Models\DetailPeriodeGaji;
use App\Models\DetailBatchPayroll;

class BatchPayrollController extends Controller
{
  public function index()
  {
    $getperiode = PeriodeGaji::all();
    $getbatch = BatchPayroll::select('batch_payroll.id as id', 'periode_gaji.tanggal', 'batch_payroll.tanggal_proses')->join('periode_gaji', 'batch_payroll.id_periode_gaji', '=', 'periode_gaji.id')->paginate(10);
    return view('pages/kelolabatch')
      ->with('getperiode', $getperiode)
      ->with('getbatch', $getbatch);
  }

  public function store(Request $request)
  {
    $getyearmonth = substr($request->tanggal_proses, 0, 7);
    $check = BatchPayroll::where('tanggal_proses', 'like', "$getyearmonth%")
                          ->where('id_periode_gaji', $request->periode)->get();

    if ($check->count()==0) {
      $set = new BatchPayroll;
      $set->id_periode_gaji = $request->periode;
      $set->tanggal_proses = $request->tanggal_proses;
      $set->save();

      $getlatestid = BatchPayroll::select('id')->orderby('id', 'desc')->first();
      $getidpegawai = DetailPeriodeGaji::select('id_pegawai')->where('id_periode_gaji', $request->periode)->get();

      foreach ($getidpegawai as $key) {
        $set = new DetailBatchPayroll;
        $set->id_batch_payroll = $getlatestid->id;
        $set->id_pegawai = $key->id_pegawai;
        $set->save();
      }
    } else {
      return redirect()->route('batchpayroll.index')->with('messagefail', 'Data Batch Payroll bulan ini telah di generate.');
    }

    return redirect()->route('batchpayroll.index')->with('message', 'Berhasil generate batch payroll.');
  }

  public function detail($id)
  {
    $getbatch = BatchPayroll::join('periode_gaji', 'batch_payroll.id_periode_gaji', '=', 'periode_gaji.id')->first();
    $getkomponengaji = KomponenGaji::all();
    return view('pages/detailbatchpayroll')
      ->with('idbatch', $id)
      ->with('getkomponengaji', $getkomponengaji)
      ->with('getbatch', $getbatch);
  }

  public function getdatafordatatable($id)
  {
    $getdetailbatch = DetailBatchPayroll::
            select(['master_pegawai.id as id', 'master_pegawai.nip', 'master_pegawai.nama', 'master_jabatan.nama_jabatan', DB::raw("if(master_pegawai.status = 1, 'Aktif', 'Tidak Aktif') as status"), DB::raw("if(detail_komponen_gaji.id_komponen_gaji IS NULL, 'Belum Di Set', 'Sudah Di Set') as komponen_gaji")])
            ->leftjoin('detail_komponen_gaji', 'detail_batch_payroll.id', '=', 'detail_komponen_gaji.id_detail_batch_payroll')
            ->join('master_pegawai', 'master_pegawai.id', '=', 'detail_batch_payroll.id_pegawai')
            ->join('batch_payroll', 'batch_payroll.id', '=', 'detail_batch_payroll.id_batch_payroll')
            ->join('master_jabatan', 'master_pegawai.id_jabatan', '=', 'master_jabatan.id')
            ->where('detail_batch_payroll.id_batch_payroll', $id)
            ->groupby('detail_batch_payroll.id_pegawai')
            ->get();

    return Datatables::of($getdetailbatch)
      ->addColumn('action', function($user){
        return '<span data-toggle="tooltip" title="Set Komponen Gaji"> <a href="" class="btn btn-xs btn-warning addkomponen" data-toggle="modal" data-target="#myModal" data-value="'.$user->id.'"><i class="fa fa-list-ul"></i></a></span> <span data-toggle="tooltip" title="Hapus Dari Batch"> <a href="" class="btn btn-xs btn-danger hapus" data-toggle="modal" data-target="#myModalDelete" data-value="'.$user->id.'"><i class="fa fa-close"></i></a></span>';
      })
      ->editColumn('status', function($user){
        if ($user->status=="Aktif") {
          return "<span class='badge bg-green'>Aktif</span>";
        } else {
          return "<span class='badge bg-red'>Tidak Aktif</span>";
        }
      })
      ->editColumn('komponen_gaji', function($user){
        if ($user->komponen_gaji=="Belum Di Set") {
          return "<span class='badge bg-red' id='statuskomponen$user->id'>Belum Di Set</span>";
        } else {
          return "<span class='badge bg-green' id='statuskomponen$user->id'>Sudah Di Set</span>";
        }
      })
      ->removeColumn('id')
      ->make();
  }
}
