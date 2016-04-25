<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMasterPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_pegawai', function($table){
          $table->string('nip_lama', 15)->after('nip')->unique();
          $table->string('no_ktp', 20)->after('nip_lama')->unique();
          $table->string('no_kk', 20)->after('no_ktp');
          $table->date('tanggal_lahir')->after('nama');
          $table->char('jenis_kelamin', 1)->after('tanggal_lahir');
          $table->string('agama', 15)->after('alamat');
          $table->string('no_telp', 15)->after('agama');
          $table->string('status_pajak', 20)->after('no_telp');
          $table->string('kewarganegaraan', 3)->after('status_pajak');
          $table->string('bpjs_kesehatan', 20)->after('kewarganegaraan')->unique();
          $table->string('bpjs_ketenagakerjaan', 20)->after('bpjs_kesehatan')->unique();
          $table->string('no_rekening', 15)->after('bpjs_ketenagakerjaan')->unique();
          $table->string('nama_darurat', 50)->after('no_rekening');
          $table->string('alamat_darurat')->after('nama_darurat');
          $table->string('hubungan_darurat', 20)->after('alamat_darurat');
          $table->string('telepon_darurat', 15)->after('hubungan_darurat');
          $table->integer('id_jabatan')->after('telepon_darurat')->unsigned();
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
