<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterPegawai extends Model
{
    protected $table = 'master_pegawai';

    protected $fillable = [
        'nip', 'nip_lama', 'no_ktp', 'no_kk', 'no_npwp', 'nama', 'tanggal_lahir', 'jenis_kelamin', 'email', 'alamat', 'agama', 'no_telp', 'status_pajak', 'kewarganegaraan', 'bpjs_kesehatan', 'bpjs_ketenagakerjaan', 'no_rekening', 'nama_darurat', 'alamat_darurat', 'hubungan_darurat', 'telepon_darurat', 'id_jabatan', 'status', 'bank',//'status_kontrak'
    ];

    public function akun()
    {
      return $this->hasOne('App\Models\User');
    }

    public function bank()
    {
      return $this->hasOne('App\Models\MasterBank');
    }
}
