<?php
session_start();
require_once("connect.php");
$error["email"] = "";
$error["password"] = "";
if (isset($_POST['btnSubmit'])) {
    if (empty($_POST['email'])) {
        $error["email"] = "Vui lòng nhập email";
    }
    if (empty($_POST['password'])) {
        $error["password"] = "Vui lòng nhập mật khẩu";
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    echo $password;
    //kiểm tra email hợp lệ
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $check = $conn->prepare("SELECT * FROM users where `email` = ?");
        $check->bind_param('s', $email);
        $check->execute();
        $result = $check->get_result();
        if ($result->num_rows == 0) {
            $error["email"] = "Email này chưa được đăng ký";
        } else {
            while ($row = $result->fetch_assoc()) {
                if (!password_verify($password,$row['password'])) {
                    $error["password"] = "Sai mật khẩu, vui lòng nhập lại";
                } else {
                    $_SESSION['email'] = $email;
                    $getRole = $conn->prepare("SELECT user_role.userID, roles.ID, roles.name FROM roles INNER JOIN user_role 
                    ON roles.ID = user_rol
                    e.roleID INNER JOIN users ON users.ID = user_role.userID WHERE users.email = ?");
                    $getRole->bind_param('s', $email);
                    $getRole->execute();
                    $queryGetRole = $getRole->get_result();
                    while ($row = $queryGetRole->fetch_assoc()) {
                        $_SESSION['ID'] = $row["userID"];
                        $_SESSION['roleID'] = $row["ID"];
                        $_SESSION['role'] = $row["name"];
                    }
                    header("location: ../index.php");
                }
            }
        }
    } else {
        $error["email"] = "Email không hợp lệ";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
</head>

<body>
    <form method="post" action="login.php" style="margin:1% 0 0 2%">
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
            <input type="submit" class="btnSubmit" name="btnSubmit" value="Đăng nhập">
        </div>
    </form>
</body>

</html>