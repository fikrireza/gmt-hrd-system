<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagementBpjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('management_bpjs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipe_bpjs', 50)->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->double('bpjs_dibayarkan');
            $table->integer('id_client')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('management_bpjs', function($table){
          $table->foreign('id_client')->references('id')->on('master_client');
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
