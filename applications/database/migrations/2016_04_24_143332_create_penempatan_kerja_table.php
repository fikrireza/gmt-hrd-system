<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenempatanKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penempatan_kerja', function(Blueprint $table){
          $table->engine = 'InnoDB';

          $table->increments('id');
          //0 = tidak aktif, 1 = aktif
          $table->integer('status')->default(1)->nullable();
          $table->integer('id_departemen')->unsigned()->nullable();
          $table->integer('id_pegawai')->unsigned()->nullable();
          $table->timestamps();
        });

        Schema::table('penempatan_kerja', function(Blueprint $table){
          $table->foreign('id_departemen')->references('id')->on('departemen_client');
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
