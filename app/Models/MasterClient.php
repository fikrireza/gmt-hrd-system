<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterClient extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'master_client';

  protected $fillable = [
      'kode_client', 'nama_client',
  ];
	/**
	 * Many to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\belongToMany
	 */
	public function cabang_client()
	{
		return $this->belongsToMany('App\Models\CabangClient');
	}

}
