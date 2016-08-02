<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriPegawai extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'histori_pegawai';

  protected $fillable = [
      'keterangan', 'id_pegawai'
  ];
	/**
	 * Many to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\belongToMany
	 */
	public function master_pegawai()
	{
		return $this->belongsToMany('App\MasterPegawai');
	}

}
