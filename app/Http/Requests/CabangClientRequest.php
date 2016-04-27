<?php
namespace App\Http\Requests;

use App\Models\CabangClient;

class CabangClientRequest extends Request {

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
		    $cabangClient = CabangClient::find($this->id);

		    switch($this->method())
		    {
		        case 'GET':
		        case 'DELETE':
		        {
		            return [];
		        }
		        case 'POST':
		        {
		            return [
									'kode_cabang' => 'required|max:5|unique:cabang_client',
									'nama_cabang' => 'required|max:40',
									'alamat_cabang' => 'required|max:150',
									'id_client' => 'required'
		            ];
		        }
		        case 'PUT':
		        case 'PATCH':
		        {
		            return [
									'kode_cabang' => 'required|max:5|unique:cabang_client,kode_cabang,'.$this->cabangclient->id,
									'nama_cabang' => 'required|max:40',
									'alamat_cabang' => 'required|max:150',
									'id_client' => 'required'
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
          'kode_cabang.required' => 'Wajib di Isi',
          'nama_cabang.required'  => 'Wajib di Isi',
          'alamat_cabang.required'  => 'Wajib di Isi',
      ];
  }

}
