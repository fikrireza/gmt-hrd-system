<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnTipeBpjs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('management_bpjs', function(Blueprint $table){
        $table->dropColumn('tipe_bpjs');
      });

      Schema::table('management_bpjs', function(Blueprint $table){
        $table->integer('id_bpjs')->unsigned()->nullable()->after('id');
      });

      Schema::table('management_bpjs', function(Blueprint $table){
        $table->foreign('id_bpjs')->references('id')->on('komponen_gaji');
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
