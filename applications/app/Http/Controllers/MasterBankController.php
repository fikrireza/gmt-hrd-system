<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterBank;

use DB;
use Validator;

class MasterBankController extends Controller
{

    public function index()
    {
        $getBank = MasterBank::get();

        return view('pages.MasterBank.index', compact('getBank'));

    }


    public function store(Request $request)
    {
        $message = [
          'nama_bank.required' => 'Wajib di isi'
        ];

        $validator = Validator::make($request->all(), [
          'nama_bank' => 'required'
        ], $message);

        if($validator->fails()){
          return redirect()->route('masterbank.index')->withErrors($validator)->withInput();
        }

        $save = New MasterBank;
        $save->nama_bank = $request->nama_bank;
        $save->save();

        return redirect()->route('masterbank.index')->with('berhasil', 'Berhasil Menambah Data Bank');
    }

    public function ubah($id)
    {
        $BankEdit = MasterBank::find($id);

        $getBank = MasterBank::get();

        if(!$BankEdit){
          abort(404);
        }

        return view('pages.MasterBank.index', compact('BankEdit', 'getBank'));
    }

    public function edit(Request $request)
    {
        if($request->flag_status == "on"){
          $flag_status = 1;
        }else{
          $flag_status = 0;
        }

        $update = MasterBank::find($request->id);
        $update->flag_status = $flag_status;
        $update->update();

        return redirect()->route('masterbank.index')->with('berhasil', 'Berhasil Mengubah Data Bank');

    }
}
