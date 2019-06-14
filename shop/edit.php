<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
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
    <br>
    <?php
        } else {
        header("Location:../index.php");
    }
    echo "Xin chào $role $email <br>";
    } else {
        header("Location:../index.php");
    }
    if (!isset($_SESSION['email'])) { ?>
    <a href="../includes/login.php">Đăng nhập</a>
    <?php } ?>
    <?php if (!isset($_SESSION['email'])) { ?>
    <a href="../includes/register.php">Đăng ký</a>
    <?php } ?>
    <?php if (isset($_SESSION['email'])) { ?>
    <a href="../includes/logout.php">Đăng xuất</a>
    <?php } ?>


    <?php
    if (!isset($_GET['id'])) {
        header("Location:index.php");
    }
    $id = $_GET['id'];
    $item = Item::findByID($id);
    if (($item == false) || ($_SESSION['ID'] != $item->userID)) {
        header("Location:index.php");
    }

    if (isset($_POST['edit'])) {
        //truyền dữ liệu vào biến tạm
        $data = $_POST['item'];
        $data['userID'] = $_SESSION['ID'];
        $data['image'] = $conn->real_escape_string($_FILES['image']['name']);
        if (empty($data['image'])) {
            $data['image'] = $item->image;
        }
        $img = $data['image'];
        $temp = $_FILES['image']['tmp_name'];
        //truyền dữ liệu vào obj
        $item->merge_attributes($data);
        //đẩy dữ liệu lên database
        $result = $item->update();

        if ($result === true) {
            if (!file_exists("../img/{$img}")) {
                move_uploaded_file($temp,"../img/$img");
            }        
            header("Location:index.php");
        }
        
    } ?>
    <br>
    <br>
    <h1>Sửa thông tin sản phẩm:</h1>
    <br>
    <form action="" method="post" enctype="multipart/form-data">
        
        <div class="input-text">
            <label for="item[name]">Tên sản phẩm: </label>
            <input type="text" name="item[name]" value="<?php echo htmlspecialchars($item->name) ?>">
        </div>
        
        <div class="input-select">
            <label for="item[catID]">Danh mục: </label>
            <select name="item[catID]">
                <?php 
                $getCatID = "SELECT * FROM categories";
                $queryCatID = mysqli_query($conn,$getCatID);
                while ($row = mysqli_fetch_assoc($queryCatID)) {
                    $catID = $row['ID'];
                    $cat = $row['name'];
                    ?>
                    <option value="<?php echo $catID ?>"<?php if($item->catID == $catID) {echo 'selected';} ?>>
                    <?php echo $cat ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>
            
        <div class="input-text">
            <label for="item[price]">Giá sản phẩm: </label>
            <input type="text" name="item[price]" value="<?php echo htmlspecialchars($item->price) ?>">
        </div>

        <div class="input-file">
            <label for="image">Chọn ảnh: </label>
            <input type="file" name="image" value="<?php echo htmlspecialchars($item->image) ?>">
        </div>

        <div class="input-text">
            <label for="item[description]">Mô tả: </label>
            <textarea name="item[description]" cols="30" rows="5"><?php echo htmlspecialchars($item->description) ?></textarea>
        </div>

        <div class="input-text">
            <label for="item[quantity]">Số lượng: </label>
            <input type="text" name="item[quantity]" value="<?php echo htmlspecialchars($item->quantity) ?>">
        </div>
        <br><br>
        <input type="submit" class="btnSubmit" name="edit" value="Lưu">
    </form>
    

</body>

</html>