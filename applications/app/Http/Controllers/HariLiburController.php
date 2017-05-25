<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\HariLibur;

use Validator;

class HariLiburController extends Controller
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
      $getharilibur = HariLibur::paginate(10);
      return view('pages/params/kelolaharilibur')->with('getharilibur', $getharilibur);
    }

    public function store(Request $request)
    {
      $message = [
        'libur.required' => 'Wajib di isi',
        'keterangan.required' => 'Wajib di isi',
        'status.required' => 'Wajib di isi',
      ];

      $validator = Validator::make($request->all(), [
        'libur' => 'required',
        'keterangan' => 'required',
        'status' => 'required',
      ], $message);

      if($validator->fails())
      {
        return redirect()->route('hari.libur.index')->withErrors($validator)->withInput();
      }

      $set = new HariLibur;
      $set->libur = $request->libur;
      $set->keterangan = $request->keterangan;
      $set->status = $request->status;
      $set->save();

      return redirect()->route('hari.libur.index')->with('message', 'Berhasil memasukkan hari libur.');
    }

    public function bind($id)
    {
      $get = HariLibur::find($id); 
      return $get;
    }

    public function update(Request $request)
    {
      // dd($request);
      $dataChage = HariLibur::find($request->id);
      $dataChage->libur = $request->libur;
      $dataChage->keterangan = $request->keterangan;
      $dataChage->status = $request->status;
      $dataChage->save();

      return redirect()->route('hari.libur.index')->with('message', 'Data hari libur berhasil diubah.');
    }

    public function delete($id)
    {
      $set = HariLibur::find($id);
      $set->delete();
      return redirect()->route('hari.libur.index')->with('message', 'Berhasil menghapus data hari libur.');
    }

}
