<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MasterBahasaAsingRequest extends Request
{

  public function authorize()
  {
      return true;
  }

  public function rules()
  {
      return
      [
          'bahasa' => 'required|max:20|unique:bahasa',
          'berbicara' => 'required',
          'menulis' => 'required',
          'mengerti' => 'required',
          'id_pegawai' => 'required|unique:id_pegawai',
      ];
  }

  public function messages()
  {
      return
      [
        'bahasa.required' => 'Wajib di isi',
        'berbicara.required' => 'Wajib di isi',
        'menulis.required' => 'Wajib di isi',
        'mengerti.required' => 'Wajib di isi',
        'id_pegawai.required' => 'NIP Pegawai telah digunakan',
      ]
  }

}
