<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
  protected $table = 'master_cuti';

  protected $fillable = [
      'jenis_cuti', 'jumlah_hari', 'tanggal_mulai', 'tanggal_akhir', 'deskripsi', 'berkas', 'flag_status', 'id_pegawai'
  ];
	/**
	 * Many to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\belongToMany
	 */
	public function masterpegawai()
    {
      return $this->belongsTo('App\Models\MasterPegawai', 'id_pegawai');
    }

}
