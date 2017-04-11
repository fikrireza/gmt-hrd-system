<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Cuti;
use App\Models\MasterPegawai;
use App\Models\HariLibur;

use Validator;

class CutiController extends Controller
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

      // $getcuti = Cuti::paginate(10);
      $getcuti = Cuti::leftJoin('master_pegawai', 'master_cuti.id_pegawai', '=', 'master_pegawai.id')
                          ->select('master_cuti.*', 'master_pegawai.id as pegawai_id','master_pegawai.nip as nip','master_pegawai.nama')
                          ->paginate(10); 

      $getpegawai  = MasterPegawai::get();
      return view('pages/params/kelolacuti', compact('getcuti', 'getpegawai'));
    }

    public function store(Request $request)
    {
      $message = [
        'id_pegawai.required' => 'Wajib di isi',
        'jenis_cuti.required' => 'Wajib di isi',
        'tanggal_mulai.required' => 'Wajib di isi',
        'tanggal_akhir.required' => 'Wajib di isi',
        'deskripsi.required' => 'Wajib di isi',
        'flag_status.required' => 'Wajib di isi',
      ];

      $validator = Validator::make($request->all(), [
        'id_pegawai' => 'required',
        'jenis_cuti' => 'required',
        'tanggal_mulai' => 'required',
        'tanggal_akhir' => 'required',
        'deskripsi' => 'required',
        'flag_status' => 'required',
      ], $message);

      if($validator->fails())
      {
        return redirect()->route('cuti.index')->withErrors($validator)->withInput();
      }
      
      // --- validasi ketersediaan tanggal intervensi
      $gettanggalintervensi = Cuti::select('tanggal_mulai', 'tanggal_akhir')
                                          ->where('id_pegawai', $request->id_pegawai)
                                          ->get();

      $tanggalmulai = $request->tanggal_mulai;
      $tanggalakhir = $request->tanggal_akhir;

      $dateRange=array();
      $iDateFrom=mktime(1,0,0,substr($tanggalmulai,5,2),     substr($tanggalmulai,8,2),substr($tanggalmulai,0,4));
      $iDateTo=mktime(1,0,0,substr($tanggalakhir,5,2),     substr($tanggalakhir,8,2),substr($tanggalakhir,0,4));

      if ($iDateTo>=$iDateFrom)
      {
          array_push($dateRange,date('Y-m-d',$iDateFrom)); // first entry
          while ($iDateFrom<$iDateTo)
          {
              $iDateFrom+=86400; // add 24 hours
              array_push($dateRange,date('Y-m-d',$iDateFrom));
          }
      }

      $flagtanggal = 0;
      foreach ($dateRange as $key) {
        foreach ($gettanggalintervensi as $keys) {
          $start_ts = strtotime($keys->tanggal_mulai);
          $end_ts = strtotime($keys->tanggal_akhir);
          $user_ts = strtotime($key);

          if (($user_ts >= $start_ts) && ($user_ts <= $end_ts)) {
            $flagtanggal=1;
            break;
          }
        }
        if ($flagtanggal==1) break;
      }

      if ($flagtanggal==1) {
        return redirect()->route('cuti.index')->with('messagefail', 'Tanggal intervensi yang anda pilih telah tercatat pada database.');
      }
      // --- end of validasi ketersediaan tanggal intervensi


      $file = $request->file('berkas');

      if($file != null)
      {
        $berkas_name = time().'_'.$request->nip.'.'.$file->getClientOriginalExtension();
        $file->move('documents/', $berkas_name);
      }else{
        $berkas_name = "-";

      }

      $getcountharilibur = HariLibur::whereBetween('libur', [$request->tanggal_mulai,$request->tanggal_akhir])->count();
      $countjumlhari = $request->jumlah_hari - $getcountharilibur;

      $set = new Cuti;
      $set->jenis_cuti = $request->jenis_cuti;
      $set->jumlah_hari = $countjumlhari;
      $set->tanggal_mulai = $request->tanggal_mulai;
      $set->tanggal_akhir = $request->tanggal_akhir;
      $set->deskripsi = $request->deskripsi;
      $set->berkas = $berkas_name;
      $set->flag_status = $request->flag_status;
      $set->id_pegawai = $request->id_pegawai;
      $set->save();

      return redirect()->route('cuti.index')->with('message', 'Berhasil memasukkan intervensi.');
    }

    public function bind($id)
    {
      // $get = Cuti::find($id);
      $get = Cuti::where('master_cuti.id', $id)
                          ->leftJoin('master_pegawai', 'master_cuti.id_pegawai', '=', 'master_pegawai.id')
                          ->select('master_cuti.*', 'master_pegawai.id as pegawai_id','master_pegawai.nip as nip','master_pegawai.nama')
                          ->first(); 
      return $get;
    }

    public function update(Request $request)
    {
      $file = $request->file('berkas');

      if($file != null)
      {
        $berkas_name = time().'_'.$request->nip.'.'.$file->getClientOriginalExtension();
        $file->move('documents/', $berkas_name);
      }else{
        $berkas_name = "-";

      }

      // dd($request);

      $getcountharilibur = HariLibur::whereBetween('libur', [$request->tanggal_mulai_edit,$request->tanggal_akhir_edit])->count();
      $countjumlhari = $request->jumlah_hari_edit - $getcountharilibur;

      $dataChage = Cuti::find($request->id);
      $dataChage->jenis_cuti = $request->jenis_cuti_edit;
      $dataChage->jumlah_hari = $countjumlhari;
      $dataChage->tanggal_mulai = $request->tanggal_mulai_edit;
      $dataChage->tanggal_akhir = $request->tanggal_akhir_edit;
      $dataChage->deskripsi = $request->deskripsi_edit;
      $dataChage->berkas = $berkas_name;
      $dataChage->flag_status = $request->flag_status_edit;
      $dataChage->save();

      return redirect()->route('cuti.index')->with('message', 'Data intervensi berhasil diubah.');
    }

    public function delete($id)
    {
      $set = Cuti::find($id);
      $set->delete();
      return redirect()->route('cuti.index')->with('message', 'Berhasil menghapus data intervensi.');
    }

}
