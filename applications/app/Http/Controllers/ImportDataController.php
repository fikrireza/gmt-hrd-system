<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use DB;

use App\Http\Requests;
use App\Models\MasterPegawai;
use App\Models\MasterJabatan;
use App\Models\PKWT;

use Illuminate\Support\Facades\Input;
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
    $nip     = MasterPegawai::select('nip', 'nama')->orderBy('id', 'DESC')->take(10)->get()->toArray();

    return Excel::create('Template Import Data Pegawai', function($excel) use($jabatan, $nip)
    {
      $excel->sheet('Data-Import', function($sheet)
      {
        $sheet->setOrientation('landscape');
        $sheet->row(1, array('nip', 'nip_lama','no_ktp', 'no_kk', 'no_npwp', 'nama', 'tanggal_lahir', 'jenis_kelamin', 'email', 'alamat', 'agama', 'no_telp', 'status_pajak', 'kewarganegaraan', 'bpjs_kesehatan', 'bpjs_ketenagakerjaan', 'no_rekening', 'nama_darurat', 'alamat_darurat', 'hubungan_darurat', 'telepon_darurat', 'id_jabatan', 'status'));
        $sheet->setColumnFormat(array(
          'G' => 'yyyy-mm-dd',
          'C' => '@',
          'D' => '@',
          'E' => '@',
          'L' => '@',
          'O' => '@',
          'P' => '@',
          'Q' => '@',
          'U' => '@',
          'V' => '@',
          'W' => '@',
        ));
      });

      $excel->sheet('nip_pegawai', function($sheet) use($nip)
      {
        $sheet->row(1, array('Untuk Import Data Pegawai Di Awali Dengan NIP Terbesar + 1'));
        $sheet->mergeCells('A1:J1');
        $sheet->cells('A1:J1', function($cells){
          $cells->setBackground('#000000');
          $cells->setFontColor('#ffffff');
          $cells->setFontWeight('bold');
          $cells->setFontSize(16);
        });
        $sheet->fromArray($nip, null, 'A2', true);
        $sheet->row(2, array('nip','nama'));
        $sheet->setAllBorders('thin');
        $sheet->setFreeze('A1');

        $sheet->cells('A2:B2', function($cells){
          $cells->setBackground('#000000');
          $cells->setFontColor('#ffffff');
          $cells->setFontWeight('bold');
        });


      });

      $excel->sheet('keterangan', function($sheet)
      {
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

        $sheet->row(25, array('keterangan', 'hubungan_darurat'));
        $sheet->row(26, array('AYAH', 'AYAH'));
        $sheet->row(27, array('IBU', 'IBU'));
        $sheet->row(28, array('KAKAK', 'KAKAK'));
        $sheet->row(29, array('ADIK', 'ADIK'));
        $sheet->row(30, array('LAINNYA', 'LAINNYA'));


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

        $sheet->cells('A25:B25', function($cells){
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

  public function proses()
  {

    $timestamps = date('Y-m-d h:m:s');

    if(Input::hasFile('importPegawai')){
			$path = Input::file('importPegawai')->getRealPath();
			$data = Excel::selectSheets('Data-Import')->load($path, function($reader) {
			})->get();

			if(!empty($data) && $data->count()){
				foreach ($data as $key) {
					$insert[] = ['nip'         => $key->nip,
                       'nip_lama'    => $key->nip_lama,
                       'no_ktp'      => $key->no_ktp,
                       'no_kk'       => $key->no_kk,
                       'no_npwp'     => $key->no_npwp,
                       'nama'        => $key->nama,
                       'tanggal_lahir'=> $key->tanggal_lahir,
                       'jenis_kelamin' => $key->jenis_kelamin,
                       'email'        => $key->email,
                       'alamat'        => $key->alamat,
                       'agama'        => $key->agama,
                       'no_telp'      => $key->no_telp,
                       'status_pajak' => $key->status_pajak,
                       'kewarganegaraan' => $key->kewarganegaraan,
                       'bpjs_kesehatan' => $key->bpjs_kesehatan,
                       'bpjs_ketenagakerjaan' => $key->bpjs_ketenagakerjaan,
                       'no_rekening'  => $key->no_rekening,
                       'nama_darurat' => $key->nama_darurat,
                       'alamat_darurat'=> $key->alamat_darurat,
                       'hubungan_darurat'=> $key->hubungan_darurat,
                       'telepon_darurat'=> $key->telepon_darurat,
                       'id_jabatan'   => $key->id_jabatan,
                       'status'       => $key->status,
                       'created_at'   => $timestamps,
                       'updated_at'   => $timestamps,
                     ];
				}

				if(!empty($insert)){
					DB::table('master_pegawai')->insert($insert);
          return redirect()->route('import')->with('message', 'Berhasil Meng-Import Data Pegawai.');
				}
			}
		}

		return back()->with('error', 'Harap Pilih File Sesuai Dengan Template');
  }

}
