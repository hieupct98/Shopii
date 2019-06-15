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
    <table>
        <tr>
            <th>Tên</th>
            <th>Danh mục</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Mô tả</th>
            <th>Số lượng</th>
            <th>Sửa</th>
            <th>Xoá</th>
        </tr>

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
            <td><?php echo htmlspecialchars($sp->quantity); ?></td>
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


</body>

</html>