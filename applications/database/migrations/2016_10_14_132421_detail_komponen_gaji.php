<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailKomponenGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('detail_komponen_gaji', function(Blueprint $table){
        $table->increments('id');
        $table->integer('id_detail_batch_payroll')->unsigned()->nullable();
        $table->integer('id_komponen_gaji')->unsigned()->nullable();
        $table->integer('nilai')->nullable();
        $table->timestamps();
      });

      Schema::table('detail_komponen_gaji', function($table){
        $table->foreign('id_detail_batch_payroll')->references('id')->on('detail_batch_payroll');
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
