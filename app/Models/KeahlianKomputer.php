<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeahlianKomputer extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'keahlian_komputer';

  protected $fillable = [
    'nama_program', 'nilai', 'id_pegawai'
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
