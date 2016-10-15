<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KondisiKesehatan extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'kondisi_kesehatan';

  protected $fillable = [
      'tinggi_badan', 'berat_badan', 'warna_rambut', 'warna_mata', 'berkacamata', 'merokok', 'id_pegawai'
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
