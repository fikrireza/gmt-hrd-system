<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterPegawai extends Model
{
    protected $table = 'master_pegawai';

    protected $fillable = [
        'nip', 'nama', 'alamat', 'status',
    ];
}
