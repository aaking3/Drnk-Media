<?php
	require_once "../autoloader.php";
	require "../session.php";
    require "../refresh_user.php";
    require "../login_check.php";

	$day = $_POST['day'];
	$user = $_SESSION['user'];
	$user_id = $user->getUserID();

	$dealName1 = $_POST['deal-1'];
	$dealName2 = $_POST['deal-2'];
	$dealName3 = $_POST['deal-3'];
	$dealName4 = $_POST['deal-4'];
	$dealName5 = $_POST['deal-5'];
	$dealName6 = $_POST['deal-6'];
	$dealName7 = $_POST['deal-7'];
	$dealName8 = $_POST['deal-8'];
	$dealName9 = $_POST['deal-9'];
	$dealName10 = $_POST['deal-10'];

	$dealNumber1 = 1;
	$dealNumber2 = 2;
	$dealNumber3 = 3;
	$dealNumber4 = 4;
	$dealNumber5 = 5;
	$dealNumber6 = 6;
	$dealNumber7 = 7;
	$dealNumber8 = 8;
	$dealNumber9 = 9;
	$dealNumber10 = 10;

	$price1 = $_POST['price-1'];
	$price2 = $_POST['price-2'];
	$price3 = $_POST['price-3'];
	$price4 = $_POST['price-4'];
	$price5 = $_POST['price-5'];
	$price6 = $_POST['price-6'];
	$price7 = $_POST['price-7'];
	$price8 = $_POST['price-8'];
	$price9 = $_POST['price-9'];
	$price10 = $_POST['price-10'];

	$featuredDeal1 = isset($_POST['featured-1']) ? 1 : 0;
	$featuredDeal2 = isset($_POST['featured-2']) ? 1 : 0;
	$featuredDeal3 = isset($_POST['featured-3']) ? 1 : 0;
	$featuredDeal4 = isset($_POST['featured-4']) ? 1 : 0;
	$featuredDeal5 = isset($_POST['featured-5']) ? 1 : 0;
	$featuredDeal6 = isset($_POST['featured-6']) ? 1 : 0;
	$featuredDeal7 = isset($_POST['featured-7']) ? 1 : 0;
	$featuredDeal8 = isset($_POST['featured-8']) ? 1 : 0;
	$featuredDeal9 = isset($_POST['featured-9']) ? 1 : 0;
	$featuredDeal10 = isset($_POST['featured-10']) ? 1 : 0;

	$featuredDeals = array(
		$featuredDeal1,
		$featuredDeal2,
		$featuredDeal3,
		$featuredDeal4,
		$featuredDeal5,
		$featuredDeal6,
		$featuredDeal7,
		$featuredDeal8,
		$featuredDeal9,
		$featuredDeal10
		);

	$featuredCount = 0;
	$numValidFeaturedDeals = 0;
	foreach ($featuredDeals as $featuredDeal) {
		if ($featuredDeal == 1) {
			$featuredCount++;
		}
	}
	
	$success = true;
	$errorMessage = "";
	if ($featuredCount <= 3) {
		$deals = array(
				new Deal($user_id, $day, $dealNumber1,
					$dealName1, $price1, $featuredDeal1),
				new Deal($user_id, $day, $dealNumber2,
					$dealName2, $price2, $featuredDeal2),
				new Deal($user_id, $day, $dealNumber3,
					$dealName3, $price3, $featuredDeal3),
				new Deal($user_id, $day, $dealNumber4,
					$dealName4, $price4, $featuredDeal4),
				new Deal($user_id, $day, $dealNumber5,
					$dealName5, $price5, $featuredDeal5),
				new Deal($user_id, $day, $dealNumber6,
					$dealName6, $price6, $featuredDeal6),
				new Deal($user_id, $day, $dealNumber7,
					$dealName7, $price7, $featuredDeal7),
				new Deal($user_id, $day, $dealNumber8,
					$dealName8, $price8, $featuredDeal8),
				new Deal($user_id, $day, $dealNumber9,
					$dealName9, $price9, $featuredDeal9),
				new Deal($user_id, $day, $dealNumber10,
					$dealName10, $price10, $featuredDeal10)
			);

		$dealTracker = new DealTracker($user);
		$dealTracker->addDeals($deals);
		$dealTracker->saveDeals();
	} elseif ($featuredCount > 3) {
		$success = false;
		$errorMessage = "Too many featured deals. The maximum number of featured deals is 3.";
	}

	if ($success) {
		header("Location: index.php?page=edit_deals&day={$day}&status=success");
	} else {
		header("Location: index.php?page=edit_deals&day={$day}&status=failure&error_message={$errorMessage}");
	}
	
?>