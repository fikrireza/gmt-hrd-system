<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataKeluarga extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'data_keluarga';

  protected $fillable = [
      'nama_keluarga', 'hubungan_keluarga', 'tanggal_lahir_keluarga', 'alamat_keluarga', 'pekerjaan_keluarga', 'jenis_kelamin_keluarga', 'id_pegawai'
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
