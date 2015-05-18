<?php namespace StartMeUp\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model {

	const COLOUR_PALETTE_A = 'A';
	const COLOUR_PALETTE_B = 'B';
	const COLOUR_PALETTE_C = 'C';
	const COLOUR_PALETTE_D = 'D';
	const COLOUR_PALETTES = [
		self::COLOUR_PALETTE_A,
		self::COLOUR_PALETTE_B,
		self::COLOUR_PALETTE_C,
		self::COLOUR_PALETTE_D,
	];

	/**
	 * One-to-One (inverse)
	 *
	 * @link http://laravel.com/docs/5.0/eloquent#one-to-one
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('StartMeUp\User');
	}

}
