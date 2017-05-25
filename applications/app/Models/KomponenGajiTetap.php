<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomponenGajiTetap extends Model
{
  protected $table = 'komponen_gaji_tetap';

  protected $fillable = [
    'keterangan', 'komgaj_tetap_dibayarkan', 'id_cabang_client', 'id_komponen_gaji', 'flag_status'
  ];
}
