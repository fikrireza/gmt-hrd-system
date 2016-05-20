<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendidikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pendidikan', function(Blueprint $table){
        $table->engine = 'InnoDB';

        $table->increments('id');
        $table->string('jenjang_pendidikan', 10);
        $table->string('institusi_pendidikan', 50);
        $table->string('tahun_masuk_pendidikan', 4);
        $table->string('tahun_lulus_pendidikan', 4);
        $table->string('gelar_akademik', 10);
        $table->integer('id_pegawai')->unsigned();
        $table->timestamps();
      });

      Schema::table('pendidikan', function($table){
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
