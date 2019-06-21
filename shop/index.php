<?php require_once("shop_header.php"); ?>
<div class="container">
    <br>
    <br>
    <?php
        $items = Item::findByUser($_SESSION['ID']);
        if (!empty($items)) {
    ?>
    <h1>Danh sách sản phẩm của <?php echo $_SESSION['email']; ?></h1>
    <h2><a href="create.php">Thêm sản phẩm</a></h2>
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">Tên</th>
                <th scope="col">Danh mục</th>
                <th scope="col">Giá</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Mô tả</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xoá</th>
            </tr>
        </thead>
        <?php foreach ($items as $sp) { ?>
        <tr>
            <td><?php echo htmlspecialchars($sp->name); ?></td>
            <td>
                <?php
                    $sp->category = $sp->getCategory();
                    echo htmlspecialchars($sp->category);
                ?>
            </td>
            <td><?php echo htmlspecialchars($sp->price); ?></td>
            <td style="width:200px"><img style="width:100%" src="../img/<?php echo htmlspecialchars($sp->image); ?>"
                    alt="<?php echo htmlspecialchars($sp->name); ?>"></td>
            <td><?php echo htmlspecialchars($sp->description); ?></td>
            <td><?php echo htmlspecialchars($sp->stock); ?></td>
            <td><?php echo htmlspecialchars(dateFormat($sp->create_at)); ?></td>
            <td><a href="edit.php?id=<?php echo $sp->ID; ?>">Sửa</a></td>
            <td><a href="delete.php?id=<?php echo $sp->ID; ?>">Xoá</a></td>
        </tr>
        <?php }
        } else {
            echo "Bạn không có sản phẩm nào";
            echo "<h2><a href='create.php'>Thêm sản phẩm</a></h2>";
        }
        ?>

    </table>
</div>

<?php require_once("shop_footer.php"); ?>