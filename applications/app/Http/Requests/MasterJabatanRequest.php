<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MasterJabatanRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kode_jabatan' => 'required|max:6|unique:master_jabatan,kode_jabatan',
            'nama_jabatan' => 'required',
        ];
    }

    public function messages()
    {
        return [
          'kode_jabatan.required' => 'Wajib di isi.',
          'nama_jabatan.required' => 'Wajib di isi.',
          'kode_jabatan.max' => 'Tidak boleh lebih dari 6 karakter.',
          'kode_jabatan.unique' => 'Kode Jabatan telah digunakan.',
        ];
    }
}
