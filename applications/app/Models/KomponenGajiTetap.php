<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomponenGajiTetap extends Model
{
  protected $table = 'komponen_gaji_tetap';

  protected $fillable = [
    'nama_komponen', 'tipe_komponen', 'periode_perhitungan', 'tipe_komponen_gaji', 'keterangan', 'komgaj_tetap_dibayarkan', 'id_client', 'flag_status'
  ];
}
