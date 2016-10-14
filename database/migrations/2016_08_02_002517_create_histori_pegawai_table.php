<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histori_pegawai', function(Blueprint $table){
          $table->increments('id');
          $table->integer('id_pegawai')->unsigned()->nullable();
          $table->text('keterangan')->nullable();
          $table->timestamps();
        });

        Schema::table('histori_pegawai', function($table){
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
