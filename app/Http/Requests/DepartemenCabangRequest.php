<?php
namespace App\Http\Requests;

use App\Models\DepartemenCabang;

class DepartemenCabangRequest extends Request {

	public function authorize()
    {
        return true;
    }
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		// return [
		// 	'kode_departemen' => 'required|unique:departemen_client|max:5',
		// 	'nama_departemen' => 'required|max:50',
    //   'id_cabang' => 'required'
		// ];
		$departemenCabang = DepartemenCabang::find($this->id);

		switch($this->method()){
			case 'GET':
			case 'DELETE':
			{
					return [];
			}
			case 'POST':
			{
					return [
						'kode_departemen' => 'required|max:5|unique:departemen_client',
						'nama_departemen' => 'required|max:40',
						'id_cabang' => 'required'
					];
			}
			case 'PUT':
			case 'PATCH':
			{
					return [
						'kode_departemen' => 'required|max:5|unique:departemen_client,id,'.$this->id,
						'nama_departemen' => 'required|max:40',
						'id_cabang' => 'required'
					];
			}
			default:break;
		}
	}

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages()
  {
      return [
          'kode_departemen.required' => 'Wajib di Isi',
          'nama_departemen.required'  => 'Wajib di Isi',
      ];
  }

}
