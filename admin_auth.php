<?php
session_start();

// Replace with secure DB validation in production
$valid_user = "admin";
$valid_pass = "admin123";

if ($_POST['username'] === $valid_user && $_POST['password'] === $valid_pass) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "<script>alert('Invalid credentials'); window.location.href='admin_login.html';</script>";
}
?>
