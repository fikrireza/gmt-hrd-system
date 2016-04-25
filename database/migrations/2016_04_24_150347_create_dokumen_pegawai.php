<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokumenPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('dokumen_pegawai', function(Blueprint $table){
        $table->engine = 'InnoDB';

        $table->increments('id');
        $table->string('upload_kk', 100)->unique();
        $table->string('upload_ktp', 100)->unique();
        $table->string('upload_ijazah', 100)->unique();
        $table->string('upload_foto', 100)->unique();
        $table->integer('id_pegawai')->unsigned();
        $table->timestamps();
      });

      Schema::table('dokumen_pegawai', function($table){
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
