<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnToKomponenGajiTetap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('komponen_gaji_tetap', function($table)
        {
            $table->dropColumn('nama_komponen');
            $table->dropColumn('tipe_komponen');
            $table->dropColumn('periode_perhitungan');
            $table->dropColumn('tipe_komponen_gaji');
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
