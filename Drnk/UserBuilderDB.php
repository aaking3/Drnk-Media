<?php

require_once "autoloader.php";

class UserBuilderDB {

	private $sqlConnection;

	function __construct() {
		$this->sqlConnection = new SQLConnection();
		$this->sqlConnection->initialize();
	}

	public function getAllUsers() {
		$sql = "SELECT * FROM business_users";
		$result = $this->sqlConnection->query($sql);
		$users = false;
		while($row = $result->fetch_assoc()) {
			$users[] = $this->buildUser($row);
		}
		return $users;
	}

    public function getUserByCity($company_city){
        $sql = "SELECT * FROM business_users WHERE company_city='. $company_city .'";
        $result = $this->sqlConnection->query($sql);
        $users = false;
        while($row = $result->fetch_assoc()) {
            $users[] = $this->buildUser($row);
        }
        return $users;
    }

	private function buildUser($row) {
		$email = $row['email'];
		$encryptedPassword = $row['password'];
//		$admin = $row['admin_user'];
		$accountActive = $row['account_active'];
		$userID = $row['id'];
		$user = new User($email, $encryptedPassword);
		$company = $this->buildCompany($user, $row);
		$changeRequestIsPending = (bool) $row['change_request_pending'];
		$user->setChangeRequestPending($changeRequestIsPending);
		$user->addCompany($company);
//		$user->setUserAsAdmin($admin);
		$user->userAccountActiveStatus($accountActive);
		$user->setUserID($userID);
		$changeRequestIsPending = (bool) $row['change_request_pending'];
		$user->setChangeRequestPending($changeRequestIsPending);
		if ($changeRequestIsPending) {
			$user->setCompanyInfoChangeRequest($this->buildCompanyInfoChangeRequest($user));
		}
		return $user;
	}

	private function buildCompany($user, $row) {
		$companyName = $row['company_name'];
		$businessType = $row['business_type'];
		$companyPhone = $row['company_phone'];
		$companyStreet = $row['company_street'];
		$companyCity = $row['company_city'];
		$companyState = $row['company_state'];
		$companyZip = $row['company_zip'];
		$mondayHours = $row['monday_hours'];
		$tuesdayHours = $row['tuesday_hours'];
		$wednesdayHours = $row['wednesday_hours'];
		$thursdayHours = $row['thursday_hours'];
		$fridayHours = $row['friday_hours'];
		$saturdayHours = $row['saturday_hours'];
		$sundayHours = $row['sunday_hours'];
		$shopDescription = $row['company_description'];
		$verifiedBusiness = array_key_exists('verified_business', $row) ? $row['verified_business'] : true;

		$company = new Company(
			$user,
			$companyName,
			$businessType,
			$companyPhone,
			$companyStreet,
			$companyCity,
			$companyState,
			$companyZip,
			$mondayHours,
			$tuesdayHours,
			$wednesdayHours,
			$thursdayHours,
			$fridayHours,
			$saturdayHours,
			$sundayHours,
			$shopDescription);
		return $company;
	}

	public function buildCompanyInfoChangeRequest($user) {
		$companyInfoChangeRequestSQL = $this->getCompanyInfoChangeRequestSQL($user->getUserID());
		$row = $this->sqlConnection->query($companyInfoChangeRequestSQL);
		if ($row->num_rows == 1) {
			$changeRequestCompany = $this->buildCompany($user, $row->fetch_assoc());
			$companyInfoChangeRequest = new CompanyInfoChangeRequest($user, $changeRequestCompany);
			return $companyInfoChangeRequest;
		} else {
			return false;
		}
	}

	public function getCompanyInfoChangeRequestSQL($userID) {
		$sql = "SELECT * FROM business_users
					WHERE user_id={$userID};";
		return $sql;
	}
}