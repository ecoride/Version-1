<?php namespace StartMeUp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UpdateIterableCheck extends Model {

	use SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'updates_iterable_check';

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'created_at',
		'updated_at',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'achieved_at',
	];

	/**
	 * Many-to-One
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#one-to-many
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function target()
	{
		return $this->belongsTo('StartMeUp\Model\TargetIterableCheck', \CreateTargetsIterableCheckTable::FK);
	}
}
