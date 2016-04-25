<?php
require "../autoloader.php";
require "../session.php";
require "../login_check.php";

$userDBLogin = new UserDBLogin();
$user = $userDBLogin->buildUserByID(1);
echo "Verifying user {$user->getEmail()}";
$user->verifyCompany();
?>