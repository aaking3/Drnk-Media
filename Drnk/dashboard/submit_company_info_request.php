<?php
require "../autoloader.php";
require "../session.php";
require "../login_check.php";

$user = $_SESSION['user'];

$companyName = $_POST['company_name'];
$businessType = isset($_POST['business_type']) ? $_POST['business_type'] : "None Chosen";
$companyPhone = $_POST['company_phone'];
$companyStreet = $_POST['company_street_address'];
$companyCity = $_POST['company_city'];
$companyState = $_POST['company_state'];
$companyZip = $_POST['company_zip'];

$mondayOpenClosed = $_POST['monday_open_closed'];
$tuesdayOpenClosed = $_POST['tuesday_open_closed'];
$wednesdayOpenClosed = $_POST['wednesday_open_closed'];
$thursdayOpenClosed = $_POST['thursday_open_closed'];
$fridayOpenClosed = $_POST['friday_open_closed'];
$saturdayOpenClosed = $_POST['saturday_open_closed'];
$sundayOpenClosed = $_POST['sunday_open_closed'];

$mondayOpenHours = $_POST['monday_open_hours'];
$tuesdayOpenHours = $_POST['tuesday_open_hours'];
$wednesdayOpenHours = $_POST['wednesday_open_hours'];
$thursdayOpenHours = $_POST['thursday_open_hours'];
$fridayOpenHours = $_POST['friday_open_hours'];
$saturdayOpenHours = $_POST['saturday_open_hours'];
$sundayOpenHours = $_POST['sunday_open_hours'];

$mondayClosedHours = $_POST['monday_closed_hours'];
$tuesdayClosedHours = $_POST['tuesday_closed_hours'];
$wednesdayClosedHours = $_POST['wednesday_closed_hours'];
$thursdayClosedHours = $_POST['thursday_closed_hours'];
$fridayClosedHours = $_POST['friday_closed_hours'];
$saturdayClosedHours = $_POST['saturday_closed_hours'];
$sundayClosedHours = $_POST['sunday_closed_hours'];

$mondayHours = renderHoursString($mondayOpenClosed, $mondayOpenHours, $mondayClosedHours);
$tuesdayHours = renderHoursString($tuesdayOpenClosed, $tuesdayOpenHours, $tuesdayClosedHours);
$wednesdayHours = renderHoursString($wednesdayOpenClosed, $wednesdayOpenHours, $wednesdayClosedHours);
$thursdayHours = renderHoursString($thursdayOpenClosed, $thursdayOpenHours, $thursdayClosedHours);
$fridayHours = renderHoursString($fridayOpenClosed, $fridayOpenHours, $fridayClosedHours);
$saturdayHours = renderHoursString($saturdayOpenClosed, $saturdayOpenHours, $saturdayClosedHours);
$sundayHours = renderHoursString($sundayOpenClosed, $sundayOpenHours, $sundayClosedHours);

$storeImagePath = "";
$verifiedBusiness = true;
$shopDescription = $_POST['company_description'];

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

//$user->submitCompanyInfoChangeRequest($company);
$userRequest = new changeRequestDBWriter();
$userRequest->submitCompanyInfoChangeRequest($user, $company);


if($user){
    echo 'submitted info';
}else{
    echo 'failed';
}

header("Location: index.php?page=business_info&status=success");

function renderHoursString($openClosed, $openHours, $closedHours) {
	return strtolower($openClosed) == "closed" ? 
	"Closed" : ($openHours . " - " . $closedHours);
}
