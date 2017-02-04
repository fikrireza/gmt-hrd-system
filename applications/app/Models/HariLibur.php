<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HariLibur extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
  protected $table = 'master_hari_libur';

  protected $fillable = [
      'libur', 'keterangan', 'status'
  ];
}
