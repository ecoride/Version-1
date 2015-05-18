<?php

use Carbon\Carbon;
use StartMeUp\Models\TargetCheck;
use StartMeUp\Models\TargetIterableCheck;
use StartMeUp\Models\TargetTime;
use StartMeUp\Models\UpdateIterableCheck;
use StartMeUp\Models\UpdateTime;

class TargetableUpdateTableSeeder extends StartMeUpSeeder {

	public function run()
	{
		$targetsCheck = TargetCheck::all();

		foreach ($targetsCheck as $target) {
			$dates = [
				Carbon::now()->addDay(-3),
				Carbon::now()->addDay(-2),
				Carbon::now()->addDay(-1),
				Carbon::now(),
			];
			$target->achieved_at = $this->faker->optional($weight = .75, $default = null)->randomElement($dates);
			$target->save();
		}

		$targetsIterableCheck = TargetIterableCheck::all();

		$iMax = 5;

		foreach ($targetsIterableCheck as $target) {
			$updates = [];
			for ($i = $iMax - 1; $i > 0; --$i) {
				$update = new UpdateIterableCheck(['achieved_at' => Carbon::now()->addDay(-$i)]);
				array_push($updates, $update);
			}
			$target->updates()->saveMany($updates);
		}

		$targetsTime = TargetTime::all();

		foreach ($targetsTime as $target) {
			$updates = [];
			for ($i = 0; $i < $iMax; ++$i) {
				$update = new UpdateTime(['time_incrementation' => $this->faker->numberBetween($min = 1, $max = 96)]);
				array_push($updates, $update);
			}
			$target->updates()->saveMany($updates);
		}

	}

}
