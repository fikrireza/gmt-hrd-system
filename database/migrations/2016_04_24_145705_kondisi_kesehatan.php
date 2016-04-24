<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KondisiKesehatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('kondisi_kesehatan', function(Blueprint $table){
        $table->increments('id');
        $table->integer('tinggi_badan');
        $table->integer('berat_badan');
        $table->string('warna_rambut', 10);
        $table->string('warna_mata', 10);
        //0 = tidak, 1 = ya
        $table->enum('berkacamata', [0,1]);
        //0 = tidak, 1 = ya
        $table->enum('merokok', [0,1]);
        $table->integer('id_pegawai')->unsigned();
        $table->timestamps();
      });

      Schema::table('kondisi_kesehatan', function($table){
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
