<?php require_once("cart_header.php"); ?>
<div class="container">
    <h1>Giỏ hàng:</h1>
    <br>
    <br>
    <?php if (!empty($_SESSION['cart_item'])) { ?>
    <br>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Ảnh</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Số tiền</th>
                <th scope="col">Xoá</th>
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
            <td>
                <span>₫</span>
                <span class="cost"><?php echo priceFormat(htmlspecialchars($sp->price)); ?></span>
                <span class="d-none productprice"><?php echo $sp->price ?></span>
            </td>
            <td style="width:15%;">
                <form action="" class="update_quantity_form">
                    <div class="d-none product_id"><?php echo htmlspecialchars($sp->ID); ?></div>
                    <input type="number" min="1" max="<?php echo $sp->stock; ?>"
                        value="<?php echo $item['quantity']; ?>" name="quantity" class="update_quantity">
                </form>
            </td>
            <td style="width:20%;">
                <div class="price">
                    <span>₫</span>
                    <span class="cost totalcost"><?php echo priceFormat($sp->price * $item['quantity']); ?></span>
                </div>
            </td>
            <td><a href="remove.php?id=<?php echo $sp->ID; ?>">Xoá</a></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="3" class="text-right">Tổng:</td>
            <td class="text-center"  id="totalquantity"><?php echo $total_quantity; ?></td>
            <td>
                <div class="price font-weight-bold">
                    <span>₫</span>
                    <span class="cost" id="totalprice"><?php echo priceFormat($sum); ?></span>
                    <div class="d-none"><?php echo $sum; ?></div>
                </div>
            </td>
            <td></td>
        </tr>
    </table>
    <br>
    <button class="btn btnBuy px-5 float-right" id="btnBuy">Mua hàng</button>
    <?php
    } else {
        echo "<h1>Giỏ hàng của bạn không có sản phẩm nào</h1>";
    }
    ?>
</div>
<?php require_once("cart_footer.php"); ?>