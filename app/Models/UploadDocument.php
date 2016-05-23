<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadDocument extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'dokumen_pegawai';

  protected $fillable = [
      'upload_kk', 'upload_ktp', 'upload_ijazah', 'upload_foto', 'id_pegawai'
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
