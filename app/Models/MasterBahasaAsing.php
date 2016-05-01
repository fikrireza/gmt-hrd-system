<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MasterBahasaAsing extends Model
{
  protected $table = 'bahasa_asing';

  protected $fillable = [
    'bahasa', 'berbicara', 'menulis', 'mengerti' ,'id_pegawai'
  ]
}
