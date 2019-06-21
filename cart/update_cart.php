<?php 
require_once("../includes/autoload.php");
$id = $_POST['id'] ?? false;
$quantity = $_POST['quantity'] ?? false;
$quantity=$quantity<=0 ? 1 : $quantity;     //nếu số lượng nhỏ hơn 1 thì set nó bằng 1
if (!$id || !$quantity) {
    $_SESSION['error'] = "Cần lấy sản phẩm và số lượng phù hợp";
    header("Location:index.php");
    exit();
}
$pid = "p".$id;
$sum = 0;
$total_quantity = 0;
foreach ($_SESSION['cart_item'] as $key => $value) {
    $sp = Item::findByID($_SESSION['cart_item'][$key]['id']);
    if ($key == $pid) {          //tìm sản phẩm
        $_SESSION['cart_item'][$key]['quantity'] = $quantity;      //thêm số lượng
        if ($_SESSION['cart_item'][$key]['quantity'] > $sp->stock) {
            $_SESSION['cart_item'][$key]['quantity'] = $sp->stock;  //không được vượt quá số sản phẩm có sẵn
        }
        $r['pcost']=$_SESSION['cart_item'][$key]['quantity'] * $sp->price;
    }
    $sum += $sp->price * $_SESSION['cart_item'][$key]['quantity'];
    $total_quantity += $_SESSION['cart_item'][$key]['quantity'];
}
$r['tcost'] = $sum;
$r['tquantity'] = $total_quantity;
echo json_encode($r);
?>