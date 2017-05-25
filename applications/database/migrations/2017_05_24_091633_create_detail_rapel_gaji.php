<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailRapelGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_rapel_gaji', function(Blueprint $table){
          $table->increments('id');
          $table->integer('id_pegawai')->unsigned()->nullable();
          $table->integer('id_rapel_gaji')->unsigned()->nullable();
          $table->integer('jml_bulan_selisih');
          $table->integer('nilai_rapel');
          $table->timestamps();
        });

        Schema::table('detail_rapel_gaji', function($table){
          $table->foreign('id_pegawai')->references('id')->on('master_pegawai');
          $table->foreign('id_rapel_gaji')->references('id')->on('rapel_gaji');
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
