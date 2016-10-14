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
        $table->engine = 'InnoDB';

        $table->increments('id');
        $table->integer('tinggi_badan')->nullable();
        $table->integer('berat_badan')->nullable();
        $table->string('warna_rambut', 10)->nullable();
        $table->string('warna_mata', 10)->nullable();
        //0 = tidak, 1 = ya
        $table->integer('berkacamata')->nullable();
        //0 = tidak, 1 = ya
        $table->integer('merokok')->nullable();
        $table->integer('id_pegawai')->unsigned()->nullable();
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
