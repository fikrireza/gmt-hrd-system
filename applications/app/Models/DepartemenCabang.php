<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartemenCabang extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'departemen_client';

  protected $fillable = [
      'kode_departemen', 'nama_departemen', 'id_cabang'
  ];
	/**
	 * Many to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\belongToMany
	 */
	public function cabang_client()
	{
		return $this->belongsTo('App\Models\CabangClient');
	}

}
