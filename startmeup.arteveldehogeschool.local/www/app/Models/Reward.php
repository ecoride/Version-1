<?php namespace StartMeUp\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model {

	/**
	 * Indicates if the model should be timestamped.
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
		'description',
	];

	/**
	 * Many-to-Many
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#many-to-many
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany('StartMeUp\User');
	}

}
