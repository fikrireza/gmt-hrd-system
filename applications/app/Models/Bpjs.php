<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bpjs extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
  protected $table = 'management_bpjs';

  protected $fillable = [
      'tipe_bpjs', 'keterangan', 'bpjs_dibayarkan', 'id_client'
  ];
}
