<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBatchPayroll extends Model
{
  protected $table = 'detail_batch_payroll';

  protected $fillable = [
    'id_batch_payroll', 'id_pegawai'
  ];
}
