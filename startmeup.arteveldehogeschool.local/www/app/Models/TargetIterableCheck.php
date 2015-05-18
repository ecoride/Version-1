<?php namespace StartMeUp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TargetIterableCheck extends Model {

	use SoftDeletes;

	const REPEAT_DAILY  = 'daily';
	const REPEAT_HOURLY = 'hourly';
	const REPEAT_WEEKLY = 'weekly';
	const REPEATS = [
		self::REPEAT_HOURLY,
		self::REPEAT_DAILY,
		self::REPEAT_WEEKLY,
	];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'targets_iterable_check';

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'deadline_at',
		'repeat_deadline',
		'repeat_until_at',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'deadline_at',
		'repeat_until_at',
	];

	/**
	 * Polymorphic One-to-One
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#polymorphic-relations
	 * @return \Illuminate\Database\Eloquent\Relations\MorphOne
	 */
	public function goal()
	{
		return $this->morphOne('StartMeUp\Models\Goal', 'targetable');
	}

	/**
	 * One-to-Many
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#one-to-many
	 * @return mixed
	 */
	public function updates()
	{
		return $this->hasMany('StartMeUp\Models\UpdateIterableCheck', \CreateTargetsIterableCheckTable::FK);
	}
}
