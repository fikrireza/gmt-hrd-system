<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengalamanKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pengalaman_kerja', function(Blueprint $table){
        $table->engine = 'InnoDB';

        $table->increments('id');
        $table->string('nama_perusahaan', 100);
        $table->string('posisi_perusahaan', 100);
        $table->string('tahun_awal_kerja', 4);
        $table->string('tahun_akhir_kerja', 4);
        $table->integer('id_pegawai')->unsigned();
        $table->timestamps();
      });

      Schema::table('pengalaman_kerja', function($table){
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
