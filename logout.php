<?php 
session_start();
if (isset($_SESSION['email'])) {
    unset($_SESSION['email']);
    unset($_SESSION['roleID']);
    unset($_SESSION['Role']);
}
header("location:index.php");
?>