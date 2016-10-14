<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('master_pegawai', function(Blueprint $table){
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->string('nip')->unique();
        $table->string('nama')->nullable();
        $table->string('email')->nullable();
        $table->string('alamat')->nullable();
        // $table->string('status_kontrak');
        $table->integer('status')->default(1);
        //0 = non-aktif, 1 = aktif
        $table->timestamps();
      });

      Schema::table('users', function($table){
        $table->foreign('pegawai_id')->references('id')->on('master_pegawai');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('master_pegawai');
    }
}
