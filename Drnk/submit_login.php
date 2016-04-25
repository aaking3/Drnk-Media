<?php 
require_once "autoloader.php";
require "session.php";

$email = $_POST["email"];
$password = $_POST["password"];
$encryptedPassword = hash("sha256", $password);

$userDBLogin = new UserDBLogin();
$user = $userDBLogin->attemptLogin($email, $encryptedPassword);
if ($user) {
	$_SESSION['user'] = $user;
	$_SESSION['logged_in'] = true;
	header("Location: dashboard/index.php");
} else {
	$error = "Email or password incorrect.";
	header("Location: login.php?error={$error}");
}
?>