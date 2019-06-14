<?php
require_once('connect.php');
$error["email"]= "";
$error["password"]= "";
if (isset($_POST['btnSubmit'])) {
    if (isset($_POST['chkRole'])) {
        $role = 2;      //2 là giá trị role của chủ shop
    } else {
        $role = 3;  //5 là giá trị role của khách hàng
    }
    if (empty($_POST['email'])) {
        $error["email"] = "Vui lòng nhập email";
    }
    if (empty($_POST['password'])) {
        $error["password"] = "Vui lòng nhập mật khẩu";
    }

    $email = $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    //kiểm tra email hợp lệ
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $check = $conn->prepare("SELECT * FROM users where `email` = ?");
        $check->bind_param('s', $email);
        $check->execute();
        $count = $check->get_result();
        if ($count->num_rows == 1) {
            $error["email"] = "Email đã có người sử dụng";
        }
    } else {
        $error["email"] = "Email không hợp lệ";
    }

    if (empty($error["email"]) && empty($error["password"])) {
        try {
            $conn->autocommit(FALSE);
            $insert = $conn->prepare("INSERT INTO users(email, password) VALUES (?, ?)");
            $insert->bind_param('ss', $email, $password);
            $insert->execute();
            $insertRole = $conn->prepare("INSERT INTO user_role(userID,roleID) VALUES (LAST_INSERT_ID(), ?)");
            $insertRole->bind_param('i',$role);
            $insertRole->execute();
            $conn->autocommit(TRUE);
            header("Location:reg_success.php");
        } catch (Exception $e) {
            $conn->rollback();
            throw $e;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng ký</title>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
</head>

<body>
    <form method="post" action="register.php" style="margin:1% 0 0 2%">
        <div class="forminput">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php if (isset($_POST['email']) && $_POST['email'] != null) echo $_POST['email'] ?>">
            <span class="error"><?php echo $error["email"]; ?></span>
            <br>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <span class="error"><?php echo $error["password"]; ?></span>
            <br>
            <br>
            <input type="checkbox" name="chkRole" id="chkRole">
            <label for="chkRole">Đăng ký với tư cách chủ shop</label>
            <br>
            <br>
            <input type="submit" class="btnSubmit" name="btnSubmit" value="Đăng ký">
        </div>
    </form>
</body>

</html>