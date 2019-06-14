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
        if (!isset($_GET['id'])) {
            header("Location:index.php");
        }
        $id = $_GET['id'];
        $item = Item::findByID($id);
        if ($item == false) {
            header("Location:index.php");
        }
        if(isset($_POST['delete'])) {
            $result = $item->delete();
            header("Location:index.php");
        }
    ?>
    <p>Bạn có chắc muốn xoá sản phẩm này?</p>
    <form action="" method="post">
        <input type="submit" name="delete" value="Xoá">
    </form>
    
</body>

</html>