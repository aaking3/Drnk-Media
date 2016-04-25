<?php

require_once "../autoloader.php";

class JSONBuilder {

	private $barsIncluded;
	private $liquorStoresIncluded;
    private $city;
	private $activeAccountsOnly;
	
	public function __construct() {
		$this->barsIncluded = false;
		$this->liquorStoresIncluded = false;
        $this->city = false;
	}

	public function buildJSON() {
		$userDB = new UserBuilderDB();
		$users = $userDB->getAllUsers();
		$userArray = [];
		foreach ($users as $user) {
			if ($this->businessTypeShouldBeIncluded($user)) {
				$userArray[] = $user->toArray();
			}
		}
		return json_encode($userArray);
	}
	
	private function userShouldBeIncluded($user) {
		if ($this->activeAccountsOnly) {
			return $user->isAccountActive() && $user->isBusinessVerified();
		} else {
			return true;
		}
	}

    private function cityTypeBeIncluded($user){
        $companyCity = strtolower($user->getCompanyCity());
        if ($companyCity == "muncie"){
            return $this->city;
        }elseif($companyCity == "bloomington"){
            return $this->city;
        }else{
            return false;
        }
    }

	private function businessTypeShouldBeIncluded($user) {
		$businessType = strtolower($user->getBusinessType());
		if ($businessType == "bar") {
			return $this->barsIncluded;
		} elseif ($businessType == "liquor store") {
			return $this->liquorStoresIncluded;
		} else {
			return false;
		}
	}

	public function includeBars() {
		$this->barsIncluded = true;
	}

	public function includeLiquorStores() {
		$this->liquorStoresIncluded = true;
	}

    public function companyCity(){
        $this->city = true;
    }
}