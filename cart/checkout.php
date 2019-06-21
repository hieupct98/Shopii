<?php
require_once("cart_header.php");
if(!isLoggedIn()) {
    $_SESSION['error'] = "Bạn cần đăng nhập để thanh toán";
    header("Location:index.php");
    exit();
}
if (empty($_SESSION['cart_item'])) {
    $_SESSION['error'] = "Không có sản phẩm nào để thanh toán";
    header("Location:index.php");
    exit();
}
if (isset($_POST['order'])) {
    $data['total'] = $_POST['total'];
    $data['create_at'] = date("Y-m-d H:i:s");
    $order = new Order($data);
    $result = $order->create($_SESSION['cart_item']);

    if ($result === true) {
        $_SESSION['message'] = "Thanh toán thành công";
        unset($_SESSION['cart_item']);
        header("Location:../index.php");
        exit();
    } else {
        $_SESSION['error'] = "Thanh toán thất bại";
        header("Location:index.php");
        exit();
    }
}
?>
<div class="container">
    <h1>Hoá đơn của bạn:</h1>
    <br>
    <br>
    <table class="table table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th scope="col">Ảnh</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thành tiền</th>
            </tr>
        </thead>
        <?php
        $sum = 0;
        $total_quantity = 0;
        foreach ($_SESSION["cart_item"] as $item) {
            $sp = Item::findByID($item['id']);
            $sum += $sp->price * $item['quantity'];
            $total_quantity += $item['quantity'];
        ?>
        <tr>
            <td style="width:200px"><img src="../img/<?php echo htmlspecialchars($sp->image); ?>"
                    alt="<?php echo htmlspecialchars($sp->name); ?>"></td>
            <td><?php echo htmlspecialchars($sp->name); ?></td>
            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
            <td>
                <div class="price">
                    <span>₫</span>
                    <span class="cost totalcost"><?php echo priceFormat($sp->price * $item['quantity']); ?></span>
                </div>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="2" class="text-right">Tổng:</td>
            <td class="text-center"><?php echo $total_quantity; ?></td>
            <td>
                <div class="price font-weight-bold">
                    <span>₫</span>
                    <span class="cost" id="totalprice"><?php echo priceFormat($sum); ?></span>
                </div>
            </td>
        </tr>
    </table>
    <br>
    <form action="" method="post">
        <input type="hidden" name="total" value="<?php echo $sum; ?>">
        <button name="order" class="btn btnBuy px-5 float-right">Thanh toán</button>
    </form>
</div>
<?php require_once("cart_footer.php"); ?>