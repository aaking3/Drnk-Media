<?php
require_once "autoloader.php";

$email = $_POST['email_creation'];
$password = $_POST['password_creation'];
$passwordConfirm = $_POST['password_creation_confirm'];

$error = false;
$errorMessage = "";

if ($password !== $passwordConfirm) {
	$error = true;
	$errorMessage = "Passwords don't match. Please make sure the password field matches the confirm password field.";
}

if (!$error) {
	$encryptedPassword = encryptPassword($password);
	$user = new User($email, $encryptedPassword);
	$user->addUserToDB();
	$status = "Account creation successful!";
	header("Location: login.php?status={$status}");
} else {
	header("Location: login.php?error={$error}");
}

function encryptPassword($password) {
	return hash("sha256", $password);
}

?>