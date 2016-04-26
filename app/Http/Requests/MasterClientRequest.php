<?php
namespace App\Http\Requests;

class MasterClientRequest extends Request {

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
			'kode_client' => 'required|max:5',
			'nama_client' => 'required|max:40'
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
          'kode_client.required' => 'Wajib di Isi',
          'nama_client.required'  => 'Wajib di Isi',
      ];
  }

}
