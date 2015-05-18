<?php namespace StartMeUp\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model {

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
		'name',
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
