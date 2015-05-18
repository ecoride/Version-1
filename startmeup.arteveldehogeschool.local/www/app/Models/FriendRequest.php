<?php namespace StartMeUp\Models;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model {

	const STATUS_PENDING  = 'pending';
	const STATUS_ACCEPTED = 'accepted';
	const STATUS_BLOCKED  = 'blocked';
	const STATUSES = [
		self::STATUS_PENDING,
		self::STATUS_ACCEPTED,
		self::STATUS_BLOCKED,
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
	public function friend()
	{
		return $this->belongsTo('StartMeUp\User');
	}

}
