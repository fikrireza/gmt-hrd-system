<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->string('username')->unique();
          $table->string('password');
          $table->integer('pegawai_id')->unsigned();
          $table->enum('level', [0, 1, 2]);
          //0 = superadmin, 1 = hr, 2 = payroll
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
        Schema::drop('users');
    }
}
