<?php

class DealDBWriter extends SQLConnection {

	private $sqlConnection;

	function __construct() {
		$this->sqlConnection = new SQLConnection();
		$this->createDealsTable();
		$this->sqlConnection->initialize();
	}

	public function getDealsByDay($user, $day) {
		$sql = "SELECT * FROM deals WHERE day=\"{$day}\" AND user_id={$user->getUserID()} ORDER BY deal_number";
		$rows = $this->sqlConnection->query($sql);
		if ($rows->num_rows > 0) {
			while ($row = $rows->fetch_assoc()) {
				$deals[] = $this->buildDealByRow($row);
			}
		} else {
			$deals = [];
		}
		return $deals;
	}

	private function buildDealByRow($row) {
		$deal = new Deal(
			$row['user_id'], 
			$row['day'], 
			$row['deal_number'], 
			$row['deal_name'], 
			$row['price'], 
			$row['featured']
			);
		return $deal;
	}

	public function saveDeals($deals) {
		foreach ($deals as $deal) {
			$sql = $this->saveDeal($deal);
		}
	}

	private function saveDeal($deal) {
		$dealExists = $this->checkIfDealExists($deal);
		$sql = $this->getSQL($dealExists, $deal);
		if ($this->sqlConnection->query($sql)) {
			//success
		} else {
			//failure
		}	
		return $sql;
	}

	private function checkIfDealExists($deal) {
		$sql = "SELECT * FROM deals WHERE 
					user_id={$deal->getUserID()} AND 
					deal_number={$deal->getDealNumber()} AND
					day=\"{$deal->getDay()}\"";
		$rows = $this->sqlConnection->query($sql);
		return $rows->num_rows > 0;
	}

	private function getSQL($dealExists, $deal) {
		if ($dealExists) {
			$sql = "UPDATE deals
					SET 
						deal_name = \"{$deal->getDealName()}\",
						price = TRUNCATE({$deal->getPrice()}, 2),
						featured = {$deal->getFeatured()}
					WHERE 
						user_id = {$deal->getUserID()} AND
						deal_number = {$deal->getDealNumber()} AND
						day=\"{$deal->getDay()}\";"; 
		} else {
			$sql = "INSERT INTO 
						deals(user_id, day, deal_number, deal_name, price, featured)
					VALUES(
						{$deal->getUserID()}, 
						\"{$deal->getDay()}\",
						{$deal->getDealNumber()}, 
						\"{$deal->getDealName()}\",
						TRUNCATE({$deal->getPrice()}, 2),
						{$deal->getFeatured()}
					);";	
		}
		return $sql;
	}

	private function createDealsTable() {
		$sql = "CREATE TABLE IF NOT EXISTS deals (" .
			"id INTEGER(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY," .
			"user_id INTEGER NOT NULL," .
			"day VARCHAR(20) NOT NULL," .
			"deal_number INTEGER NOT NULL," .
			"deal_name VARCHAR(50) NOT NULL," .
			"price DECIMAL(6,2) NOT NULL," .
			"featured BOOLEAN DEFAULT FALSE," .
			"premium_featured BOOLEAN DEFAULT FALSE);";
		$this->sqlConnection->addTable($sql);
	}
}