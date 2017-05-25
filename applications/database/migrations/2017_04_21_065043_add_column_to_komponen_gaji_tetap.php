<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToKomponenGajiTetap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('komponen_gaji_tetap', function($table){
          $table->integer('id_komponen_gaji')->unsigned()->nullable()->after('id_cabang_client');
        });

        Schema::table('komponen_gaji_tetap', function($table){
          $table->foreign('id_komponen_gaji')->references('id')->on('komponen_gaji');
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
