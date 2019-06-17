<?php 
require_once("shop_header.php");
if (!isset($_GET['id'])) {
    header("Location:index.php");
}
$id = $_GET['id'];
$item = Item::findByID($id);
if (($item == false) || ($_SESSION['email'] != $item->getUser())) {
    header("Location:index.php");
}
if(isset($_POST['delete'])) {
    $result = $item->delete();
    if ($result === true) {
        $_SESSION['message'] = "Đã xoá sản phẩm $item->name";
        header("Location:index.php");
    } else {
        $_SESSION['error'] = "Xoá sản phẩm thất bại";
    }
}
?>
    <p>Bạn có chắc muốn xoá sản phẩm này?</p>
    <form action="" method="post">
        <input type="submit" class="btn btn-primary" name="delete" value="Xoá">
    </form>
    
</body>

</html>