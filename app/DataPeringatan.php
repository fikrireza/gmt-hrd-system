<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPeringatan extends Model
{
  protected $table = 'data_peringatan';

  protected $fillable = [
      'id_pegawai', 'jenis_peringatan', 'keterangan_peringatan', 'dokumen_peringatan', 'tanggal_peringatan'
  ];
}
