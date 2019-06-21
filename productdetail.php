<?php
require_once("includes/header.php");
$id = $_GET['id'] ?? false;
if (!$id) {
    header("Location:index.php");
}
$sp = Item::findByID($id);
?>
    <div class="product-detail container d-flex mt-3">
        <div class="product-image col-5 p-3">
            <img src="img/<?php echo htmlspecialchars($sp->image); ?>"
             alt="<?php echo htmlspecialchars($sp->name); ?>">
        </div>
        <div class="product-info col-7 p-3">
            <div class="mb-3">
                <h2><?php echo htmlspecialchars($sp->name); ?></h2>           
            </div>
            <div class="price info-price mb-3">
                <span>₫</span>
                <span class="cost"><?php echo priceFormat(htmlspecialchars($sp->price)); ?></span>
            </div>
            <form action="" class="add_to_cart_form">
                <div class="d-none" id="product_id"><?php echo htmlspecialchars($sp->ID); ?></div>
                <label for="cart_quantity">Số lượng: </label>
                <div class="d-flex mb-3">
                <div class="col-md-4">
                <input type="number" name="quantity" id="cart_quantity" value="1" min="1" max="<?php echo $sp->stock; ?>">
                </div>
                <div class="col-md-8">
                    <?php echo htmlspecialchars($sp->stock); ?> sản phẩm có sẵn
                </div>
                </div>
                <button type="submit" class="btn btn-primary" id="btnAddToCart">Thêm vào giỏ hàng</button>
            </form>
            <div class="d-flex mt-5">
                <div class="seller w-50">
                    Người bán: <?php echo htmlspecialchars($sp->getUser()); ?>
                </div>
                <div class="d-none" id="userID"><?php echo $sp->getUserID(); ?></div>
                <div class="xem">
                    <button id="btnXem" class="btn btn-primary">Xem shop</button>
                </div>
            </div>
        </div>
    </div>
<?php require_once("includes/footer.php");
?>
