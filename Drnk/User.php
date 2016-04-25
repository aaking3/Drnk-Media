<?php

require_once "autoloader.php";


class User {

	private $userID;
	private $email;
	private $encryptedPassword;
	private $userDBWriter;
	private $company;
	private $companyInfoChangeRequest;
	private $admin;
	private $accountIsActive;
	private $dealTracker;
	private $changeRequestPending;

	function __construct($email, $encryptedPassword) {
		$this->email = $email;
		$this->encryptedPassword = $encryptedPassword;
		$this->userDBWriter = new UserDBWriter();
		$this->admin = false;
		$this->dealTracker = new DealTracker($this);
	}

	public function addUserToDB() {
		$this->userDBWriter->addUserToDB($this);
	}

	public function setUserAsAdmin($adminStatus) {
		$this->admin = (bool) $adminStatus;
	}

	public function userAccountActiveStatus($accountStatus) {
		$this->accountIsActive = (bool) $accountStatus;
	}

	public function setUserID($userID) {
		$this->userID = $userID;
	}

	public function getUserID() {
		return $this->userID;
	}

	public function getEmail() {
		return $this->email;
	}

	public function isAdmin() {
		return $this->admin;
	}

	public function isAccountActive() {
		return $this->accountIsActive;
	}

	public function getEncryptedPassword() {
		return $this->encryptedPassword;
	}

	public function toArray() {
		$userArray = array(
			"id"=>$this->userID,
			"email"=>$this->email,
			"company_name"=>$this->getCompanyName(),
			"business_type"=>$this->getBusinessType(),
			"company_phone"=>$this->getCompanyPhone(),
			"company_street"=>$this->getCompanyStreet(),
			"company_city"=>$this->getCompanyCity(),
			"company_zip"=>$this->getCompanyZip(),
			"monday_hours"=>$this->getMondayHours(),
			"tuesday_hours"=>$this->getTuesdayHours(),
			"wednesday_hours"=>$this->getWednesdayHours(),
			"thursday_hours"=>$this->getThursdayHours(),
			"friday_hours"=>$this->getFridayHours(),
			"saturday_hours"=>$this->getSaturdayHours(),
			"sunday_hours"=>$this->getSundayHours(),
			"company_description"=>$this->getShopDescription(),
			"deals"=>$this->dealTracker->dealsToArray()
			);
		return $userArray;	
	}

	public function addCompany(Company $company) {
		$this->company = $company;
	}

		public function getCompanyName() {
			return $this->company->getCompanyName();
		}

		public function getBusinessType() {
			return $this->company->getBusinessType();
		}
		
		public function getCompanyPhone() {
			return $this->company->getCompanyPhone();
		}
		
		public function getCompanyStreet() {
			return $this->company->getCompanyStreet();
		}
		
		public function getCompanyCity() {
			return $this->company->getCompanyCity();
		}
		
		public function getCompanyState() {
			return $this->company->getCompanyState();
		}
		
		public function getCompanyZip() {
			return $this->company->getCompanyZip();
		}
		
		public function getMondayHours() {
			return $this->company->getMondayHours();
		}
		
		public function getTuesdayHours() {
			return $this->company->getTuesdayHours();
		}
		
		public function getWednesdayHours() {
			return $this->company->getWednesdayHours();
		}
		
		public function getThursdayHours() {
			return $this->company->getThursdayHours();
		}
		
		public function getFridayHours() {
			return $this->company->getFridayHours();
		}
		
		public function getSaturdayHours() {
			return $this->company->getSaturdayHours();
		}

		public function getSundayHours() {
			return $this->company->getSundayHours();
		}

		public function getShopDescription() {
			return $this->company->getShopDescription();
		}

		public function isBusinessVerified() {
			return $this->company->getVerifiedBusiness();
		}

        public function setCompanyInfoChangeRequest($company) {
		$this->companyInfoChangeRequest = $company;
	}

	public function submitCompanyInfoChangeRequest($company) {
		$this->companyInfoChangeRequest = new CompanyInfoChangeRequest($this, $company);
		$this->companyInfoChangeRequest->submitCompanyInfoChangeRequest();
	}

	public function cancelCompanyInfoChangeRequest() {
		if ($this->changeRequestPending) {
			$this->companyInfoChangeRequest->cancelRequest();
		}
	}

	public function isCompanyChangeRequestPending() {
		return $this->changeRequestPending;
	}

	public function approveCompanyInfoChangeRequest($company) {
		$this->companyInfoChangeRequest->approveCompanyInfoChangeRequest($this);
	}

	public function setChangeRequestPending($isPending) {
		$this->changeRequestPending = (bool) $isPending;
	}
		public function getChangeRequestCompanyName() {
			return $this->companyInfoChangeRequest->getCompanyName();
		}

		public function getChangeRequestBusinessType() {
			return $this->companyInfoChangeRequest->getBusinessType();
		}
		
		public function getChangeRequestCompanyPhone() {
			return $this->companyInfoChangeRequest->getCompanyPhone();
		}
		
		public function getChangeRequestCompanyStreet() {
			return $this->companyInfoChangeRequest->getCompanyStreet();
		}
		
		public function getChangeRequestCompanyCity() {
			return $this->companyInfoChangeRequest->getCompanyCity();
		}
		
		public function getChangeRequestCompanyState() {
			return $this->companyInfoChangeRequest->getCompanyState();
		}
		
		public function getChangeRequestCompanyZip() {
			return $this->companyInfoChangeRequest->getCompanyZip();
		}
		
		public function getChangeRequestMondayHours() {
			return $this->companyInfoChangeRequest->getMondayHours();
		}
		
		public function getChangeRequestTuesdayHours() {
			return $this->companyInfoChangeRequest->getTuesdayHours();
		}
		
		public function getChangeRequestWednesdayHours() {
			return $this->companyInfoChangeRequest->getWednesdayHours();
		}
		
		public function getChangeRequestThursdayHours() {
			return $this->companyInfoChangeRequest->getThursdayHours();
		}
		
		public function getChangeRequestFridayHours() {
			return $this->companyInfoChangeRequest->getFridayHours();
		}
		
		public function getChangeRequestSaturdayHours() {
			return $this->companyInfoChangeRequest->getSaturdayHours();
		}

		public function getChangeRequestSundayHours() {
			return $this->companyInfoChangeRequest->getSundayHours();
		}

		public function getChangeRequestShopDescription() {
			return $this->companyInfoChangeRequest->getShopDescription();
		}

}