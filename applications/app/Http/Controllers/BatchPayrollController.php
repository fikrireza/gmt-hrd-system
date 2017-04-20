<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Datatables;
use App\Http\Requests;
use App\Models\Bpjs;
use App\Models\HariLibur;
use App\Models\PeriodeGaji;
use App\Models\BatchPayroll;
use App\Models\KomponenGaji;
use App\Models\MasterPegawai;
use App\Models\BatchProcessed;
use App\Models\DetailPeriodeGaji;
use App\Models\DetailKomponenGaji;
use App\Models\DetailBatchPayroll;

use Validator;

class BatchPayrollController extends Controller
{
  public function index()
  {
    $getperiode = PeriodeGaji::all();
    $getbatch = BatchPayroll::
      select('batch_payroll.id as id', 'periode_gaji.tanggal', 'batch_payroll.tanggal_proses', 'batch_payroll.tanggal_proses_akhir', 'batch_payroll.flag_processed')
      ->join('periode_gaji', 'batch_payroll.id_periode_gaji', '=', 'periode_gaji.id')
      ->orderby('batch_payroll.id', 'desc')
      ->paginate(10);
      // dd($getbatch);

    return view('pages/kelolabatch')
      ->with('getperiode', $getperiode)
      ->with('getbatch', $getbatch);
  }

  public function store(Request $request)
  {
    $message = [
        'periode.required' => 'Wajib di isi',
        'tanggal_awal.required' => 'Wajib di isi',
        'tanggal_akhir.required' => 'Wajib di isi',
      ];

    $validator = Validator::make($request->all(), [
      'periode' => 'required',
      'tanggal_awal' => 'required',
      'tanggal_akhir' => 'required',
    ], $message);

    if($validator->fails())
    {
      return redirect()->route('batchpayroll.index')->withErrors($validator)->withInput();
    }

    //--- CHECK GENERATED BATCH ---//
    $getyearmonth1st = substr($request->tanggal_awal, 0, 7);
    $getyearmonth2st = substr($request->tanggal_akhir, 0, 7);
    $check = BatchPayroll::where('tanggal_proses', 'like', "$getyearmonth1st%")
                          ->where('tanggal_proses', 'like', "$getyearmonth2st%")
                          ->where('id_periode_gaji', $request->periode)->get();
    //--- END OF CHECK GENERATED BATCH ---//

    //--- GET HARI LIBUR ---//
    $getharilibur = HariLibur::select('libur')->whereBetween('libur', [$request->tanggal_awal, $request->tanggal_akhir])->get();
    $arrharilibur = array();
    foreach ($getharilibur as $key) {
      $arrharilibur[] = $key->libur;
    }

    //--- END OF GET HARI LIBUR ---//

    //-- GET TANGGAL SEHARUSNYA KERJA ---//
    $daterange=array();
    $idatefrom=mktime(1,0,0,substr($request->tanggal_awal,5,2), substr($request->tanggal_awal,8,2), substr($request->tanggal_awal,0,4));
    $idateto=mktime(1,0,0,substr($request->tanggal_akhir,5,2), substr($request->tanggal_akhir,8,2), substr($request->tanggal_akhir,0,4));
    if ($idateto>=$idatefrom)
    {
        array_push($daterange,date('Y-m-d',$idatefrom)); // first entry
        while ($idatefrom<$idateto)
        {
            $idatefrom+=86400; // add 24 hours
            array_push($daterange,date('Y-m-d',$idatefrom));
        }
    }
    $harikerja52 = array(); // work 5, holiday 2
    $harikerja61 = array(); // work 6, holiday 1
    foreach ($daterange as $key) {
      if ((date('N', strtotime($key)) < 6) && (!in_array($key, $arrharilibur))) {
        $harikerja52[] = $key;
      }
      if ((date('N', strtotime($key)) < 7) && (!in_array($key, $arrharilibur))) {
        $harikerja61[] = $key;
      }
      if ((date('N', strtotime($key)) < 8) && (!in_array($key, $arrharilibur))) {
        $harikerja70[] = $key;
      }
    }
    //-- END OF GET TANGGAL SEHARUSNYA KERJA ---//

    //--- GET GAJI POKOK PEGAWAI ---
    $getmasterpegawai = MasterPegawai::
      select('master_pegawai.id as id_pegawai', 'gaji_pokok', 'workday', 'id_cabang_client')
      ->join('data_pkwt', 'master_pegawai.id', '=', 'data_pkwt.id_pegawai')
      ->orderby('data_pkwt.id', 'desc')
      ->get();

    $getgajipegawai = array();
    $getworkday = array();
    foreach ($getmasterpegawai as $key) {
      $rowgajipegawai["id_pegawai"] = $key->id_pegawai;
      $rowgajipegawai["gaji_pokok"] = $key->gaji_pokok;
      $rowgajipegawai["id_cabang_client"] = $key->id_cabang_client;
      $getgajipegawai[] = $rowgajipegawai;

      $rowworkday["id_pegawai"] = $key->id_pegawai;
      $rowworkday["workday"] = $key->workday;
      $getworkday[] = $rowworkday;
    }
    //--- END OF GET GAJI POKOK PEGAWAI ---


    //--- GET BPJS ---
    $getbpjs = Bpjs::all();
    //--- END OF GET BPJS ---

    if ($check->count()==0) {
      $set = new BatchPayroll;
      $set->id_periode_gaji = $request->periode;
      $set->tanggal_proses = $request->tanggal_awal;
      $set->tanggal_proses_akhir = $request->tanggal_akhir;
      $set->save();

      $getlatestid = BatchPayroll::select('id')->orderby('id', 'desc')->first();
      $getidpegawai = DetailPeriodeGaji::select('id_pegawai')->where('id_periode_gaji', $request->periode)->get();
      $getkomponentetap = KomponenGaji::where('tipe_komponen_gaji', 0)->get();

      foreach ($getidpegawai as $key) {
        $set = new DetailBatchPayroll;
        $set->id_batch_payroll = $getlatestid->id;
        $set->id_pegawai = $key->id_pegawai;

        $workday = 0;
        foreach ($getworkday as $gwd) {
          if ($key->id_pegawai == $gwd['id_pegawai']) {
            $workday = $gwd["workday"];
            break;
          }
        }

        if ($workday=="52") {
          $set->workday = count($harikerja52);
        } else if ($workday=="61") {
          $set->workday = count($harikerja61);
        } else if ($workday=="70") {
          $set->workday = count($harikerja70);
        }
        $set->save();

        $getlatestdetailbatchid = DetailBatchPayroll::select('id')->orderby('id', 'desc')->first();

        foreach ($getkomponentetap as $tetap) {
          $set = new DetailKomponenGaji;
          $set->id_detail_batch_payroll = $getlatestdetailbatchid->id;

          $gapok = 0;
          $idcabang = 0;
          foreach ($getgajipegawai as $ggp) {
            if ($key->id_pegawai == $ggp['id_pegawai']) {
              $gapok = $ggp['gaji_pokok'];
              $idcabang = $ggp['id_cabang_client'];
              break;
            }
          }

          $set->id_komponen_gaji = $tetap->id;
          if ($tetap->id==1) {
            $set->nilai = $gapok;
          } else if ($tetap->id==9991 || $tetap->id==9992){
            $bpjskesehatan=0;
            $bpjsketenagakerjaan=0;
            foreach ($getbpjs as $bpjs) {
              if ($bpjs->id_cabang_client == $idcabang && $bpjs->id_bpjs==9991) {
                $set->nilai = $bpjs->bpjs_dibayarkan;
                break;
              } else if ($bpjs->id_cabang_client == $idcabang && $bpjs->id_bpjs==9992) {
                $set->nilai = $bpjs->bpjs_dibayarkan;
                break;
              }
            }
          } else {
            $set->nilai = 0;
          }
          $set->save();
        }
      }
    } else {
      return redirect()->route('batchpayroll.index')->with('messagefail', 'Data Batch Payroll bulan ini telah di generate.');
    }

    return redirect()->route('batchpayroll.index')->with('message', 'Berhasil generate batch payroll.');
  }

  public function detail($id)
  {
    $getdetailbatchpayroll = DetailBatchPayroll::
          select('detail_batch_payroll.id as id_detail_batch', 'master_pegawai.id', 'master_pegawai.nip', 'master_pegawai.nama', 'master_jabatan.nama_jabatan', 'detail_batch_payroll.workday', 'abstain', 'sick_leave', 'permissed_leave')
          ->join('master_pegawai', 'detail_batch_payroll.id_pegawai', '=', 'master_pegawai.id')
          ->join('master_jabatan', 'master_pegawai.id_jabatan', '=', 'master_jabatan.id')
          ->where('id_batch_payroll', $id)
          ->get();

    $getgaji = DetailKomponenGaji::
          select('id_pegawai', 'id_komponen_gaji', 'nilai', 'tipe_komponen as tipe_perhitungan', 'tipe_komponen_gaji as tipe_komponen', 'komponen_gaji.periode_perhitungan')
          ->join('komponen_gaji', 'detail_komponen_gaji.id_komponen_gaji', '=', 'komponen_gaji.id')
          ->join('detail_batch_payroll', 'detail_komponen_gaji.id_detail_batch_payroll', '=', 'detail_batch_payroll.id')
          ->where('detail_batch_payroll.id_batch_payroll', $id)
          ->orderby('id_pegawai')
          ->get();

    $rowdisplay = array();
    foreach ($getdetailbatchpayroll as $key) {
      $rowdata = array();
      $rowdata["id"] = $key->id;
      $rowdata["iddetailbatch"] = $key->id_detail_batch;
      $rowdata["nip"] = $key->nip;
      $rowdata["nama"] = $key->nama;
      $rowdata["jabatan"] = $key->nama_jabatan;
      $rowdata["harinormal"] = $key->workday;
      $rowdata["abstain"] = $key->abstain;
      $rowdata["sick_leave"] = $key->sick_leave;
      $rowdata["permissed_leave"] = $key->permissed_leave;

      $harinormal = $key->workday;
      $totaltidakmasuk = $key->abstain + $key->sick_leave + $key->permissed_leave;
      $totalkerja = $key->workday - $totaltidakmasuk;

      $rowdata["totalkerja"] = $totalkerja;

      $jmlgajitetap = 0;
      $jmlgajivariable = 0;
      $jmlpotongantetap = 0;
      $jmlpotonganvariable = 0;
      foreach ($getgaji as $gg) {
        if ($key->id == $gg->id_pegawai) {
          if ($gg->tipe_perhitungan=="D" && $gg->tipe_komponen==0) {
            if ($gg->periode_perhitungan=="Bulanan") {
              if ($gg->id_komponen_gaji==1) { // apabila gaji pokok
                $gajipokok = $gg->nilai;
                if ($totalkerja < $harinormal) {
                  $gajipokokperhari = $gajipokok / $harinormal;
                  $gajipokokperhari = ceil($gajipokokperhari);
                  if (substr($gajipokokperhari,-3)>499){
                      $gajipokokperhari=round($gajipokokperhari,-3);
                  } else {
                      $gajipokokperhari=round($gajipokokperhari,-3)+500;
                  }
                  $gajipokok = $gajipokokperhari * $totalkerja;
                }
                $jmlgajitetap += $gajipokok;
              } else {
                $jmlgajitetap += $gg->nilai;
              }
            } else if ($gg->periode_perhitungan=="Harian") {
              $jmlgajitetap += ($gg->nilai * $totalkerja);
            }
          } else if ($gg->tipe_perhitungan=="D" && $gg->tipe_komponen==1) {
            if ($gg->periode_perhitungan=="Bulanan") {
              $jmlgajivariable += $gg->nilai;
            } else if ($gg->periode_perhitungan=="Harian") {
              $jmlgajivariable += ($gg->nilai * $totalkerja);
            }
          } else if ($gg->tipe_perhitungan=="P" && $gg->tipe_komponen==0) {
            if ($gg->periode_perhitungan=="Bulanan") {
              $jmlpotongantetap += $gg->nilai;
            } else if ($gg->periode_perhitungan=="Harian") {
              $jmlpotongantetap += ($gg->nilai * $totalkerja);
            }
          } else if ($gg->tipe_perhitungan=="P" && $gg->tipe_komponen==1) {
            if ($gg->periode_perhitungan=="Bulanan") {
              $jmlpotonganvariable += $gg->nilai;
            } else if ($gg->periode_perhitungan=="Harian") {
              $jmlpotonganvariable += ($gg->nilai * $totalkerja);
            }
          }
        }
      }

      $rowdata["gajitetap"] = $jmlgajitetap;
      $rowdata["gajivariable"] = $jmlgajivariable;
      $rowdata["potongantetap"] = $jmlpotongantetap;
      $rowdata["potonganvariable"] = $jmlpotonganvariable;

      $takehomepay = ($jmlgajitetap+$jmlgajivariable) - ($jmlpotongantetap+$jmlpotonganvariable);
      $rowdata["total"] = $takehomepay;

      $rowdisplay[] = $rowdata;
    }

    $summary = array();

    $totalpotongan = 0;
    $totalpenerimaan = 0;
    $totalpengeluaran = 0;
    foreach ($rowdisplay as $key) {
      $totalpengeluaran += $key["total"];
      $totalpenerimaan += ($key["gajitetap"] + $key["gajivariable"]);
      $totalpotongan += ($key["potongantetap"] + $key["potonganvariable"]);
    }

    $getbatchpayroll = BatchPayroll::
          join('periode_gaji', 'batch_payroll.id_periode_gaji', '=', 'periode_gaji.id')
          ->where('batch_payroll.id', $id)
          ->get();

    $summary['id_periode_gaji'] = $getbatchpayroll[0]->id_periode_gaji;
    $summary['periode_gaji'] = $getbatchpayroll[0]->tanggal;
    $summary['cutoff_awal'] = $getbatchpayroll[0]->tanggal_proses;
    $summary['cutoff_akhir'] = $getbatchpayroll[0]->tanggal_proses_akhir;
    $summary["totalpegawai"] = count($rowdisplay);
    $summary["totalpenerimaan"] = $totalpenerimaan;
    $summary["totalpotongan"] = $totalpotongan;
    $summary["totalpengeluaran"] = $totalpengeluaran;

    $getbatch = BatchPayroll::join('periode_gaji', 'batch_payroll.id_periode_gaji', '=', 'periode_gaji.id')->where('batch_payroll.id', $id)->first();
    $getkomponengaji = KomponenGaji::all();
    return view('pages/detailbatchpayroll')
      ->with('idbatch', $id)
      ->with('getkomponengaji', $getkomponengaji)
      ->with('rowdisplay', $rowdisplay)
      ->with('summary', $summary)
      ->with('getbatch', $getbatch);
  }

  public function refreshrowdatatables($id)
  {
    $getdetailbatchpayroll = DetailBatchPayroll::
          select('detail_batch_payroll.id as id_detail_batch', 'master_pegawai.id', 'master_pegawai.nip', 'master_pegawai.nama', 'master_jabatan.nama_jabatan', 'detail_batch_payroll.workday', 'abstain', 'sick_leave', 'permissed_leave')
          ->join('master_pegawai', 'detail_batch_payroll.id_pegawai', '=', 'master_pegawai.id')
          ->join('master_jabatan', 'master_pegawai.id_jabatan', '=', 'master_jabatan.id')
          ->where('id_batch_payroll', $id)
          ->get();

    $getgaji = DetailKomponenGaji::
          select('id_pegawai', 'id_komponen_gaji', 'nilai', 'tipe_komponen as tipe_perhitungan', 'tipe_komponen_gaji as tipe_komponen', 'komponen_gaji.periode_perhitungan')
          ->join('komponen_gaji', 'detail_komponen_gaji.id_komponen_gaji', '=', 'komponen_gaji.id')
          ->join('detail_batch_payroll', 'detail_komponen_gaji.id_detail_batch_payroll', '=', 'detail_batch_payroll.id')
          ->orderby('id_pegawai')
          ->get();

    $rowdisplay = array();
    foreach ($getdetailbatchpayroll as $key) {
      $rowdata = array();
      $rowdata["id"] = $key->id;
      $rowdata["iddetailbatch"] = $key->id_detail_batch;
      $rowdata["nip"] = $key->nip;
      $rowdata["nama"] = $key->nama;
      $rowdata["jabatan"] = $key->nama_jabatan;
      $rowdata["harinormal"] = $key->workday;
      $rowdata["abstain"] = $key->abstain;
      $rowdata["sick_leave"] = $key->sick_leave;
      $rowdata["permissed_leave"] = $key->permissed_leave;

      $harinormal = $key->workday;
      $totaltidakmasuk = $key->abstain + $key->sick_leave + $key->permissed_leave;
      $totalkerja = $key->workday - $totaltidakmasuk;

      $rowdata["totalkerja"] = $totalkerja;

      $jmlgajitetap = 0;
      $jmlgajivariable = 0;
      $jmlpotongantetap = 0;
      $jmlpotonganvariable = 0;
      foreach ($getgaji as $gg) {
        if ($key->id == $gg->id_pegawai) {
          if ($gg->tipe_perhitungan=="D" && $gg->tipe_komponen==0) {
            if ($gg->periode_perhitungan=="Bulanan") {
              if ($gg->id_komponen_gaji==1) { // apabila gaji pokok
                $gajipokok = $gg->nilai;
                if ($totalkerja < $harinormal) {
                  $gajipokokperhari = $gajipokok / $harinormal;
                  $gajipokokperhari = ceil($gajipokokperhari);
                  if (substr($gajipokokperhari,-3)>499){
                      $gajipokokperhari=round($gajipokokperhari,-3);
                  } else {
                      $gajipokokperhari=round($gajipokokperhari,-3)+500;
                  }
                  $gajipokok = $gajipokokperhari * $totalkerja;
                }
                $jmlgajitetap += $gajipokok;
              } else {
                $jmlgajitetap += $gg->nilai;
              }
            } else if ($gg->periode_perhitungan=="Harian") {
              $jmlgajitetap += ($gg->nilai * $totalkerja);
            }
          } else if ($gg->tipe_perhitungan=="D" && $gg->tipe_komponen==1) {
            if ($gg->periode_perhitungan=="Bulanan") {
              $jmlgajivariable += $gg->nilai;
            } else if ($gg->periode_perhitungan=="Harian") {
              $jmlgajivariable += ($gg->nilai * $totalkerja);
            }
          } else if ($gg->tipe_perhitungan=="P" && $gg->tipe_komponen==0) {
            if ($gg->periode_perhitungan=="Bulanan") {
              $jmlpotongantetap += $gg->nilai;
            } else if ($gg->periode_perhitungan=="Harian") {
              $jmlpotongantetap += ($gg->nilai * $totalkerja);
            }
          } else if ($gg->tipe_perhitungan=="P" && $gg->tipe_komponen==1) {
            if ($gg->periode_perhitungan=="Bulanan") {
              $jmlpotonganvariable += $gg->nilai;
            } else if ($gg->periode_perhitungan=="Harian") {
              $jmlpotonganvariable += ($gg->nilai * $totalkerja);
            }
          }
        }
      }

      $rowdata["gajitetap"] = $jmlgajitetap;
      $rowdata["gajivariable"] = $jmlgajivariable;
      $rowdata["potongantetap"] = $jmlpotongantetap;
      $rowdata["potonganvariable"] = $jmlpotonganvariable;

      $takehomepay = ($jmlgajitetap+$jmlgajivariable) - ($jmlpotongantetap+$jmlpotonganvariable);
      $rowdata["total"] = $takehomepay;

      $rowdisplay[] = $rowdata;
    }

    return $rowdisplay;
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


  public function bind($id)
  {
    $get = BatchPayroll::find($id);
    return $get;
  }

  public function update(Request $request)
  {
    $set = BatchPayroll::find($request->id);
    $set->id_periode_gaji = $request->periode_edit;
    $set->tanggal_proses = $request->tanggal_awal_edit;
    $set->tanggal_proses_akhir = $request->tanggal_akhir_edit;
    $set->save();

    return redirect()->route('batchpayroll.index')->with('message', 'Data batch payroll berhasil diubah.');
  }

  public function delete($id)
  {
    $set = BatchPayroll::find($id);
    $set->delete();
    return redirect()->route('batchpayroll.index')->with('message', 'Berhasil menghapus data batch payroll.');
  }

  public function process($idbatch, $data)
  {
    parse_str($data, $output);

    foreach ($output as $key) {
      $set = new BatchProcessed;
      $set->id_batch_payroll = $idbatch;
      $set->id_periode = $key["id_periode_gaji"];
      $set->tanggal_proses_payroll = date("Y-m-d");
      $set->tanggal_cutoff_awal = $key["cutoff_awal"];
      $set->tanggal_cutoff_akhir = $key["cutoff_akhir"];
      $set->total_pegawai = $key["totalpegawai"];
      $set->total_penerimaan_gaji = $key["totalpenerimaan"];
      $set->total_potongan_gaji = $key["totalpotongan"];
      $set->total_pengeluaran = $key["totalpengeluaran"];
      $set->save();
    }

    $set = BatchPayroll::find($idbatch);
    $set->flag_processed = 1;
    $set->save();

    return redirect()->route('batchpayroll.detail', $idbatch)->with('message', 'Berhasil memproses batch payroll.');
  }

}
