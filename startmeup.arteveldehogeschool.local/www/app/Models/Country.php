<?php namespace StartMeUp\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

	/**
	 * Don't use timestamps.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'iso',
	];

	/**
	 * One-to-Many
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#one-to-many
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function regions()
	{
		return $this->hasMany('StartMeUp\Models\Region');
	}

}
