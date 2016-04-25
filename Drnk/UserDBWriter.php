<?php

require_once "autoloader.php";

class UserDBWriter {

	private $sqlConnection;

	function __construct() {
		$this->sqlConnection = 
			new SQLConnection();

		$this->addUserTable();
		$this->sqlConnection->initialize();
	}

	public function addUserToDB($user) {
		$email = $user->getEmail();
		$encryptedPassword = $user->getEncryptedPassword();
		$sql = $this->getSQLToAddUserToDB($user);
		if ($this->sqlConnection->query($sql)) {
			//success
		} else {
			//failure
		}
	}

	private function getSQLToAddUserToDB($user) {
		$sql = "INSERT INTO
					business_users(email, password)
				VALUES(
					\"{$user->getEmail()}\",
					\"{$user->getEncryptedPassword()}\");";
		return $sql;
	} 

	private function addUserTable() {
		$sql = "CREATE TABLE IF NOT EXISTS business_users (" .
			"id INTEGER(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY," .
			"email VARCHAR(50) NOT NULL," .
			"password VARCHAR(100) NOT NULL," .
			"company_name VARCHAR(100)," .
			"business_type VARCHAR(30)," .
			"company_phone VARCHAR(20)," .
			"company_street VARCHAR(50)," .
			"company_city VARCHAR(50)," .
			"company_state VARCHAR(30)," .
			"company_zip VARCHAR(20)," .
			"monday_hours VARCHAR(30)," .
			"tuesday_hours VARCHAR(30)," .
			"wednesday_hours VARCHAR(30)," .
			"thursday_hours VARCHAR(30)," .
			"friday_hours VARCHAR(30)," .
			"saturday_hours VARCHAR(30)," .
			"sunday_hours VARCHAR(30)," .
			"shop_description VARCHAR(255)," .
			"account_active BOOLEAN DEFAULT FALSE," .
			"verified_business BOOLEAN DEFAULT FALSE," .
			"change_request_pending BOOLEAN DEFAULT FALSE," .
			"admin_user BOOLEAN DEFAULT FALSE);";
		$this->sqlConnection->addTable($sql);
	}
}