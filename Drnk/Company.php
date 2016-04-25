<?php

class Company {

	
	private $companyInfoChangeRequest;

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

	function __construct($user, $companyName, $businessType, $companyPhone, 
		$companyStreet,	$companyCity, $companyState, $companyZip, $mondayHours,
		$tuesdayHours, $wednesdayHours, $thursdayHours, $fridayHours,
		$saturdayHours, $sundayHours, $shopDescription, $verifiedBusiness) {

		$this->companyName = $companyName;
		$this->businessType = $businessType;
		$this->companyPhone = $companyPhone;
		$this->companyStreet = $companyStreet;
		$this->companyCity = $companyCity;
		$this->companyState = $companyState;
		$this->companyZip = $companyZip;
		$this->mondayHours = $mondayHours;
		$this->tuesdayHours = $tuesdayHours;
		$this->wednesdayHours = $wednesdayHours;
		$this->thursdayHours = $thursdayHours;
		$this->fridayHours = $fridayHours;
		$this->saturdayHours = $saturdayHours;
		$this->sundayHours = $sundayHours;
		$this->shopDescription = $shopDescription;
		$this->verifiedBusiness = $verifiedBusiness;

	}

	public function getCompanyName() {
		return $this->companyName;
	}

	public function getBusinessType() {
		return $this->businessType;
	}
	
	public function getCompanyPhone() {
		return $this->companyPhone;
	}
	
	public function getCompanyStreet() {
		return $this->companyStreet;
	}
	
	public function getCompanyCity() {
		return $this->companyCity;
	}
	
	public function getCompanyState() {
		return $this->companyState;
	}
	
	public function getCompanyZip() {
		return $this->companyZip;
	}
	
	public function getMondayHours() {
		return $this->mondayHours;
	}
	
	public function getTuesdayHours() {
		return $this->tuesdayHours;
	}
	
	public function getWednesdayHours() {
		return $this->wednesdayHours;
	}
	
	public function getThursdayHours() {
		return $this->thursdayHours;
	}
	
	public function getFridayHours() {
		return $this->fridayHours;
	}
	
	public function getSaturdayHours() {
		return $this->saturdayHours;
	}

	public function getSundayHours() {
		return $this->sundayHours;
	}

	public function getShopDescription() {
		return $this->shopDescription;
	}

	public function getVerifiedBusiness() {
		return $this->verifiedBusiness;
	}
}