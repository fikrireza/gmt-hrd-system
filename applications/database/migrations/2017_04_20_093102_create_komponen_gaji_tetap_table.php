<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKomponenGajiTetapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komponen_gaji_tetap', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_komponen')->nullable();
            //D = Pendapatan, P = Potongan
            $table->string('tipe_komponen')->nullable();
            //Bulanan - Harian - Jam - Shift
            $table->string('periode_perhitungan')->nullable();
            //nanti ambil data dari table komponen gaji
            $table->integer('tipe_komponen_gaji')->default(0)->nullable();
            $table->string('tipe_bpjs', 50)->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->double('komgaj_tetap_dibayarkan');
            $table->integer('id_client')->unsigned()->nullable();
            $table->integer('flag_status')->default(0)->nullable();
            $table->timestamps();
        });

         Schema::table('komponen_gaji_tetap', function($table){
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
        Schema::dropIfExists('komponen_gaji_tetap');
    }
}
