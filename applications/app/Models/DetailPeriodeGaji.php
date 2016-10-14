<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeriodeGaji extends Model
{
  protected $table = 'detail_periode_gaji';

  protected $fillable = [
    'id_periode_gaji', 'id_pegawai'
  ];

  public function periode_gaji()
  {
    return $this->belongsTo('App\Models\PeriodeGaji', 'id_periode_gaji');
  }

  public function master_pegawai()
  {
    return $this->belongsTo('App\MasterPegawai', 'id_pegawai');
  }
}
