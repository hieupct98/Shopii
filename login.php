<?php
require_once("includes/header.php");
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
                    ON roles.ID = user_role.roleID INNER JOIN users ON users.ID = user_role.userID WHERE users.email = ?");
                    $getRole->bind_param('s', $email);
                    $getRole->execute();
                    $queryGetRole = $getRole->get_result();
                    while ($row = $queryGetRole->fetch_assoc()) {
                        $_SESSION['ID'] = $row["userID"];
                        $_SESSION['roleID'] = $row["ID"];
                        $_SESSION['role'] = $row["name"];
                    }
                    header("location:index.php");
                }
            }
        }
    } else {
        $error["email"] = "Email không hợp lệ";
    }
}
?>
<div class="container">
    <h1>Đăng nhập:</h1>
    <form method="post" action="login.php" style="margin:1% 0 0 2%">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control col-sm-4" name="email" id="email"
                value="<?php if (isset($_POST['email']) && $_POST['email'] != null) echo $_POST['email'] ?>">
            <span class="error"><?php echo $error["email"]; ?></span>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control col-sm-4" name="password" id="password">
            <span class="error"><?php echo $error["password"]; ?></span>
        </div>
        <input type="submit" class="btn btn-primary" name="btnSubmit" value="Đăng nhập">
    </form>
</div>

<?php require_once("includes/footer.php"); ?>