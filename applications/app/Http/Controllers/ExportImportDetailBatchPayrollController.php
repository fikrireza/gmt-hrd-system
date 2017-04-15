<?php

namespace App\Http\Controllers;

use App\Models\DetailBatchPayroll;
use Illuminate\Http\Request;
use Excel;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;
use Illuminate\Support\Facades\Input;

class ExportImportDetailBatchPayrollController extends Controller
{
  public function export($idbatch) {
    $getbatchpayroll = DetailBatchPayroll::
      select('detail_batch_payroll.id', 'master_pegawai.nip', 'master_pegawai.nama')
      ->join('master_pegawai', 'detail_batch_payroll.id_pegawai', '=', 'master_pegawai.id')
      ->where('detail_batch_payroll.id_batch_payroll', $idbatch)
      ->get();

    $generateabsentemplate = array();
    foreach ($getbatchpayroll as $key) {
      $rowdata = array();
      $rowdata['id'] = $key->id;
      $rowdata['nip'] = $key->nip;
      $rowdata['nama'] = $key->nama;
      $rowdata['alpa'] = 0;
      $rowdata['sakit'] = 0;
      $rowdata['izin'] = 0;

      $generateabsentemplate[] = $rowdata;
    }

    Excel::create('GMT-Batch-Payroll-Template', function($excel) use($generateabsentemplate) {

      /// --- SHEET ABSENSI ---
      $excel->sheet('Absensi Pegawai', function($sheet) use($generateabsentemplate) {
        $sheet->row(1, array('SYSTEM ID', 'NIP', 'NAMA', 'ALPA', 'SAKIT', 'IZIN'));
        $sheet->cells('A1:F1', function($cells){
          $cells->setBackground('#3c8dbc');
          $cells->setFontColor('#ffffff');
        });
        $sheet->fromArray($generateabsentemplate, null, 'A2', true, false);
      });
      /// --- END OF SHEET ABSENSI ---


      $excel->sheet('Penerimaan Variable', function($sheet) {
      });
      $excel->sheet('Potongan Variable', function($sheet) {
      });
      $excel->sheet('Nominal Lembur', function($sheet) {
      });
    })->export('xls');
  }

  public function import() {
    $timestamps = date('Y-m-d h:m:s');

    if(Input::hasFile('filecsv')){
      $path = Input::file('filecsv')->getRealPath();
			$data = Excel::selectSheets('Absensi Pegawai')->load($path, function($reader) {})->get();
      $counter = 0;
      if(!empty($data) && $data->count()){
        foreach ($data as $key) {
          $counter++;
          $set = DetailBatchPayroll::find($key->id);
        }
        return $counter;
      }
    } else {
      return "gada";
    }
  }
}
