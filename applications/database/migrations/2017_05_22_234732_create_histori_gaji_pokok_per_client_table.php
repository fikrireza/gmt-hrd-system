<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriGajiPokokPerClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histori_gaji_pokok_per_client', function(Blueprint $table){
          $table->increments('id');
          $table->integer('id_client')->unsigned()->nullable();
          $table->integer('id_cabang_client')->unsigned()->nullable();
          $table->date('tanggal_penyesuaian');
          $table->integer('nilai');
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
