<?php namespace StartMeUp\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	/**
	 * One-to-One (inverse)
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#one-to-one
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function address()
	{
		return $this->belongsTo('StartMeUp\Models\Address');
	}

	/**
	 * One-to-OneOrMany
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#one-to-one
	 * @return mixed
	 */
	public function users()
	{
		return $this->hasOneOrMany('StartMeUp\User');
	}

}
