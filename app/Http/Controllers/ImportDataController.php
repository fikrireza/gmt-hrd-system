<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use DB;

use App\Http\Requests;
use App\MasterPegawai;
use App\MasterJabatan;
use App\PKWT;

use Excel;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;

class ImportDataController extends Controller
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
    return view('pages.MasterPegawai.importView');
  }

  public function downloadExcel($type)
  {
    $jabatan = MasterJabatan::select('nama_jabatan', 'id')->get()->toArray();
    // dd($jabatan);
    return Excel::create('Template Import Data Pegawai', function($excel) use($jabatan){
      $excel->sheet('Data-Import', function($sheet){
        $sheet->setOrientation('landscape');
        $sheet->row(1, array('nip', 'no_ktp', 'no_kk', 'no_npwp', 'nama', 'tanggal_lahir', 'jenis_kelamin', 'email', 'alamat', 'agama', 'no_telp', 'status_pajak', 'kewarganegaraan', 'bpjs_kesehatan', 'bpjs_ketenagakerjaan', 'no_rekening', 'nama_darurat', 'alamat_darurat', 'hubungan_darurat', 'telepon_darurat', 'id_jabatan', 'status'));
        $sheet->setColumnFormat(array(
          'F' => 'yyyy-mm-dd',
        ));
      });

      $excel->sheet('keterangan', function($sheet){
        $sheet->row(1, array('tanggal_lahir', 'yyyy-mm-dd'));

        $sheet->row(3, array('keterangan', 'kode_input'));
        $sheet->row(4, array('Laki-Laki', 'L'));
        $sheet->row(5, array('Permpuan', 'P'));

        $sheet->row(7, array('keterangan', 'kode_agama'));
        $sheet->row(8, array('Islam', 'Islam'));
        $sheet->row(9, array('Kristen', 'Kristen'));
        $sheet->row(10, array('Hindu', 'Hindu'));
        $sheet->row(11, array('Budha', 'Budha'));
        $sheet->row(12, array('Lainnya', 'Lainnya'));

        $sheet->row(14, array('keterangan', 'status_pajak'));
        $sheet->row(15, array('Tidak Kawin', 'TK/0'));
        $sheet->row(16, array('Kawin', 'K/0'));
        $sheet->row(17, array('Kawin Anak 1', 'K/1'));
        $sheet->row(18, array('Kawin Anak 2', 'K/2'));
        $sheet->row(19, array('Kawin Anak 3', 'K/3'));

        $sheet->row(21, array('keterangan', 'kewarganegaraan'));
        $sheet->row(22, array('Warga Negara Indonesia', 'WNI'));
        $sheet->row(23, array('Warga Negara Asing', 'WNA'));

        $sheet->cells('A1', function($cells){
          $cells->setBackground('#000000');
          $cells->setFontColor('#ffffff');
          $cells->setFontWeight('bold');
        });

        $sheet->cells('A3:B3', function($cells){
          $cells->setBackground('#000000');
          $cells->setFontColor('#ffffff');
          $cells->setFontWeight('bold');
        });

        $sheet->cells('A7:B7', function($cells){
          $cells->setBackground('#000000');
          $cells->setFontColor('#ffffff');
          $cells->setFontWeight('bold');
        });

        $sheet->cells('A14:B14', function($cells){
          $cells->setBackground('#000000');
          $cells->setFontColor('#ffffff');
          $cells->setFontWeight('bold');
        });

        $sheet->cells('A21:B21', function($cells){
          $cells->setBackground('#000000');
          $cells->setFontColor('#ffffff');
          $cells->setFontWeight('bold');
        });

      });

      $excel->sheet('id_jabatan', function($sheet) use($jabatan)
      {
        $sheet->fromArray($jabatan, null, 'A1', true);
        $sheet->row(1, array('nama_jabatan','id_jabatan'));
        $sheet->setAllBorders('thin');
        $sheet->setFreeze('A1');

        $sheet->cells('A1:B1', function($cells){
          $cells->setBackground('#000000');
          $cells->setFontColor('#ffffff');
          $cells->setFontWeight('bold');
        });
      });
    })->download($type);
  }

  public function proses(Request $request)
  {
    //
  }

}
