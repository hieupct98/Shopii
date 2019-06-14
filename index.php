<?php
require_once("includes/autoload.php");
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $role = $_SESSION['role'];
    $roleID = $_SESSION['roleID'];
    echo "Xin chào $role $email <br>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopiii</title>
</head>

<body>
    <?php if (isset($_SESSION['email']) && $roleID == '1') { ?>
        <a href="shop/index.php">Quản lý</a>
    <?php } ?>
    <?php if (isset($_SESSION['email']) && $roleID == '2') { ?>
        <a href="shop/index.php">Kênh người bán</a>
    <?php } ?>
    <?php if (!isset($_SESSION['email'])) { ?>
        <a href="includes/login.php">Đăng nhập</a>
    <?php } ?>
    <?php if (!isset($_SESSION['email'])) { ?>
        <a href="includes/register.php">Đăng ký</a>
    <?php } ?>
    <?php if (isset($_SESSION['email'])) { ?>
        <a href="includes/logout.php">Đăng xuất</a>
    <?php } ?>
    <br>
    <br>
    <table>
        <tr>
            <th>Tên</th>
            <th>Danh mục</th>
            <th>Người bán</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Mô tả</th>
            <th>Số lượng</th>
            <th>Xem</th>
        </tr>

        <?php
        $items = Item::findAll();
        ?>

        <?php foreach ($items as $sp) { ?>
            <tr>
                <td><?php echo htmlspecialchars($sp->name); ?></td>
                <td>
                    <?php
                    $sp->category = $sp->getCategory();
                    echo htmlspecialchars($sp->category);
                    ?>
                </td>
                <td><?php
                    $sp->user = $sp->getUser();
                    echo htmlspecialchars($sp->user);
                    ?>
                </td>
                <td><?php echo htmlspecialchars($sp->price); ?></td>
                <td style="width:200px"><img style="width:100%" src="img/<?php echo htmlspecialchars($sp->image); ?>" alt="<?php echo htmlspecialchars($sp->name); ?>"></td>
                <td><?php echo htmlspecialchars($sp->description); ?></td>
                <td><?php echo htmlspecialchars($sp->quantity); ?></td>
                <td><a href="detail.php?id=<?php echo $sp->ID; ?>">View</a></td>
            </tr>
        <?php } ?>

    </table>

</body>

</html>