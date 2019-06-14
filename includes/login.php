<?php
session_start();
require_once("connect.php");
$emailErr = "";
$passwordErr = "";
if (isset($_POST['btnSubmit'])) {
    if (empty($_POST['email'])) {
        $emailErr = "Vui lòng nhập email";
    } else {
        if (empty($_POST['password'])) {
            $passwordErr = "Vui lòng nhập mật khẩu";
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $checkEmail = "SELECT * FROM users WHERE email = '$email'";
            $result = $conn->query($checkEmail);
            if ($result->num_rows == 0) {
                $emailErr = "Email này chưa được đăng ký";
            } else {
                while ($row = $result->fetch_assoc()) {
                    if ($row['password'] != $password) {
                        $passwordErr = "Sai mật khẩu, vui lòng nhập lại";
                    } else {
                        $_SESSION['email'] = $email;
                        $getRole = "SELECT user_role.userID, roles.ID, roles.Name FROM roles INNER JOIN user_role ON roles.ID = user_role.roleID 
                        INNER JOIN users ON users.ID = user_role.userID WHERE users.email = '$email'";
                        $queryGetRole = $conn->query($getRole);
                        while ($row = $queryGetRole->fetch_assoc()) {
                            $_SESSION['ID'] = $row["userID"];
                            $_SESSION['roleID'] = $row["ID"];
                            $_SESSION['role'] = $row["Name"];
                        }
                        header("location: ../index.php");
                    }
                }
            }
        }
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
            <span class="error"><?php echo $emailErr; ?></span>
            <br>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <span class="error"><?php echo $passwordErr; ?></span>
            <br>
            <br>
            <input type="submit" class="btnSubmit" name="btnSubmit" value="Đăng nhập">
        </div>
    </form>
</body>

</html>