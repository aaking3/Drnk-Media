<?php

class Deal {

	private $userID;
	private $day;
	private $dealNumber;
	private $dealName;
	private $price;
	private $featured;
	private $premiumFeatured;

	public function __construct($userID, $day, $dealNumber,
			$dealName, $price, $featured) {
		$this->userID = (int) $userID;
		$this->day = $day;
		$this->dealNumber = (int) $dealNumber;
		$this->dealName = $dealName;
		$this->price = $price;
		$this->featured = (int) $featured;
		$this->premiumFeatured = 0;
	}

	public function getUserID() {
		return $this->userID;
	}

	public function getDay() {
		return $this->day;
	}

	public function getDealNumber() {
		return $this->dealNumber;
	}

	public function getDealName() {
		return $this->dealName;
	}

	public function getPrice() {
		return $this->price;
	}

	public function getFeatured() {
		return $this->featured;
	}


	public function toArray() {
		return array(
			"userID"=>$this->userID,
			"deal_number"=>$this->getDealNumber(),
			"deal_name"=>$this->getDealName(),
			"price"=>$this->getPrice(),
			"featured"=>$this->getFeatured()
			);
	}
}

?>