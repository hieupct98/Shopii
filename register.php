<?php
require_once("includes/header.php");
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

    if (empty(array_filter($error))) {
        $conn->autocommit(FALSE);
        $insert = $conn->prepare("INSERT INTO users(email, password) VALUES (?, ?)");
        $insert->bind_param('ss', $email, $password);
        $insert->execute();
        if ($conn->affected_rows <= 0) {
            $conn->rollback();
            $_SESSION['error'] = "Đăng ký thất bại";
        } else {
            $insertRole = $conn->prepare("INSERT INTO user_role(userID,roleID) VALUES (LAST_INSERT_ID(), ?)");
            $insertRole->bind_param('i',$role);
            $insertRole->execute();
            if ($conn->affected_rows <= 0) {
                $conn->rollback();
                $_SESSION['error'] = "Đăng ký thất bại";
                header("Location:index.php");
            } else {
                $conn->commit();
                $_SESSION['message']="Bạn đã đăng ký thành công";
                header("Location:index.php");
            }
        }
    }
}
?>
<div class="container">
    <h1>Đăng ký:</h1>
    <form method="post" action="register.php" style="margin:1% 0 0 2%">
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
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="chkRole" id="chkRole">
            <label for="chkRole">Đăng ký với tư cách chủ shop</label>
        </div>
        <input type="submit" class="btn btn-primary" name="btnSubmit" value="Đăng ký">
    </form>
</div>

<?php require_once("includes/footer.php"); ?>