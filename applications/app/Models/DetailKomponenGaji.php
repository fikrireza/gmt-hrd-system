<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailKomponenGaji extends Model
{
  protected $table = 'detail_komponen_gaji';

  protected $fillable = [
    'id_detail_batch_payroll', 'id_komponen_gaji', 'nilai'
  ];
}
