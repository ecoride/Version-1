<?php namespace StartMeUp\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

	const TYPE_CLB = 'club';
	const TYPE_COM = 'company';
	const TYPE_EDU = 'educational institution';
	const TYPE_ORG = 'organization';
	const TYPES = [
		self::TYPE_CLB,
		self::TYPE_COM,
		self::TYPE_EDU,
		self::TYPE_ORG,
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'subtitle',
		'description',
		'type',
		'latitude',
		'longitude',
	];

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
	 * Many-to-One
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#one-to-many
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('StartMeUp\User');
	}

}
