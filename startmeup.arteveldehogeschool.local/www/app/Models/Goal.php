<?php namespace StartMeUp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goal extends Model {

	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'notes',
	];

	/**
	 * The attributes included in the model's JSON form.
	 *
	 * @var array
	 */
	protected $visible = [
		'id',
		'name',
		'notes',
		'target',
		'target_class',
	];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = [
		'target_class',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'deadline_at',
		'achieved_at',
	];

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

	/**
	 * Many-to-One
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#one-to-many
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo('StartMeUp\Models\Category');
	}

	/**
	 * Polymorphic One-to-One
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#polymorphic-relations
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function target()
	{
		return $this->morphTo();
	}

	/**
	 * Custom attribute that contains the class name of the Target.
	 *
	 * @return string
	 */
	public function getTargetClassAttribute()
	{
		$targetClass = new \ReflectionClass($this->target_type);

		return $targetClass->getShortName();
	}

}
