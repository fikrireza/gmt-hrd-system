<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayatPenyakitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_penyakit', function(Blueprint $table){
          $table->engine = 'InnoDB';

          $table->increments('id');
          $table->string('nama_penyakit', 100)->nullable();
          $table->string('keterangan_penyakit')->nullable();
          $table->integer('id_pegawai')->unsigned()->nullable();
          $table->timestamps();
        });

        Schema::table('riwayat_penyakit', function(Blueprint $table){
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
