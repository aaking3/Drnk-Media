<?php

class CompanyInfoChangeRequest {

	private $user;
	private $changeRequestDBWriter;
	private $companyName;
	private $businessType;
	private $companyPhone;
	private $companyStreet;
	private $companyCity;
	private $companyState;
	private $companyZip;
	private $mondayHours;
	private $tuesdayHours;
	private $wednesdayHours;
	private $thursdayHours;
	private $fridayHours;
	private $saturdayHours;
	private $sundayHours;
	private $shopDescription;
	private $verifiedBusiness;

	private $company;

	function __construct($user, $company) {

		$this->user = $user;
		$this->changeRequestDBWriter = new changeRequestDBWriter();

		$this->companyName = $company->getCompanyName();
		$this->businessType = $company->getBusinessType();
		$this->companyPhone = $company->getCompanyPhone();
		$this->companyStreet = $company->getCompanyStreet();
		$this->companyCity = $company->getCompanyCity();
		$this->companyState = $company->getCompanyState();
		$this->companyZip = $company->getCompanyZip();
		$this->mondayHours = $company->getMondayHours();
		$this->tuesdayHours = $company->getTuesdayHours();
		$this->wednesdayHours = $company->getWednesdayHours();
		$this->thursdayHours = $company->getThursdayHours();
		$this->fridayHours = $company->getFridayHours();
		$this->saturdayHours = $company->getSaturdayHours();
		$this->sundayHours = $company->getSundayHours();
		$this->shopDescription = $company->getShopDescription();
		$this->verifiedBusiness = $company->getVerifiedBusiness();

		$this->company = $company;
	}

	public function submitCompanyInfoChangeRequest() {
		$this->changeRequestDBWriter->submitCompanyInfoChangeRequest($this->user, $this);
	}

	public function approveCompanyInfoChangeRequest() {
		$this->changeRequestDBWriter->approveCompanyInfoChangeRequest($this->user, $this);
	}

	public function cancelRequest() {
		$this->changeRequestDBWriter->cancelCompanyInfoChangeRequest($this->user);
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

	public function getVerifiedBusiness() {
		return $this->company->getVerifiedBusiness();
	}
}