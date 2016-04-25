<?php

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	$userDBLogin = new UserDBLogin();
	$oldUser = $_SESSION['user'];
	$updatedUser = $userDBLogin->buildUserByID($oldUser->getUserID());
	$_SESSION['user'] = $updatedUser;
}

?>