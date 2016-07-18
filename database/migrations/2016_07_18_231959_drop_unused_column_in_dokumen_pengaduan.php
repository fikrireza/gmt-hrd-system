<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUnusedColumnInDokumenPengaduan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokumen_pegawai', function($table){
          $table->dropColumn('upload_kk');
          $table->dropColumn('upload_ktp');
          $table->dropColumn('upload_ijazah');
          $table->dropColumn('upload_foto');
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
