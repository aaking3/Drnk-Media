<?php

	require "../autoloader.php";
    require "../session.php";
    require "../refresh_user.php";
    require "../login_check.php";
    $page = isset($_GET['page']) ? $_GET['page'] : "my_profile";
    $admin = (isset($user) && $user->isAdmin()) ? "Admin" : "";

    $user->cancelCompanyInfoChangeRequest();

    header("Location: index.php?page=business_info&business_page=live");

?>