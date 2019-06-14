<?php
require_once('connect.php');
$emailErr = "";
$passwordErr = "";
if (isset($_POST['btnSubmit'])) {
    $role = 5;  //5 là giá trị role của khách hàng
    if (isset($_POST['chkRole'])) {
        $role = 2;      //2 là giá trị role của chủ shop
    }
    if (empty($_POST['email'])) {
        $emailErr = "Vui lòng nhập email";
    } else {
        if (empty($_POST['password'])) {
            $passwordErr = "Vui lòng nhập mật khẩu";
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $check = "SELECT * FROM users where email = '$email'";
                $count = $conn->query($check);
                if ($count->num_rows > 0) {
                    $emailErr = "Email đã có người sử dụng";
                } else {
                    $insert = "INSERT INTO users(email, password) ";
                    $insert .= "VALUES ('$email', '$password')";
                    $result1 = $conn->query($insert);
                    $last_ID = $conn->insert_id;
                    $insertRole = "INSERT INTO user_role(userID,roleID) VALUES ($last_ID,$role)";
                    $result2 = $conn->query($insertRole);
                    if ($result1 && $result2) {
                        header("location: reg_success.php");
                    }
                }
            } else {
                $emailErr = "Email không hợp lệ";
            }
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
            <input type="text" name="email" id="email">
            <span class="error"><?php echo $emailErr; ?></span>
            <br>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <span class="error"><?php echo $passwordErr; ?></span>
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