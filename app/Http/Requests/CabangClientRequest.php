<?php
namespace App\Http\Requests;

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
		return [
			'kode_cabang' => 'required|unique:cabang_client|max:5',
			'nama_cabang' => 'required|max:40',
      'alamat_cabang' => 'required|max:150',
      'id_client' => 'required'
		];
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
