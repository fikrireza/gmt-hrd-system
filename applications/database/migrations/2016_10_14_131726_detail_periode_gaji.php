<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailPeriodeGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('detail_periode_gaji', function(Blueprint $table){
        $table->increments('id');
        $table->integer('id_periode_gaji')->unsigned()->nullable();
        $table->integer('id_pegawai')->unsigned()->nullable();
        $table->timestamps();
      });

      Schema::table('detail_periode_gaji', function($table){
        $table->foreign('id_periode_gaji')->references('id')->on('periode_gaji');
        $table->foreign('id_pegawai')->references('id')->on('master_pegawai');
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
