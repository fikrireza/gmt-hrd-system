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
          $table->string('nip_lama', 15)->after('nip')->nullable();
          $table->string('no_ktp', 20)->after('nip_lama')->nullable();
          $table->string('no_kk', 20)->after('no_ktp')->nullable();
          $table->date('tanggal_lahir')->after('nama')->nullable();
          $table->char('jenis_kelamin', 1)->after('tanggal_lahir')->nullable();
          $table->string('agama', 15)->after('alamat')->nullable();
          $table->string('no_telp', 15)->after('agama')->nullable();
          $table->string('status_pajak', 20)->after('no_telp')->nullable();
          $table->string('kewarganegaraan', 3)->after('status_pajak')->nullable();
          $table->string('bpjs_kesehatan', 20)->after('kewarganegaraan')->nullable();
          $table->string('bpjs_ketenagakerjaan', 20)->after('bpjs_kesehatan')->nullable();
          $table->string('no_rekening', 15)->after('bpjs_ketenagakerjaan')->nullable();
          $table->string('nama_darurat', 50)->after('no_rekening')->nullable()->nullable();
          $table->string('alamat_darurat')->after('nama_darurat')->nullable()->nullable();
          $table->string('hubungan_darurat', 20)->after('alamat_darurat')->nullable();
          $table->string('telepon_darurat', 15)->after('hubungan_darurat')->nullable();
          $table->integer('id_jabatan')->after('telepon_darurat')->unsigned()->nullable();
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
