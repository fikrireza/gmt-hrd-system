<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MasterPegawaiRequest extends Request
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
            'nip' => 'required',
            // 'nip_lama' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'email' => 'required|email',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'jabatan' => 'required',
            'no_ktp' => 'required|max:16|unique:master_pegawai,no_ktp',
            'no_kk' => 'required|max:16',
            'no_npwp' => 'required|max:16|unique:master_pegawai,no_npwp',
            'no_telp' => 'required|max:16|unique:master_pegawai,no_telp',
            'no_rekening' => 'required|max:16|unique:master_pegawai,no_rekening',
            'bpjs_kesehatan' => 'required|max:16|unique:master_pegawai,bpjs_kesehatan',
            'bpjs_ketenagakerjaan' => 'required|max:16|unique:master_pegawai,bpjs_ketenagakerjaan',
            'status_pajak' => 'required',
            'kewarganegaraan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nip.required' => 'Wajib di isi.',
            // 'nip_lama.required' => 'Wajib di Isi.',
            'nama.required' => 'Wajib di isi.',
            'alamat.required' => 'Wajib di isi.',
            'tanggal_lahir.required' => 'Wajib di isi.',
            'email.required' => 'Wajib di isi.',
            'email.email' => 'required|email',
            'jenis_kelamin.required' => 'Wajib di isi.',
            'agama.required' => 'Wajib di isi.',
            'jabatan.required' => 'Wajib di isi.',
            'no_ktp.required' => 'Wajib di isi.',
            'no_ktp.max' => 'Nomor KTP maksimal 16 karakter',
            'no_ktp.unique' => 'Nomor KTP telah digunakan.',
            'no_kk.required' => 'Wajib di isi.',
            'no_npwp.required' => 'Wajib di isi.',
            'no_telp.required' => 'Wajib di isi.',
            'no_rekening.required' => 'Wajib di isi.',
            'bpjs_kesehatan.required' => 'Wajib di isi.',
            'bpjs_ketenagakerjaan.required' => 'Wajib di isi.',
            'status_pajak.required' => 'Wajib di isi.',
            'kewarganegaraan.required' => 'Wajib di isi.',
        ];

    }
}
