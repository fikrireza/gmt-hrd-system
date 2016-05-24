<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PKWT extends Model
{
    protected $table = 'data_pkwt';

    protected $fillable = [
        'tanggal_masuk_gmt', 'tanggal_masuk_client', 'status_pkwt', 'tanggal_awal_pkwt', 'tanggal_akhir_pkwt', 'status_karyawan_pkwt', 'id_pegawai', 'id_client'
    ];
}
