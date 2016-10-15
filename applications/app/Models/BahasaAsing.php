<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahasaAsing extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bahasa_asing';

  protected $fillable = [
    'bahasa', 'berbicara', 'menulis', 'mengerti', 'id_pegawai'
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
