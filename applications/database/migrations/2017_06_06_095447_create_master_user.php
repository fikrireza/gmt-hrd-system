<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_users', function (Blueprint $table) {
          $table->increments('id');
          $table->string('username')->unique();
          $table->string('email');
          $table->string('nama');
          $table->string('password');
          $table->string('url_foto')->nullable();
          $table->integer('login_count')->nullable()->default(1);
          //0 = superadmin, 1 = hr, 2 = payroll
          $table->integer('level')->default(1);
          $table->rememberToken();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
