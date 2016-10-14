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
          $table->string('kode_cabang', 10)->unique()->nullable();
          $table->string('nama_cabang', 50)->nullable();
          $table->string('alamat_cabang')->nullable();
          $table->integer('id_client')->unsigned()->nullable();
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
