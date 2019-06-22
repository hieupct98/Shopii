<?php
require_once("autoload.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/style.css" type="text/css">
    <link rel="stylesheet" href="public/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="public/css/slick.css" type="text/css">
    <link rel="stylesheet" href="public/css/slick-theme.css" type="text/css">
    
    <title>Shopiii</title>
</head>

<body>
    <!-- begin nav -->
    <header>
        <div class="top">
            <div class="container">
                <div class="spacebetween">
                    <div>
                        <?php if (isSeller()) { ?>
                        <a href="shop/index.php" class="nav-link">Kênh người bán</a>
                        <?php } ?>
                        <?php if (isAdmin()) { ?>
                        <a href="admin/index.php" class="nav-link">Quản lý</a>
                        <?php } ?>
                    </div>
                    <div class="d-flex">
                        <a href="cart/index.php" class="nav-link">Giỏ hàng</a>
                        <?php if (isLoggedIn()) { ?>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $_SESSION['email']; ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a href="account.php" class="nav-link text-secondary">Tài khoản</a>
                                <a href="logout.php" class="nav-link text-secondary">Đăng xuất</a>
                            </div>
                        </div>
                        <?php } else { ?>
                        <a href="login.php" class="nav-link">Đăng nhập</a>
                        <a href="register.php" class="nav-link">Đăng ký</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="htext">
                        <a class="nav-link" href="index.php">Shopii</a>
                    </div>
                    <form action="products.php" method="get" class="form-inline frmSearch my-2 my-lg-0 ml-lg-5">
                        <input class="form-control mr-sm-2" name="search" type="search" placeholder="Tìm sản phẩm"
                            id="txtFind" aria-label="Search">
                        <input type="submit" class="btn btn-primary" id="btnFind" value="Tìm kiếm">
                    </form>
                </div>
            </div>
        </div>
    </header>
    <?php if(isset($_SESSION['message']) && $_SESSION['message'] != "") { ?>
        <div class="container pt-3">     
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                echo $_SESSION['message'];
                clearMessage();
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?> 
        <?php if(isset($_SESSION['error']) && $_SESSION['error'] != "") { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                echo $_SESSION['error'];
                clearError();
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    </div>
    <?php } ?> 
