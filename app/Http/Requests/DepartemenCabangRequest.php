<?php
namespace App\Http\Requests;

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
		return [
			'kode_departemen' => 'required|max:5',
			'nama_departemen' => 'required|max:50',
      'id_cabang' => 'required'
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
          'kode_departemen.required' => 'Wajib di Isi',
          'nama_departemen.required'  => 'Wajib di Isi',
      ];
  }

}
