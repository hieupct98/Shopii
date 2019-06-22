<?php
require_once("includes/autoload.php");
// echo "<pre>";
// print_r ($_SESSION['cart_item']);
// echo "</pre>";
// $arr = $_SESSION['cart_item'];
// $orderID = 1;
// $sql3 = "INSERT INTO orderdetail(orderID,productID,quantity) VALUE ";
// foreach ($arr as $item) {
//     $sp = Item::findByID($item['id']);
//     $sql3 .= "('" . $orderID . "', '";
//     $sql3 .= join("', '", array_values($item));
//     $sql3 .= "'), ";
//     echo "ID: " . $item['id'];
//     echo "<br>SL: " . ($sp->stock-$item['quantity']) . "<br>";
// }
// $sql3 = substr($sql3,0,-2);
// echo $sql3;
$arr['a'] = "";
$arr['b'] = "";
$arr['c'] = "";
if (!empty(array_filter($arr))) {
    echo 'not empty';
} else {
    echo 'EMPTY ARRAY';
}
$sql = "SELECT * FROM products INNER JOIN user_product ON products.ID = user_product.productID ";
$count_sql = str_replace("*","COUNT(*)",$sql);
echo "<br>" . $sql . "<br>" . $count_sql;
?>  
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo queryString("abc",3); ?>">Link</a>
<?php
?>