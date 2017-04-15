<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailBatchProcessedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_batch_processed', function(Blueprint $table){
          $table->increments('id');
          $table->integer('id_pegawai')->unsigned()->nullable();
          $table->integer('id_batch_processed')->unsigned()->nullable();
          $table->string('nip');
          $table->string('nama');
          $table->string('jabatan');
          $table->integer('hari_normal');
          $table->integer('abstain');
          $table->integer('sick_leave');
          $table->integer('permissed_leave');
          $table->integer('hari_kerja');
          $table->integer('penerimaan_tetap');
          $table->integer('penerimaan_variable');
          $table->integer('potongan_tetap');
          $table->integer('potongan_variable');
          $table->integer('total');
          $table->timestamps();
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
