<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeahlianKomputerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keahlian_komputer', function(Blueprint $table){
          $table->engine = 'InnoDB';

          $table->increments('id');
          $table->string('nama_program', 100)->nullable();
          $table->string('nilai_komputer', 5)->nullable();
          $table->integer('id_pegawai')->unsigned()->nullable();
          $table->timestamps();
        });

        Schema::table('keahlian_komputer', function($table){
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
