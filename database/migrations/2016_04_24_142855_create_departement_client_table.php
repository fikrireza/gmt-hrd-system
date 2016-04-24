<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartementClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departemen_client', function(Blueprint $table){
          $table->increments('id');
          $table->string('kode_departemen', 10);
          $table->string('nama_departemen', 50);
          $table->integer('id_cabang')->unsigned();
          $table->timestamps();
        });

        Schema::table('departemen_client', function($table){
          $table->foreign('id_cabang')->references('id')->on('cabang_client');
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
