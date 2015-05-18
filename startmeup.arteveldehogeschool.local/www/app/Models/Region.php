<?php namespace StartMeUp\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {

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
		'iso',
		'name'
	];

	/**
	 * Many-to-One
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#one-to-many
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function country()
	{
		return $this->belongsTo('StartMeUp\Models\Country');
	}

	/**
	 * One-to-Many
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#one-to-many
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function localities()
	{
		return $this->hasMany('StartMeUp\Models\Locality');
	}

}
