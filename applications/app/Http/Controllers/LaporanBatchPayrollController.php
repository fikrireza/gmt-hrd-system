<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PKWT;

use App\Models\Bpjs;
use App\Models\HariLibur;
use App\Models\PeriodeGaji;
use App\Models\BatchPayroll;
use App\Models\KomponenGaji;
use App\Models\MasterPegawai;
use App\Models\BatchProcessed;
use App\Models\KomponenGajiTetap;
use App\Models\DetailPeriodeGaji;
use App\Models\DetailKomponenGaji;
use App\Models\DetailBatchPayroll;
use App\Models\CabangClient;

use DB;
use Excel;


class LaporanBatchPayrollController extends Controller
{

    public function prosesSPV($id)
    {
        // Get Data Supervisi Pegawwai
        $getSPV = PKWT::join('detail_batch_payroll', 'detail_batch_payroll.id_pegawai', '=', 'data_pkwt.id_pegawai')
                        ->join('master_pegawai', 'master_pegawai.id', '=', 'data_pkwt.id_kelompok_jabatan')
                        ->select('master_pegawai.nama','detail_batch_payroll.id_pegawai', 'data_pkwt.id_kelompok_jabatan')
                        ->where('detail_batch_payroll.id_batch_payroll', $id)
                        ->orderby('data_pkwt.id_kelompok_jabatan')
                        ->groupby('master_pegawai.id')
                        ->get();

        $getAnak = PKWT::join('detail_batch_payroll', 'detail_batch_payroll.id_pegawai', '=', 'data_pkwt.id_pegawai')
                        ->join('master_pegawai', 'master_pegawai.id', '=', 'data_pkwt.id_kelompok_jabatan')
                        ->select('detail_batch_payroll.id_pegawai', 'data_pkwt.id_kelompok_jabatan')
                        ->where('detail_batch_payroll.id_batch_payroll', $id)
                        ->orderby('data_pkwt.id_kelompok_jabatan')
                        ->get();

// dd($getSPV, $getAnak);
        $getkomponengajinya = KomponenGaji::orderby('tipe_komponen', 'asc')->get();

        // Get Batch Payrol
        $getbatch = BatchPayroll::join('periode_gaji', 'batch_payroll.id_periode_gaji', '=', 'periode_gaji.id')
                                  ->where('batch_payroll.id', $id)->first();

        // Start Query Detail Gaji Karyawan
        $query1 = "SELECT pegawai.id, pegawai.nip, pegawai.nama as nama_pegawai, IFNULL(tabel_Workday.workday, 0) as Jumlah_Workday, IFNULL(tabel_Jabatan.nama_jabatan, 0) as Jabatan";
        $query2 = "FROM (select a.id, a.nip, a.nama from master_pegawai a, detail_batch_payroll where a.id = detail_batch_payroll.id_pegawai and detail_batch_payroll.id_batch_payroll = 41) as pegawai ";
        $query3 = "LEFT OUTER JOIN (SELECT d.id, d.nama, c.workday as workday FROM komponen_gaji a, detail_komponen_gaji b, detail_batch_payroll c, master_pegawai d WHERE b.id_komponen_gaji = a.id AND b.id_detail_batch_payroll = c.id AND d.id = c.id_pegawai AND c.id_batch_payroll = $id GROUP BY d.id) as tabel_Workday ON pegawai.id = tabel_Workday.id ";
        $query4 = "LEFT OUTER JOIN(SELECT b.nama_jabatan, a.id FROM master_pegawai a, master_jabatan b WHERE a.id_jabatan = b.id) as tabel_Jabatan ON pegawai.id = tabel_Jabatan.id";
        foreach ($getkomponengajinya as $komponen) {
          $replace = str_replace(' ', '_', $komponen->nama_komponen);
          $query1 .=  ",IFNULL(tabel_$replace.nilai, 0) as Jumlah_$replace ";
          $query2 .= "LEFT OUTER JOIN (SELECT d.id, d.nama, b.nilai as nilai FROM komponen_gaji a, detail_komponen_gaji b, detail_batch_payroll c, master_pegawai d WHERE b.id_komponen_gaji = a.id AND b.id_detail_batch_payroll = c.id AND d.id = c.id_pegawai AND c.id_batch_payroll = $id AND a.id = $komponen->id GROUP BY d.id) as tabel_$replace ON pegawai.id = tabel_$replace.id ";
        }
        // End Query Detail Gaji Karyawan

        $getkomponengaji = KomponenGaji::orderby('tipe_komponen', 'asc')->get();

        $hasilQuery = DB::select($query1.$query2.$query3.$query4);
        $hasilQuery = collect($hasilQuery);


        Excel::create('Proses Payrol SPV Periode -'.$getbatch->tanggal_proses.' s-d '.$getbatch->tanggal_proses_akhir, function($excel) use($getSPV,$getAnak,$getkomponengaji,$getbatch,$hasilQuery) {
          foreach ($getSPV as $spv) {
            $excel->sheet($spv->nama, function($sheet) use($spv,$getAnak,$getkomponengaji,$getbatch,$hasilQuery) {
              $sheet->loadView('pages.LaporanPayroll.spv')
                      ->with('getkomponengaji', $getkomponengaji)
                      ->with('getSPV', $spv->id_kelompok_jabatan)
                      ->with('getAnak', $getAnak)
                      ->with('getbatch', $getbatch)
                      ->with('hasilQuery', $hasilQuery);
            });
          }
        })->download('xlsx');


        return redirect()->back();
    }

    public function prosesAll($id)
    {

      $getCabangClient = DB::select("SELECT a.id, a.nama_cabang
                                      FROM cabang_client a, data_pkwt b, detail_batch_payroll c, master_pegawai d
                                      WHERE a.id = b.id_cabang_client
                                      AND c.id_pegawai = d.id
                                      AND b.id_pegawai = c.id_pegawai
                                      AND c.id_batch_payroll = $id
                                      GROUP BY a.nama_cabang");
      $getCabangClient = collect($getCabangClient);
      // dd($getCabangClient);

      $getkomponengajinya = KomponenGaji::orderby('tipe_komponen', 'asc')->get();

      // Get Batch Payrol
      $getbatch = BatchPayroll::join('periode_gaji', 'batch_payroll.id_periode_gaji', '=', 'periode_gaji.id')
                                ->where('batch_payroll.id', $id)->first();

      // Start Query Detail Gaji Karyawan
      $query1 = "SELECT pegawai.id, pegawai.nip, pegawai.nama as nama_pegawai, IFNULL(tabel_Workday.workday, 0) as Jumlah_Workday, IFNULL(tabel_Jabatan.nama_jabatan, 0) as Jabatan, IFNULL(tabel_Cabang.id_cabang, 0) as Cabang ";
      $query2 = "FROM (select a.id, a.nip, a.nama from master_pegawai a, detail_batch_payroll where a.id = detail_batch_payroll.id_pegawai and detail_batch_payroll.id_batch_payroll = 41) as pegawai ";
      $query3 = "LEFT OUTER JOIN (SELECT d.id, d.nama, c.workday as workday FROM komponen_gaji a, detail_komponen_gaji b, detail_batch_payroll c, master_pegawai d WHERE b.id_komponen_gaji = a.id AND b.id_detail_batch_payroll = c.id AND d.id = c.id_pegawai AND c.id_batch_payroll = $id GROUP BY d.id) as tabel_Workday ON pegawai.id = tabel_Workday.id ";
      $query4 = "LEFT OUTER JOIN(SELECT b.nama_jabatan, a.id FROM master_pegawai a, master_jabatan b WHERE a.id_jabatan = b.id) as tabel_Jabatan ON pegawai.id = tabel_Jabatan.id ";
      $query5 = "LEFT OUTER JOIN(SELECT a.id as id_cabang, c.id_pegawai as id_pegawai FROM cabang_client a, data_pkwt b, detail_batch_payroll c WHERE a.id = b.id_cabang_client AND b.id_pegawai = c.id_pegawai AND c.id_batch_payroll = $id) as tabel_Cabang ON pegawai.id = tabel_Cabang.id_pegawai ";
      foreach ($getkomponengajinya as $komponen) {
        $replace = str_replace(' ', '_', $komponen->nama_komponen);
        $query1 .=  ",IFNULL(tabel_$replace.nilai, 0) as Jumlah_$replace ";
        $query2 .= "LEFT OUTER JOIN (SELECT d.id, d.nama, b.nilai as nilai FROM komponen_gaji a, detail_komponen_gaji b, detail_batch_payroll c, master_pegawai d WHERE b.id_komponen_gaji = a.id AND b.id_detail_batch_payroll = c.id AND d.id = c.id_pegawai AND c.id_batch_payroll = $id AND a.id = $komponen->id GROUP BY d.id) as tabel_$replace ON pegawai.id = tabel_$replace.id ";
      }
      // End Query Detail Gaji Karyawan

      $getkomponengaji = KomponenGaji::orderby('tipe_komponen', 'asc')->get();

      $hasilQuery = DB::select($query1.$query2.$query3.$query4.$query5);
      $hasilQuery = collect($hasilQuery);
// dd($hasilQuery);



      Excel::create('Proses Payrol SPV Periode -'.$getbatch->tanggal_proses.' s-d '.$getbatch->tanggal_proses_akhir, function($excel) use($getkomponengaji,$getbatch,$hasilQuery,$getCabangClient) {
          $excel->sheet('All Payroll', function($sheet) use($getkomponengaji,$getbatch,$hasilQuery,$getCabangClient) {
            $sheet->loadView('pages.LaporanPayroll.allProses')
                    ->with('getkomponengaji', $getkomponengaji)
                    ->with('getbatch', $getbatch)
                    ->with('getCabangClient', $getCabangClient)
                    ->with('hasilQuery', $hasilQuery);
          });
      })->download('xlsx');

      return redirect()->back();
    }
}
