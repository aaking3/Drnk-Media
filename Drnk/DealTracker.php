<?php

require_once "autoloader.php";

class DealTracker {

	private $user;
	private $deals;
	private $dealDBWriter;

	public function __construct($user) {
		$this->user = $user;
		$this->dealDBWriter = new DealDBWriter();
	}

	public function addDeals($deals) {
		$this->deals = $deals;
	}

	public function saveDeals() {
		$this->dealDBWriter->saveDeals($this->deals);
	}

	public function getDealsByDay($day) {
		return $this->dealDBWriter->getDealsByDay($this->user, $day);
	}

	public function dealsToArray() {
		if (strtolower($this->user->getBusinessType()) == "bar") {
			$deals = $this->barDealsToArray();
		} else {
			$deals = $this->liquorStoreDealsToArray();
		}
		return $deals;
	}

	private function barDealsToArray() {
		$sundayDeals = $this->getDealsByDay("sunday");
		$mondayDeals = $this->getDealsByDay("monday");
		$tuesdayDeals = $this->getDealsByDay("tuesday");
		$wednesdayDeals = $this->getDealsByDay("wednesday");
		$thursdayDeals = $this->getDealsByDay("thursday");
		$fridayDeals = $this->getDealsByDay("friday");
		$saturdayDeals = $this->getDealsByDay("saturday");

		$deals = array(
			"sunday"=>$this->dealListToArray($sundayDeals, "sunday"),
			"monday"=>$this->dealListToArray($mondayDeals, "monday"),
			"tuesday"=>$this->dealListToArray($tuesdayDeals, "tuesday"),
			"wednesday"=>$this->dealListToArray($wednesdayDeals, "wednesday"),
			"thursday"=>$this->dealListToArray($thursdayDeals, "thursday"),
			"friday"=>$this->dealListToArray($fridayDeals, "friday"),
			"saturday"=>$this->dealListToArray($saturdayDeals, "saturday")
		);
		return $deals;
	}

	private function liquorStoreDealsToArray() {
		$everydayDeals = $this->getDealsByDay("everyday");

		$deals = array(
			"everyday"=>$this->dealListToArray($everydayDeals, "everyday"),
		);
		return $deals;
	}

	private function dealListToArray($deals, $day) {
		$array = [];
		$emptyDealNumbers = array(1,2,3,4,5,6,7,8,9,10);
		for($i = 0; $i < 10; $i++) {
			if (isset($deals[$i])) {
				$array[] = $deals[$i]->toArray();
				$keyToRemove = array_search($deals[$i]->getDealNumber(), $emptyDealNumbers);
				unset($emptyDealNumbers[$keyToRemove]);
			}
		}
		foreach($emptyDealNumbers as $dealNumber) {
			$array[] = $this->addEmptyDeal($day, $dealNumber);
		}
		$array = $this->sortByDealNumber($array);
		return $array;
	}

	private function sortByDealNumber($array) {
		usort($array, function($a, $b) {
			return $a['deal_number'] - $b['deal_number'];
		});
		return $array;
	}

	private function addEmptyDeal($day, $dealNumber) {
		$dealName = "";
		$price = "0.00";
		$featured = 0;
		$deal = new Deal($this->user->getUserId(), $day, $dealNumber, $dealName, $price, $featured);
		$dealArray = $deal->toArray();
		return $dealArray;
	}

}