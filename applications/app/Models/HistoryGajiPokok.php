<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryGajiPokok extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
  protected $table = 'history_gaji_pokok';

  protected $fillable = [
      'gaji_pokok', 'periode_tahun', 'keterangan', 'id_pegawai', 'id_cabang_client', 'flag_status'
  ];
}
