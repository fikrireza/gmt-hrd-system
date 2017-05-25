<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAbsensiToDetailBatchPayroll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_batch_payroll', function($table){
          $table->integer('abstain')->default('0')->after('workday');
          $table->integer('sick_leave')->default('0')->after('abstain');
          $table->integer('permissed_leave')->default('0')->after('sick_leave');
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
