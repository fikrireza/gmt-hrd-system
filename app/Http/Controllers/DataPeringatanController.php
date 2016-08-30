<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DataPeringatan;
use App\MasterPegawai;

class DataPeringatanController extends Controller
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

    
    public function create(Request $request)
    {
      $file = $request->file('dokumen_peringatan');
      if($file==null) {
        $set = new DataPeringatan;
        $set->id_pegawai = $request->id_pegawai;
        $set->tanggal_peringatan = $request->tanggal_peringatan;
        $set->jenis_peringatan = $request->jenis_peringatan;
        $set->keterangan_peringatan = $request->keterangan_peringatan;
        $set->save();
      } else {
        $file_name = time().'.'.$file->getClientOriginalExtension();
        $file->move('documents', $file_name);

        $set = new DataPeringatan;
        $set->id_pegawai = $request->id_pegawai;
        $set->tanggal_peringatan = $request->tanggal_peringatan;
        $set->jenis_peringatan = $request->jenis_peringatan;
        $set->keterangan_peringatan = $request->keterangan_peringatan;
        $set->dokumen_peringatan = $file_name;
        $set->save();
      }

      return redirect()->route('masterpegawai.show', $request->nip)->with('message','Berhasil memasukkan data peringatan.');
    }

    public function editPeringatan(Request $request)
    {
      $file = $request->file('dokumen_peringatan');
      if($file==null) {
        $set = DataPeringatan::find($request->id);
        $set->id_pegawai = $request->id_pegawai;
        $set->tanggal_peringatan = $request->tanggal_peringatan;
        $set->jenis_peringatan = $request->jenis_peringatan;
        $set->keterangan_peringatan = $request->keterangan_peringatan;
        $set->save();
      } else {
        $file_name = time().'.'.$file->getClientOriginalExtension();
        $file->move('documents', $file_name);

        $set = DataPeringatan::find($request->id);
        $set->id_pegawai = $request->id_pegawai;
        $set->tanggal_peringatan = $request->tanggal_peringatan;
        $set->jenis_peringatan = $request->jenis_peringatan;
        $set->keterangan_peringatan = $request->keterangan_peringatan;
        $set->dokumen_peringatan = $file_name;
        $set->save();
      }

      return redirect()->route('masterpegawai.show', $request->nip)->with('message','Berhasil mengubah data peringatan.');
    }

    public function hapusPeringatan($id)
    {
      $peringatan = DataPeringatan::find($id);
      $getnip = MasterPegawai::find($peringatan->id_pegawai);
      $peringatan->delete();

      return redirect()->route('masterpegawai.show', $getnip->nip)->with('message','Berhasil menghapus data peringatan kerja.');
    }

    public function bindPeringatan($id)
    {
      $get = DataPeringatan::find($id);
      return $get;
    }
}
