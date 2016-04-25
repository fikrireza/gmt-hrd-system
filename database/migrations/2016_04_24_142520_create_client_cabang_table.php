<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientCabangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabang_client', function(Blueprint $table){
          $table->engine = 'InnoDB';

          $table->increments('id');
          $table->string('kode_cabang', 10)->unique();
          $table->string('nama_cabang', 50);
          $table->string('alamat_cabang');
          $table->integer('id_client')->unsigned();
          $table->timestamps();
        });

        Schema::table('cabang_client', function($table){
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
        //
    }
}
