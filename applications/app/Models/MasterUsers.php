<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class MasterUsers extends Authenticatable
{
    protected $table = 'master_users';

    protected $fillable = ['nama','username','email','password','level','login_count','url_foto'];
}
