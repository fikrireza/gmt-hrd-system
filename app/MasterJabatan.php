<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterJabatan extends Model
{
  protected $table = 'master_jabatan';

  protected $fillable = [
      'kode_jabatan', 'nama_jabatan'
  ];
}
