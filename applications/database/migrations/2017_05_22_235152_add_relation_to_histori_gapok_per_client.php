<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationToHistoriGapokPerClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('histori_gaji_pokok_per_client', function($table) {
        $table->foreign('id_client')->references('id')->on('master_client');
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
