<?php

namespace App\Http\Controllers;

use Excel;
use Illuminate\Http\Request;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;
use Illuminate\Support\Facades\Input;

use App\Models\DetailBatchPayroll;
use App\Models\DetailKomponenGaji;
use App\Models\KomponenGaji;

class ExportImportDetailBatchPayrollController extends Controller
{
  public function export($idbatch) {
    $getbatchpayroll = DetailBatchPayroll::
      select('detail_batch_payroll.id', 'master_pegawai.nip', 'master_pegawai.nama')
      ->join('master_pegawai', 'detail_batch_payroll.id_pegawai', '=', 'master_pegawai.id')
      ->where('detail_batch_payroll.id_batch_payroll', $idbatch)
      ->get();

    $getkomponengaji = KomponenGaji::
      select('id', 'nama_komponen')
      ->where('tipe_komponen_gaji', 1)
      ->where('tipe_komponen', 'D')
      ->where('flag_status', 1)
      ->get();

    $generateabsenpegawai = array();
    $generatepenerimaanvariable = array();
    foreach ($getbatchpayroll as $key) {
      $rowdata = array();
      $rowdata['id'] = $key->id;
      $rowdata['nip'] = $key->nip;
      $rowdata['nama'] = $key->nama;
      $rowdata['alpa'] = 0;
      $rowdata['sakit'] = 0;
      $rowdata['izin'] = 0;
      $generateabsenpegawai[] = $rowdata;

      $rowgaji = array();
      $rowgaji['id'] = $key->id;
      $rowgaji['nip'] = $key->nip;
      $rowgaji['nama'] = $key->nama;
      foreach ($getkomponengaji as $gkj) {
        $rowgaji["$gkj->nama_komponen"] = 0;
      }
      $generatepenerimaanvariable[] = $rowgaji;
    }

    Excel::create('GMT-Batch-Payroll-Template', function($excel) use($generateabsenpegawai, $generatepenerimaanvariable, $getkomponengaji) {
      /// --- SHEET ABSENSI ---
      $excel->sheet('Absensi Pegawai', function($sheet) use($generateabsenpegawai) {
        $sheet->row(1, array('SYSTEM ID', 'NIP', 'NAMA', 'ALPA', 'SAKIT', 'IZIN'));
        $sheet->cells('A1:F1', function($cells) {
          $cells->setBackground('#3c8dbc');
          $cells->setFontColor('#ffffff');
        });
        $sheet->fromArray($generateabsenpegawai, null, 'A2', true, false);
      });
      /// --- END OF SHEET ABSENSI ---

      /// --- SHEET PENERIMAAN VARIABLE ---
      $excel->sheet('Penerimaan Variable', function($sheet) use($generatepenerimaanvariable, $getkomponengaji) {
        $colgajivariable = array();
        $colgajivariable[] = "SYSTEM_ID";
        $colgajivariable[] = "NIP";
        $colgajivariable[] = "NAMA";
        $count = 0;
        foreach ($getkomponengaji as $key) {
          $colgajivariable[] = $key->id." // ".$key->nama_komponen;
          $count++;
        }
        $header = $count+2;
        $alphabeth = [
          'A', 'B', 'C', 'D', 'E', 'F', 'G',
          'H', 'I', 'J', 'K', 'L', 'M', 'N',
          'O', 'P', 'Q', 'R', 'S', 'T', 'U',
          'V', 'W', 'X', 'Y', 'Z'
        ];
        $sheet->row(1, $colgajivariable);
        $sheet->cells("A1:$alphabeth[$header]1", function($cells){
          $cells->setBackground('#3c8dbc');
          $cells->setFontColor('#ffffff');
        });
        $sheet->fromArray($generatepenerimaanvariable, null, 'A2', true, false);
      });
      /// --- END OF SHEET PENERIMAAN VARIABLE ---

      $excel->sheet('Potongan Variable', function($sheet) {
      });
      $excel->sheet('Nominal Lembur', function($sheet) {
      });
    })->export('xls');
  }

  public function import() {
    $timestamps = date('Y-m-d h:m:s');
    $idbatch = 0;
    if(Input::hasFile('filecsv')) {
      $path = Input::file('filecsv')->getRealPath();

      // --- IMPORT SHEET ABSENSI ---
      $dataabsensi = Excel::selectSheets('Absensi Pegawai')->load($path, function($reader) {})->get();
      if(!empty($dataabsensi) && $dataabsensi->count()){
        foreach ($dataabsensi as $key) {
          if ($key->system_id!=null) {
            $set = DetailBatchPayroll::find($key->system_id);
            $set->abstain = $key->alpa;
            $set->sick_leave = $key->sakit;
            $set->permissed_leave = $key->izin;
            $set->save();
            $idbatch = $set->id_batch_payroll;
          }
        }
      }
      // --- IMPORT SHEET ABSENSI ---

      // --- IMPORT GAJI VARIABLE ---
      $datagajivariable = Excel::selectSheets('Penerimaan Variable')->load($path, function($reader) {})->get()->toArray();
      if(!empty($datagajivariable && $dataabsensi->count())) {
        foreach ($datagajivariable as $key) {
          $x = array_keys($key);
          $y = array_values($key);
          for ($i=3; $i < count($x); $i++) {
            if ($key["system_id"]!=null) {
              if ($y[$i]!=0) {
                $idexplode = explode("_", $x[$i]);
                $set = new DetailKomponenGaji;
                $set->id_detail_batch_payroll = $key["system_id"];
                $set->id_komponen_gaji = $idexplode[0];
                $set->nilai = $y[$i];
                $set->save();
              }
            }
          }
        }
      }
      // --- END OF IMPORT GAJI VARIABLE ---
    } else {
      return "Sorry error..";
    }

    return redirect()->route('batchpayroll.detail', $idbatch)->with('message', 'Berhasil melakukan import data.');
  }
}
