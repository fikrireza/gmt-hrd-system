<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Cuti;
use App\Models\MasterPegawai;
use App\Models\HariLibur;

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
      $getcuti = Cuti::paginate(10);
      $getpegawai  = MasterPegawai::get();
      return view('pages/params/kelolacuti', compact('getcuti', 'getpegawai'));
    }

    public function store(Request $request)
    {
      // dd($request);
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

      $getcountharilibur = HariLibur::whereBetween('libur', [$request->tanggal_mulai,$request->tanggal_akhir])->count();
      $countjumlhari = $request->jumlah_hari - $getcountharilibur;

      $dataChage = Cuti::find($request->id);
      $dataChage->jenis_cuti = $request->jenis_cuti;
      $dataChage->jumlah_hari = $countjumlhari;
      $dataChage->tanggal_mulai = $request->tanggal_mulai;
      $dataChage->tanggal_akhir = $request->tanggal_akhir;
      $dataChage->deskripsi = $request->deskripsi;
      $dataChage->berkas = $berkas_name;
      $dataChage->flag_status = $request->flag_status;
      $dataChage->id_pegawai = $request->id_pegawai;
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
