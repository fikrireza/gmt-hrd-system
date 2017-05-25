<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnIdClientInManagementBpjs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('management_bpjs', function(Blueprint $table){
        $table->dropForeign('management_bpjs_id_client_foreign');
        $table->dropColumn('id_client');
      });

      Schema::table('management_bpjs', function(Blueprint $table){
        $table->integer('id_cabang_client')->unsigned()->nullable()->after('bpjs_dibayarkan');
      });

      Schema::table('management_bpjs', function(Blueprint $table){
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
