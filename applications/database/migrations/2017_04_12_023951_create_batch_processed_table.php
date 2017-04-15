<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchProcessedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_processed', function(Blueprint $table){
          $table->increments('id');
          $table->integer('total_pegawai')->default(0);
          $table->integer('total_penerimaan_gaji')->default(0);
          $table->integer('total_potongan_gaji')->default(0);
          $table->integer('total_pengeluaran')->default(0);
          $table->integer('id_pegawai')->unsigned()->nullable();
          $table->timestamps();
        });

        Schema::table('batch_processed', function($table){
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
