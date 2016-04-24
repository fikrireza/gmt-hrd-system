<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataPkwtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pkwt', function(Blueprint $table){
          $table->increments('id');
          $table->date('tanggal_masuk_gmt');
          $table->date('tanggal_masuk_client');
          //0 = tidak aktif, 1 = aktif
          $table->enum('status_pkwt', [0,1]);
          $table->date('tanggal_awal_pkwt');
          $table->date('tanggal_akhir_pkwt');
          //0 = tidak aktif, 1 = aktif
          $table->enum('status_karyawan_pkwt', [0,1]);
          $table->integer('id_pegawai')->unsigned();
          $table->integer('id_client')->unsigned();
          $table->timestamps();
        });

        Schema::table('data_pkwt', function(Blueprint $table){
          $table->foreign('id_pegawai')->references('id')->on('master_pegawai');
          $table->foreign('id_client')->references('id')->on('master_client');
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
