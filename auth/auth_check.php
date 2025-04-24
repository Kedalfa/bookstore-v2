<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // check the user is looged in before accessing certain features of the platform
    header("Location: ../auth/login.php");
    exit;
}
?>
