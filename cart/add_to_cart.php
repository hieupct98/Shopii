<?php 
require_once("cart_header.php");
$id = $_GET['id'] ?? false;
$quantity = $_GET['quantity'] ?? 1;
if (!$id) {
    $_SESSION['error'] = "Cần lấy sản phẩm phù hợp";
    header("Location:../index.php");
    exit();
}
$sp = Item::findByID($id);
if (!$sp) {
    $_SESSION['error'] = "Cần lấy sản phẩm phù hợp";
    header("Location:../index.php");
    exit();
}
$pid = "p".$id;
$itemArray = array("$pid"=>array('id'=>$id,'quantity'=>$quantity));
if (!empty($_SESSION['cart_item'])) {
    if (array_key_exists($pid,$_SESSION['cart_item'])) {     //nếu sản phẩm đã có trong giỏ hàng
        foreach ($_SESSION['cart_item'] as $key => $value) {
            if ($key == $pid) {              //tìm sản phẩm
                $_SESSION['cart_item'][$key]['quantity'] += $quantity;      //thêm số lượng
                if ($_SESSION['cart_item'][$key]['quantity'] > $sp->stock) {
                    $_SESSION['cart_item'][$key]['quantity'] = $sp->stock;  //không được vượt quá số sản phẩm có sẵn
                }
            }
        }
    } else {    //nếu sản phẩm chưa có trong giỏ hàng
        $_SESSION['cart_item'] = array_merge($_SESSION['cart_item'],$itemArray);
    }
} else {    //nếu giỏ hàng còn trống
    $_SESSION['cart_item'] = $itemArray;
}
$_SESSION['message'] = "Đã thêm sản phẩm vào giỏ hàng";
header("Location:../productdetail.php?id=$id");
require_once("cart_footer.php");
?>