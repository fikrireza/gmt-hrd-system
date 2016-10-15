<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchPayroll extends Model
{
  protected $table = 'batch_payroll';

  protected $fillable = [
    'id_periode_gaji', 'tanggal_proses'
  ];
}
