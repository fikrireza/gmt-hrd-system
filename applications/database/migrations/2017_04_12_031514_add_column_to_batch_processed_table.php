<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToBatchProcessedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('batch_processed', function($table){
          $table->integer('id_batch_payroll')->unsigned()->nullable()->after('id');
          $table->integer('id_periode')->unsigned()->nullable()->after('id_batch_payroll');
          $table->date('tanggal_proses_payroll')->after('id_periode');
          $table->date('tanggal_cutoff_awal')->after('tanggal_proses_payroll');
          $table->date('tanggal_cutoff_akhir')->after('tanggal_cutoff_awal');
        });

        Schema::table('batch_processed', function($table){
          $table->foreign('id_batch_payroll')->references('id')->on('batch_payroll');
          $table->foreign('id_periode')->references('id')->on('periode_gaji');
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
