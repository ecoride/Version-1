<?php namespace StartMeUp\Models;

use Illuminate\Database\Eloquent\Model;

class Locality extends Model {

	/**
	 * Don't use timestamps.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Many-to-One
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#one-to-many
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function region()
	{
		return $this->belongsTo('StartMeUp\Models\Region');
	}

	/**
	 * One-to-Many
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#one-to-many
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function addresses()
	{
		return $this->hasMany('StartMeUp\Models\Address');
	}

}
