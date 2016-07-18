<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnIdCabangClientToDataPkwt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_pkwt', function($table){
          $table->integer('id_cabang_client')->after('id_pegawai')->unsigned();
        });

        Schema::table('data_pkwt', function($table){
          $table->foreign('id_cabang_client')->references('id')->on('cabang_client');
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
