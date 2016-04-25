<?php

require_once "autoloader.php";

class changeRequestDBWriter {

	private $tableName = "business_users";

	private $sqlConnection;

	function __construct() {
		$this->sqlConnection = new SQLConnection();
		$this->addCompanyInfoChangeRequestTable();
		$this->sqlConnection->initialize();
	}

	public function cancelCompanyInfoChangeRequest($user) {
		$sql = $this->getCancelCompanyInfoChangeRequestSQL($user);
		if ($this->sqlConnection->query($sql)) {
			//success
		} else {
			//failure
		}
	}

	private function getCancelCompanyInfoChangeRequestSQL($user) {
		$sql = "UPDATE business_users
				SET
					change_request_pending = 0
				WHERE
					id = {$user->getUserID()};";
		return $sql;
	}

//	private function clearRequest($user) {
//		$sql = $this->getClearRequestSQL($user);
//		if ($this->sqlConnection->query($sql)) {
//			//success
//		} else {
//			//failure
//		}
//	}
//
//	private function getClearRequestSQL($user) {
//		$sql = "UPDATE business_users
//				SET
//					change_request_pending = 1
//				WHERE
//					user_id = {$user->getUserID()};";
//		return $sql;
//	}

	public function submitCompanyInfoChangeRequest($user, $companyInfoChangeRequest) {
		$submitChangeRequestSQL = $this->getSubmitCompanyInfoChangeRequestSQL($user, $companyInfoChangeRequest);
		$setChangeRequestPendingTrueSQL = $this->setChangeRequestPendingTrueSQL($user);
		$submitChangeRequestSuccessful = $this->sqlConnection->query($submitChangeRequestSQL);
		$setChangeRequestPendingSuccessful = $this->sqlConnection->query($setChangeRequestPendingTrueSQL);
		if ($submitChangeRequestSuccessful && $setChangeRequestPendingSuccessful) {

			//success
		} else {
			//failure
		}
	}

	private function getSubmitCompanyInfoChangeRequestSQL($user, $companyInfoChangeRequest) {
		$requestAlreadyExists = $this->checkIfRequestExists($user);
		if ($requestAlreadyExists) {
			$sql = "UPDATE business_users
					SET
						company_name = \"{$companyInfoChangeRequest->getCompanyName()}\",
						business_type = \"{$companyInfoChangeRequest->getBusinessType()}\",
						company_phone = \"{$companyInfoChangeRequest->getCompanyPhone()}\",
						company_street = \"{$companyInfoChangeRequest->getCompanyStreet()}\",
						company_city = \"{$companyInfoChangeRequest->getCompanyCity()}\",
						company_state = \"{$companyInfoChangeRequest->getCompanyState()}\",
						company_zip = \"{$companyInfoChangeRequest->getCompanyZip()}\",
						monday_hours = \"{$companyInfoChangeRequest->getMondayHours()}\",
						tuesday_hours = \"{$companyInfoChangeRequest->getTuesdayHours()}\",
						wednesday_hours = \"{$companyInfoChangeRequest->getWednesdayHours()}\",
						thursday_hours = \"{$companyInfoChangeRequest->getThursdayHours()}\",
						friday_hours = \"{$companyInfoChangeRequest->getFridayHours()}\",
						saturday_hours = \"{$companyInfoChangeRequest->getSaturdayHours()}\",
						sunday_hours = \"{$companyInfoChangeRequest->getSundayHours()}\",
						company_description = \"{$companyInfoChangeRequest->getShopDescription()}\"
					WHERE
						user_id = {$user->getUserID()};";
		}
        else {
			$sql = "INSERT INTO
						business_users (user_id, company_name, business_type, company_phone, company_street,
						 		company_city, company_state, company_zip, monday_hours,
						 		tuesday_hours, wednesday_hours, thursday_hours, friday_hours,
						 		saturday_hours, sunday_hours, company_description)
					VALUES(
						\"{$user->getUserID()}\",
						\"{$companyInfoChangeRequest->getCompanyName()}\",
						\"{$companyInfoChangeRequest->getBusinessType()}\",
						\"{$companyInfoChangeRequest->getCompanyPhone()}\",
						\"{$companyInfoChangeRequest->getCompanyStreet()}\",
						\"{$companyInfoChangeRequest->getCompanyCity()}\",
						\"{$companyInfoChangeRequest->getCompanyState()}\",
						\"{$companyInfoChangeRequest->getCompanyZip()}\",
						\"{$companyInfoChangeRequest->getMondayHours()}\",
						\"{$companyInfoChangeRequest->getTuesdayHours()}\",
						\"{$companyInfoChangeRequest->getWednesdayHours()}\",
						\"{$companyInfoChangeRequest->getThursdayHours()}\",
						\"{$companyInfoChangeRequest->getFridayHours()}\",
						\"{$companyInfoChangeRequest->getSaturdayHours()}\",
						\"{$companyInfoChangeRequest->getSundayHours()}\",
                        \"{$companyInfoChangeRequest->getShopDescription()}\"

					);";
		}
		return $sql;
	}

	private function checkIfRequestExists($user) {
		$sql = "SELECT * FROM business_users WHERE
					user_id={$user->getUserID()}";
		$rows = $this->sqlConnection->query($sql);
		return $rows->num_rows > 0;
	}

	private function setChangeRequestPendingTrueSQL($user) {
		$sql = "UPDATE business_users
				SET change_request_pending = 1
				WHERE id={$user->getUserID()}";
		return $sql;
	}

	private function addCompanyInfoChangeRequestTable() {
		$sql = "CREATE TABLE IF NOT EXISTS business_users (" .
			"id INTEGER(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY," .
			"user_id INTEGER NOT NULL, " .
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
			"company_description VARCHAR(255))";

		$this->sqlConnection->addTable($sql);
	}
}