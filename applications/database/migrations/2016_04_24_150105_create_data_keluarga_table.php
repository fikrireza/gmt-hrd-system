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
        $table->engine = 'InnoDB';

        $table->increments('id');
        $table->string('nama_keluarga', 100)->nullable();
        $table->string('hubungan_keluarga', 50)->nullable();
        $table->date('tanggal_lahir_keluarga')->nullable();
        $table->string('alamat_keluarga')->nullable();
        $table->string('pekerjaan_keluarga')->nullable();
        $table->char('jenis_kelamin_keluarga', 1)->nullable();
        $table->integer('id_pegawai')->unsigned()->nullable();
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
