<?php 
require_once("admin_header.php");
if (!isset($_GET['id'])) {
    header("Location:index.php");
}
$id = $_GET['id'];
$user = Admin::findByID($id);
if ($user == false) {
    header("Location:index.php");
}
if(isset($_POST['delete'])) {
    $result = $user->delete();
    if ($result === true) {
        $_SESSION['message'] = "Đã xoá người dùng $user->email";
        header("Location:index.php");
    } else {
        $_SESSION['error'] = "Xoá người dùng thất bại";
        header("Location:index.php");
    }
}
?>
<div class="container">
    <p>Bạn có chắc muốn xoá người dùng <?php echo $user->email; ?>?</p>
    <form action="" method="post">
        <input type="submit" class="btn btn-primary" name="delete" value="Xoá">
    </form>
</div>

<?php require_once("admin_footer.php"); ?>