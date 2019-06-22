<?php require_once("includes/header.php"); ?>
<?php 
if (!isLoggedIn()) {
    $_SESSION['error'] = "Bạn cần đăng nhập để thực hiện chức năng này";
    header ("Location:index.php");
    exit();
} else {
    $id = $_SESSION['ID'];
    $user = Admin::findByID($id);
    $error['oldPass'] = "";
    $error['newPass'] = "";
    $error['cfPass'] = "";
}
if (isset($_POST['change'])) {
    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $cfPass = $_POST['cfPass'];
    if (empty($oldPass)) {
        $error['oldPass'] = "Vui lòng nhập mật khẩu cũ";
    }
    if (empty($newPass)) {
        $error['newPass'] = "Vui lòng nhập mật khẩu mới";
    }
    if (empty($cfPass)) {
        $error['cfPass'] = "Vui lòng nhập lại mật khẩu mới";
    }
    if (!password_verify($oldPass,$user->password)) {
        $error['oldPass'] = "Sai mật khẩu, vui lòng nhập lại";
    } elseif ($newPass != $cfPass) {
        $error['cfPass'] = "Mật khẩu nhập lại phải giống mật khẩu mới!";
    }
    if (empty(array_filter($error))) {
        $user->password = password_hash($newPass,PASSWORD_DEFAULT);
        $result = $user->update();
        if ($result === true) {
            $_SESSION['message'] = "Sửa mật khẩu thành công";
            header("Location:account.php");
        }
    }
}
?>
<div class="bg_grey">
    <div class="container d-flex">
        <div class="sidebar col-xl-3">
            <p class="text-secondary py-5 hello">Xin chào <?php echo $_SESSION['email']; ?></p>
            <div class="my-4"><a href="account.php" style="color:#ee4d2d;" class="user-link my-5">Đổi mật khẩu</a></div>
            <div class="my-4"><a href="user_order.php" class="user-link">Đơn hàng</a></div>
        </div>
        <div class="bg-white col-xl-9 mt-4 mb-5">
            <p class="mt-4 pb-5 hello">Hồ sơ của tôi</p>
                <div class="d-flex">
                    <div class="w-25 px-2 my-3 text-right text-secondary">Email</div>
                    <div class="px-2 my-3"><?php echo htmlspecialchars($user->email); ?></div>
                </div>
                <form action="" method="post">
                    <div class="d-flex">
                        <div class="w-25 px-2 my-2 text-right text-secondary">
                            <label for="oldPass">Nhập mật khẩu cũ</label>
                        </div>
                        <div class="px-2 my-2">
                            <input type="password" name="oldPass" id="oldPass">
                            <span class="error ml-3"><?php echo $error['oldPass']; ?></span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="w-25 px-2 my-2 text-right text-secondary">
                            <label for="newPass">Nhập mật khẩu mới</label>
                        </div>
                        <div class="px-2 my-2">
                            <input type="password" name="newPass" id="newPass">
                            <span class="error ml-3"><?php echo $error['newPass']; ?></span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="w-25 px-2 my-2 text-right text-secondary">
                            <label for="cfPass">Xác nhận mật khẩu</label>
                        </div>
                        <div class="px-2 my-2">
                            <input type="password" name="cfPass" id="cfPass">
                            <span class="error ml-3"><?php echo $error['cfPass']; ?></span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="w-25 px-2 mt-1 mb-5"></div>
                        <div class="px-2 mt-1 mb-5">
                            <button type="submit" name="change" class="btnBuy">Đổi mật khẩu</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>


<?php require_once("includes/footer.php"); ?>