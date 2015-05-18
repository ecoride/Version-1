<?php namespace StartMeUp\Repositories\Eloquent;

use StartMeUp\Models\Company as CompanyModel;
use StartMeUp\Contracts\Repositories\Company as CompanyContract;

class Company extends Repository implements CompanyContract {


	/**
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return CompanyModel::all();
	}

}
