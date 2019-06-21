<?php 
require_once("shop_header.php");
if (!isset($_GET['id'])) {
    header("Location:index.php");
}
$id = $_GET['id'];
$item = Item::findByID($id);
if ($item == false) {
    header("Location:index.php");
} else {
    if ($_SESSION['email'] != $item->getUser() && !isAdmin()) {
        header("Location:index.php");
    }
}
if(isset($_POST['delete'])) {
    $result = $item->delete();
    if ($result == true) {
        $_SESSION['message'] = "Đã xoá sản phẩm $item->name";
        if (isAdmin()) {
            header("Location:../user_product.php");
        } else {
            header("Location:index.php");
        }
    } else {
        $_SESSION['error'] = "Xoá sản phẩm thất bại";
        if (isAdmin()) {
            header("Location:../user_product.php");
        } else {
            header("Location:index.php");
        }
    }
}
?>
<div class="container">
    <p>Bạn có chắc muốn xoá sản phẩm <?php echo $item->name; ?></p>
    <form action="" method="post">
        <input type="submit" class="btn btn-primary" name="delete" value="Xoá">
    </form>
</div>

<?php require_once("shop_footer.php"); ?>