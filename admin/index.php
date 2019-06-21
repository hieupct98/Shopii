<?php require_once("admin_header.php") ?>
<div class="container">
    <br>
    <br>
    <h1>Danh sách các người dùng trên Shopii:</h1>
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col">Email</th>
            <th scope="col">Quyền hạn</th>
            <th scope="col">Số sản phẩm</th>
            <th scope="col">Danh sách sản phẩm</th>
            <th scope="col">Xoá</th>
        </tr>
        </thead>
        <?php 
        $users = Admin::findAll();
        foreach ($users as $user) { ?>
        <tr>
            <td><?php echo htmlspecialchars($user->email); ?></td>
            <td><?php echo htmlspecialchars($user->getRole()); ?></td>
            <td><?php echo htmlspecialchars($user->productsCount()); ?></td>
            <td><a href="../user_product.php?uid=<?php echo $user->ID; ?>">Xem danh sách</a></td>
            <td><a href="delete.php?id=<?php echo $user->ID; ?>">Xoá</a></td>
        </tr>
        <?php } ?>
    </table>
</div>
<?php require_once("admin_footer.php"); ?>