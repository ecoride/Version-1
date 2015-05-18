<?php namespace StartMeUp\Http\Requests;

use StartMeUp\Http\Requests\Request;

class StoreCompanyRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
//		return false;
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
			'name'             => 'required',
			'email'            => 'required|email|unique:users,email',
			'password'         => 'required',
			'password_confirm' => 'confirmed:password',
			'given_name'       => 'required',
			'family_name'      => 'required',
			'birthday'         => 'date',
			'gender'           => 'size:1',
		];
	}

}
