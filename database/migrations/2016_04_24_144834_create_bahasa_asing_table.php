<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBahasaAsingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahasa_asing', function(Blueprint $table){
          $table->engine = 'InnoDB';

          $table->increments('id');
          $table->string('bahasa')->nullable();
          //0 = tidak diisi
          $table->integer('berbicara')->nullable();
          $table->integer('menulis')->nullable();
          $table->integer('mengerti')->nullable();
          $table->integer('id_pegawai')->unsigned()->nullable();
          $table->timestamps();
        });

        Schema::table('bahasa_asing', function($table){
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
