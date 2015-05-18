<?php namespace StartMeUp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model {

	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];

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
	 * Many-to-One
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#one-to-many
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function locality()
	{
		return $this->belongsTo('StartMeUp\Models\Locality');
	}

//	/**
//	 * One-to-One (inverse)
//	 *
//	 * @link http://laravel.com/docs/5.0/eloquent#one-to-one
//	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//	 */
//	public function company()
//	{
//		return $this->hasOne('StartMeUp\Company');
//	}
//
//	/**
//	 * One-to-One (inverse)
//	 *
//	 * @link http://laravel.com/docs/5.0/eloquent#one-to-one
//	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//	 */
//	public function location()
//	{
//		return $this->hasOne('StartMeUp\Location');
//	}
}
