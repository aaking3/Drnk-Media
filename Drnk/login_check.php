<?php

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $user = $_SESSION['user'];
} else {
    header("Location: ../login.php");
}

?>