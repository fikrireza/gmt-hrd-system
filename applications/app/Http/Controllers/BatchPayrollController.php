<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\PeriodeGaji;
use App\Models\BatchPayroll;

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
    } else {
      return redirect()->route('batchpayroll.index')->with('messagefail', 'Data Batch Payroll bulan ini telah di generate.');
    }

    return redirect()->route('batchpayroll.index')->with('message', 'Berhasil generate batch payroll.');
  }
}
