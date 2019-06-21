<?php 
require_once("cart_header.php");
$id = $_GET['id'] ?? false;
if (!$id) {
    $_SESSION['error'] = "Cần lấy sản phẩm phù hợp";
    header("Location:index.php");
    exit();
}
$sp = Item::findByID($id);
if (!$sp) {
    $_SESSION['error'] = "Cần lấy sản phẩm phù hợp";
    header("Location:../index.php");
    exit();
}
$pid = "p".$id;
if (!empty($_SESSION['cart_item'])) {
    if (array_key_exists($pid,$_SESSION['cart_item'])) {     //nếu sản phẩm đã có trong giỏ hàng
        foreach ($_SESSION['cart_item'] as $key => $value) {
            if ($key == $pid) {          //tìm sản phẩm
                unset($_SESSION["cart_item"][$key]);
            }
        }
    } else {    //nếu sản phẩm chưa có trong giỏ hàng
        header("Location:index.php");
        exit();
    }
} else {    //nếu giỏ hàng còn trống
    header("Location:index.php");
    exit();
}
header("Location:index.php");
require_once("cart_footer.php");
?>