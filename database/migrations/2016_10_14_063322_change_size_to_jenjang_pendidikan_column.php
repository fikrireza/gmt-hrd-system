<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSizeToJenjangPendidikanColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendidikan', function($table){
          $table->string('jenjang_pendidikan', 100)->nullable()->change();
          $table->string('institusi_pendidikan', 100)->nullable()->change();
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
