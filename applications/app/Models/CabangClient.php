<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CabangClient extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cabang_client';

  protected $fillable = [
      'kode_cabang', 'nama_cabang', 'alamat_cabang', 'id_client'
  ];
	/**
	 * Many to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\belongToMany
	 */
	public function master_client()
	{
		return $this->belongsTo('App\Models\MasterClient');
	}

}
