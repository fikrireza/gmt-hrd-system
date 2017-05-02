<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryGajiPokokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_gaji_pokok', function (Blueprint $table) {
            $table->increments('id');
            $table->double('gaji_pokok');
            $table->integer('periode_tahun')->default(0)->nullable();
            $table->string('keterangan', 500)->nullable();
            $table->integer('id_pegawai')->unsigned()->nullable();
            $table->integer('id_cabang_client')->unsigned()->nullable();
            $table->integer('flag_status')->default(0)->nullable();
            $table->timestamps();
        });

        Schema::table('history_gaji_pokok', function($table){
          $table->foreign('id_pegawai')->references('id')->on('master_pegawai');
        });

        Schema::table('history_gaji_pokok', function($table){
          $table->foreign('id_cabang_client')->references('id')->on('cabang_client');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_gaji_pokok');
    }
}
