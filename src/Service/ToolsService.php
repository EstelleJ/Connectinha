<?php

namespace App\Service;

class ToolsService {

	public function translateWeekday($english_weekday): string {
		$day = strtolower($english_weekday);
		return match ($day) {
			'monday' => 'lundi',
			'tuesday' => 'mardi',
			'wednesday' => 'mercredi',
			'thursday' => 'jeudi',
			'friday' => 'vendredi',
			'saturday' => 'samedi',
			'sunday' => 'dimanche',
			default => 'Invalid weekday',
		};
	}
}
