<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pendidikan';

  protected $fillable = [
    'jenjang_pendidikan', 'institusi_pendidikan', 'tahun_masuk_pendidikan', 'tahun_lulus_pendidikan', 'gelar_akademik', 'id_pegawai'
  ];
	/**
	 * Many to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\belongToMany
	 */
	public function master_pegawai()
	{
		return $this->belongsToMany('App\Models\MasterPegawai');
	}

}
