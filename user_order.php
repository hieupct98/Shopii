<?php require_once("includes/header.php"); ?>
<?php 
if (!isLoggedIn()) {
    $_SESSION['error'] = "Bạn cần đăng nhập để thực hiện chức năng này";
    header ("Location:index.php");
    exit();
} else {
    $id = $_SESSION['ID'];
    //$user = Admin::findByID($id);
    $orders = Order::findByUser($id);
}
?>
<div class="account_website">
    <div class="container d-flex">
        <div class="sidebar w-25">
            <p class="text-secondary py-5 hello">Xin chào <?php echo $_SESSION['email']; ?></p>
            <div class="my-4"><a href="account.php" class="user-link my-5">Đổi mật khẩu</a></div>
            <div class="my-4"><a href="user_order.php" style="color:#ee4d2d;" class="user-link">Đơn hàng</a></div>
        </div>
        <div class="w-75">
            <div class="profile my-4 pt-4 px-3">
                <p class="pb-5 mb-2 hello">Đơn hàng của tôi</p>
            </div>
            <?php foreach ($orders as $order) { ?>
            <div class="profile my-5">
                <div class="my-3 px-3 pt-3 orderinfo">
                    Đơn hàng #<?php echo $order->ID; ?><br>
                    <p class="text-secondary">
                        Thanh toán vào ngày <?php echo date("d-m-Y",strtotime($order->create_at)); ?>
                        lúc <?php echo date("H:i:s",strtotime($order->create_at)); ?>
                    </p>
                </div>
                <div class="px-3">
                    <table>
                        <?php $items = Item::findByOrder($order->ID); ?>
                        <?php foreach ($items as $sp) { ?>
                        <tr>
                            <td class="py-3" style="width:125px;"><img src="img/<?php echo htmlspecialchars($sp->image); ?>"
                                    alt="<?php echo htmlspecialchars($sp->name); ?>"></td>
                            <td class="w-50 px-3"><?php echo htmlspecialchars($sp->name); ?></td>
                            <td>Số lượng mua: <?php echo $sp->quantity ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <?php } ?>
        </div>

    </div>
</div>


<?php require_once("includes/footer.php"); ?>