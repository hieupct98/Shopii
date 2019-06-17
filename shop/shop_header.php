<?php
require_once("../includes/autoload.php");
session_start();
if (!isSeller()) {
    header("Location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../public/css/style.css" type="text/css">
    <link rel="stylesheet" href="../public/css/bootstrap.css" type="text/css">
    <title>Shopiii - Kênh người bán</title>
</head>

<body>

    <header>
        <div class="sticky-top top">
            <div class="container">
                <div class="spacebetween">
                    <div>
                        <?php if (isSeller()) { ?>
                        <a href="index.php" class="nav-link">Kênh người bán</a>
                        <?php } ?>
                    </div>
                    <div class="d-flex">
                        <a href="../cart.php" class="nav-link">Giỏ hàng</a>
                        <?php if (isLoggedIn()) { ?>
                        <a href="../logout.php" class="nav-link">Đăng xuất</a>
                        <?php } else { ?>
                        <a href="../login.php" class="nav-link">Đăng nhập</a>
                        <a href="../register.php" class="nav-link">Đăng ký</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="htext">
                        <a class="nav-link" href="../index.php">Shopii</a>
                    </div>
                    <form class="form-inline my-2 my-lg-0 ml-lg-5">
                        <input class="form-control mr-sm-2" type="search" placeholder="Tìm sản phẩm"
                            aria-label="Search">
                        <button class="btn btn-info" type="submit">Tìm kiếm</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <?php 
    if(isset($_SESSION['message']) && $_SESSION['message'] != "") {
        echo "<div class='alert alert-success' role='alert'>";
        echo $_SESSION['message'];
        clearMessage();
        echo "</div>";
    } 
    if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
        echo "<div class='alert alert-danger' role='alert'>";
        echo $_SESSION['error'];
        clearError();
        echo "</div>";
    }
    ?>

