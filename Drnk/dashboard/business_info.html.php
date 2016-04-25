<?php

require_once "../autoloader.php";

const DEFAULT_PAGE = "live";

$businessPage = !empty($_GET["business_page"]) ? $_GET["business_page"] : "live";

$changeRequestIsPending = $user->isCompanyChangeRequestPending();

$livePageSelected = $businessPage == "live" ? "class=\"active\"" : "";

if ($businessPage == "live") {

	$companyName = $user->getCompanyName();
	$businessType = $user->getBusinessType();
	$shopDescription = $user->getShopDescription();
	$isBusinessVerified = $user->isBusinessVerified();

	$companyPhone = $user->getCompanyPhone();
	$companyStreet = $user->getCompanyStreet();
	$companyCity = $user->getCompanyCity();
	$companyState = $user->getCompanyState();
	$companyZip = $user->getCompanyZip();

	$monday = new Day("monday", $user->getMondayHours());
	$tuesday = new Day("tuesday", $user->getTuesdayHours());
	$wednesday = new Day("wednesday", $user->getWednesdayHours());
	$thursday = new Day("thursday", $user->getThursdayHours());
	$friday = new Day("friday", $user->getFridayHours());
	$saturday = new Day("saturday", $user->getSaturdayHours());
	$sunday = new Day("sunday", $user->getSundayHours());

}

$statusSuccess = isset($_GET['status']) ? $_GET['status'] : false;

function booleanToYesNo($bool) {
	$convertedString = $bool ? "Yes" : "No";
	return $convertedString;
}

function businessHours($day) {
	$dayOfTheWeek = strtolower($day->getDayOfTheWeek());
	$dayOfTheWeekCapitalized = ucfirst($dayOfTheWeek);
	$htmlForBusinessHours = "<div class=\"form-inline\">
								<td>
									<label for=\"{$dayOfTheWeek}_hours\">{$dayOfTheWeekCapitalized} Hours</label>
								</td>
								<td>".														
									 renderOpenClosedSelect($day) .
								"</td>
								<td>" .
									renderOpenHoursSelect($day) .
								"</td>
								 <td>" .
									renderClosedHoursSelect($day) .
								 "</td>
							</div>";
	return $htmlForBusinessHours;
}

function renderOpenClosedSelect($day) {
	$isOpenSelected = $day->isBusinessOpen();
	$isClosedSelected = !$day->isBusinessOpen();
	$openClosedHTML = "<select name=\"{$day->getDayOfTheWeek()}_open_closed\" class=\"form-control\">
							<option " . ($isOpenSelected ? "selected" : "") . ">Open</option>
							<option " . ($isClosedSelected ? "selected" : "") . ">Closed</option>
						</select>";
	return $openClosedHTML;
}

function renderOpenHoursSelect($day) {
	$renderingOpenHours = true;
	return renderOpenClosedHoursSelect($day, $renderingOpenHours);
}

function renderClosedHoursSelect($day) {
	$renderingOpenHours = false;
	return renderOpenClosedHoursSelect($day, $renderingOpenHours);
}

function renderOpenClosedHoursSelect($day, $renderingOpenHours) {
	if ($renderingOpenHours) {
		$htmlClassName = $day->getDayOfTheWeek() . "_open_hours";
		$businessHour = $day->getOpenTime();
	} else {
		$htmlClassName = $day->getDayOfTheWeek() . "_closed_hours";
		$businessHour = $day->getClosedTime();
	}
	$element = "<select class='form-control' name='{$htmlClassName}' id='{$htmlClassName}'>";
	for ($i = 0; $i < 2; $i++) {
		for ($j = 0; $j < 12; $j++) {
			for ($k = 0; $k < 4; $k++) {
				$AMPM = ($i == 0 ? "AM" : "PM");
				$hour = ($j == 0 ? 12 : $j);
				$hour = sprintf('%02d', $hour);
				$minutes = 15 * $k;
				$minutes = sprintf('%02d', $minutes);
				$time = "{$hour}:{$minutes} {$AMPM}";
				$selected = $time == $businessHour ? "selected" : "";
				
				$element = $element . "<option value='{$time}' {$selected}>{$time}</option>";
			}
		}
	}
	$element = $element . '</select>';
	return $element;
}

?>
<div class="page-wrapper my_profile_wrapper">
	<div class="container-fluid">
	    <div class="row">
	        <div class="col-md-8 col-md-offset-2">
				<form method="POST" action="submit_company_info_request.php" style="margin-top: 20px;">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="form-group">
								<div class="row">
			        				<div class="col-md-12">
										<h2 class="text-center">Business Information</h2>
										<h3 class="text-center">This is the information your customers will see inside the DRNK App</h3>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-body text-bold">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li role="presentation" <?= $livePageSelected ?>><a href="?page=business_info&business_page=live">Live</a></li>

								</ul>
							</div>
							
								<div class="form-group">
									<div class="row">
				        				<div class="col-md-12">
			        						<div class="col-md-8 col-md-offset-2">
                                                <?php if ($livePageSelected) { ?>
							        					<div class="panel panel-default">
						        							<div class="panel-heading">
								        						<h3>Company Info</h3>
								        					</div>
								        					<div class="panel-body">
																<div class="form-group">
																	<label for="company_name">Company Name</label>
																	<input class="form-control" type="text" id="company_name" name="company_name" value="<?= $companyName ?>" >
																</div>
																<div class="form-group">
																	<label for="company_description">Company Description</label>
																	<textarea class="form-control" id="company_description" name="company_description"><?= $shopDescription ?></textarea>
																</div>
																<div class="form-group">
																	<label for="company_phone">Company Phone</label>
																	<input class="form-control" type="tel" id="company_phone" name="company_phone" value="<?= $companyPhone ?>">
																</div>
																<div class="form-inline">
										        					<strong>Business Type: </strong>
										        					<select class="form-control" name="business_type" value="Liquor Store">
										        						<option >None Chosen</option>
																		<option <?= strtolower($businessType) == "bar" ? "selected='selected'" : ""; ?>>Bar</option>
																		<option <?= strtolower($businessType) == "liquor store" ? "selected='selected'" : ""; ?>>Liquor Store</option>
																	</select>
																</div>
															</div>
														</div>

														<div class="panel panel-default">
						        							<div class="panel-heading">
																<h3>Company Address</h3>
															</div>
															<div class="panel-body">
																<div class="form-group">
																	<label for="company_street">Street Address</label>
																	<input class="form-control" type="text" id="company_street" name="company_street_address" value="<?= $companyStreet ?>">

																	<label for="company_city">City</label>
																	<input class="form-control" type="text" id="company_city" name="company_city" value="<?= $companyCity ?>">
																	
																	<label for="company_state">State</label>
																	<input class="form-control" type="text" id="company_state" name="company_state" value="<?= $companyState ?>">

																	<label for="company_zip">Zip</label>
																	<input class="form-control" type="number" id="company_zip" name="company_zip" value="<?= $companyZip ?>">
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h3>Business Hours</h3>
															</div>
															<div class="panel-body">
																<table class="business-hours-table">
																	<tr>
																		<?= businessHours($monday); ?>
																	</tr>
																	<tr>
																		<?= businessHours($tuesday); ?>
																	</tr>
																	<tr>
																		<?= businessHours($wednesday); ?>
																	</tr>
																	<tr>
																		<?= businessHours($thursday); ?>
																	</tr>
																	<tr>
																		<?= businessHours($friday); ?>
																	</tr>
																	<tr>
																		<?= businessHours($saturday); ?>
																	</tr>
																	<tr>
																		<?= businessHours($sunday); ?>
																	</tr>

																</table>
															</div>
														</div>
<!--														--><?php //if (!$changeRequestIsPending) { ?>
															<div class="form-group">
																<input type="submit" class="btn btn-lg btn-primary btn-block text-bold" value="Submit Changes for Approval">
															</div>
														<?php  }?>
											</div>
										</div>
									</div>
								</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>