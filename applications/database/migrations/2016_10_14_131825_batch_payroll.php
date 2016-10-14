<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BatchPayroll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('batch_payroll', function(Blueprint $table){
        $table->increments('id');
        $table->integer('id_periode_gaji')->unsigned()->nullable();
        $table->date('tanggal_proses')->nullable();
        $table->timestamps();
      });

      Schema::table('batch_payroll', function($table){
        $table->foreign('id_periode_gaji')->references('id')->on('periode_gaji');
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
