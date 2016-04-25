<?php

require_once "../autoloader.php";

class Day {

	private $dayOfTheWeek;
	private $businessHours;
	private $openTime;
	private $closedTime;

	public function __construct($dayOfTheWeek, $businessHours) {
		$this->dayOfTheWeek = strtolower($dayOfTheWeek);
		$this->businessHours = $businessHours;
		$this->setOpenTime($businessHours);
		$this->setClosedTime($businessHours);
	}

	public function getDayOfTheWeek() {
		return $this->dayOfTheWeek;
	}

	public function isBusinessOpen() {
		return strtolower($this->businessHours) != "closed";
	}

	public function getOpenTime() {
		return $this->openTime;
	}

	public function getClosedTime() {
		return $this->closedTime;
	}

	private function setOpenTime($businessHours) {
		$time = substr($businessHours, 0, strpos($businessHours,"-"));
		$this->openTime = strtoupper(trim($time));
	}

	private function setClosedTime($businessHours) {
		if (strpos($businessHours,"-")) {
			$time = substr($businessHours, strpos($businessHours,"-") + 1);	
		} else {
			$time = $businessHours;
		}
		$this->closedTime = strtoupper(trim($time));
	}
}