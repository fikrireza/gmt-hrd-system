<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('data_keluarga', function(Blueprint $table){
        $table->increments('id');
        $table->string('nama', 100);
        $table->string('hubungan', 50);
        $table->date('tanggal_lahir');
        $table->string('alamat');
        $table->string('pekerjaan');
        $table->char('jenis_kelamin', 1);
        $table->integer('id_pegawai')->unsigned();
        $table->timestamps();
      });

      Schema::table('data_keluarga', function($table){
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
