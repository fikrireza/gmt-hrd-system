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
          $table->string('bahasa', 15);
          //0 = tidak diisi
          $table->enum('berbicara', [0,1,2,3]);
          $table->enum('menulis', [0,1,2,3]);
          $table->enum('mengerti', [0,1,2,3]);
          $table->integer('id_pegawai')->unsigned();
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
