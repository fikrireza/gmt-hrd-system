<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeGaji extends Model
{
  protected $table = 'periode_gaji';

  protected $fillable = [
    'tanggal', 'keterangan'
  ];

  public function detail_periode_gaji()
  {
    return $this->hasMany('App\Models\DetailPeriodeGaji');
  }
}
