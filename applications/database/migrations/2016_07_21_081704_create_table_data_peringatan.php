<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataPeringatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_peringatan', function(Blueprint $table){
          $table->engine = 'InnoDB';
          $table->increments('id');
          $table->integer('id_pegawai')->unsigned()->nullable();
          $table->date('tanggal_peringatan')->nullable();
          $table->string('jenis_peringatan')->nullable();
          $table->string('keterangan_peringatan')->nullable();
          $table->string('dokumen_peringatan')->nullable();
          $table->timestamps();
        });

        Schema::table('data_peringatan', function($table){
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
