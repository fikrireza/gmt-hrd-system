<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KomponenGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('komponen_gaji', function(Blueprint $table){
        $table->increments('id');
        $table->string('nama_komponen')->nullable();
        //D = Pendapatan, P = Potongan
        $table->string('tipe_komponen')->nullable();
        //Bulanan - Harian - Jam - Shift
        $table->string('periode_perhitungan')->nullable();
        $table->timestamps();
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
