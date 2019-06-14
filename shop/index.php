<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopiii - kênh người bán</title>
</head>

<body>
    <?php
    require_once("../includes/autoload.php");
    session_start();
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $role = $_SESSION['role'];
        $roleID = $_SESSION['roleID'];
        if ($roleID == '2') { ?>
    <a href="../index.php">Về trang chủ</a>
    <?php
        } else {
        header("Location:../index.php");
    }
    echo "Xin chào $role $email <br>";
    } else {
        header("Location:../index.php");
    }
    ?>
    <?php if (!isset($_SESSION['email'])) { ?>
    <a href="../includes/login.php">Đăng nhập</a>
    <?php } ?>
    <?php if (!isset($_SESSION['email'])) { ?>
    <a href="../includes/register.php">Đăng ký</a>
    <?php } ?>
    <?php if (isset($_SESSION['email'])) { ?>
    <a href="../includes/logout.php">Đăng xuất</a>
    <?php } ?>
    <br>
    <br>
    <?php
        $items = Item::findByUser($_SESSION['ID']);
        if (!empty($items)) {
    ?>
    <h1>Danh sách sản phẩm của <?php echo $email ?></h1>
    <h2><a href="create.php">Thêm sản phẩm</a></h2>
    <table>
        <tr>
            <th>Tên</th>
            <th>Danh mục</th>
            <th>Người bán</th>
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
            <td>
                <?php
                    $sp->user = $sp->getUser();
                    echo htmlspecialchars($sp->user);
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

</body>

</html>