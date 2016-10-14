<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PeriodeGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('periode_gaji', function(Blueprint $table){
        $table->increments('id');
        $table->integer('tanggal')->nullable();
        $table->string('keterangan')->nullable();
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
