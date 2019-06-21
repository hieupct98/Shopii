<?php require_once("includes/header.php"); ?>
<div class="container">
    <br>
    <br>
    <?php
        if (!isset($_GET['uid'])) {
            header("Location:index.php");
        } else {
            $uid = $_GET['uid'];
        }
        $items = Item::findByUser($uid);
        $user = Admin::findByID($uid);
        if (!empty($items)) {
    ?>
    <h1>Danh sách sản phẩm của <?php echo htmlspecialchars($user->email); ?></h1>
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">Tên</th>
                <th scope="col">Danh mục</th>
                <th scope="col">Giá</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Mô tả</th>
                <th scope="col">Số lượng</th>
                <?php if (isAdmin()) { ?>
                    <th scope="col">Xoá</th>
                <?php } ?>
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
            <td style="width:200px"><img style="width:100%" src="img/<?php echo htmlspecialchars($sp->image); ?>"
                    alt="<?php echo htmlspecialchars($sp->name); ?>"></td>
            <td><?php echo htmlspecialchars($sp->description); ?></td>
            <td><?php echo htmlspecialchars($sp->stock); ?></td>
            <?php if (isAdmin()) { ?>
                <td><a href="shop/delete.php?id=<?php echo $sp->ID; ?>">Xoá</a></td>
            <?php } ?>
        </tr>
        <?php }
        } else {
            echo "<h1>$user->email không có sản phẩm nào.</h1>";
        }
        ?>

    </table>
</div>


<?php require_once("includes/footer.php"); ?>