<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnIdClientToKomponenGajiTetap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('komponen_gaji_tetap', function(Blueprint $table){
            $table->dropForeign('komponen_gaji_tetap_id_client_foreign');
            $table->dropColumn('id_client');
        });

        Schema::table('komponen_gaji_tetap', function(Blueprint $table){
            $table->integer('id_cabang_client')->unsigned()->nullable()->after('komgaj_tetap_dibayarkan');
        });

        Schema::table('komponen_gaji_tetap', function(Blueprint $table){
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
