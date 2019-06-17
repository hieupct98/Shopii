<?php
if (isset($_POST['add'])) {
    $data = $_POST['item'];
    $data['image'] = $conn->real_escape_string($_FILES['image']['name']);
    $img = $data['image'];
    $temp = $_FILES['image']['tmp_name'];
    $item = new Item($data);
    $result = $item->create();

    if ($result === true) {
        move_uploaded_file($temp, "../img/$img");
        $_SESSION['message'] = "Đã thêm sản phẩm mới với tên là $item->name";
        header("Location:index.php");
    } else {
        $_SESSION['error'] = "Thêm sản phẩm thất bại";
    }
}
require_once("shop_header.php");
?>
<div class="container">
    <br>
    <br>
    <h1>Nhập thông tin sản phẩm muốn thêm:</h1>
    <br>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="item[name]">Tên sản phẩm: </label>
            <input type="text" class="form-control" name="item[name]" id="item[name]">
        </div>

        <div class="form-group">
            <label for="item[catID]">Danh mục: </label>
            <select name="item[catID]" id="item[catID]" class="custom-select">
                <?php
            $getCatID = "SELECT * FROM categories";
            $queryCatID = mysqli_query($conn, $getCatID);
            while ($row = mysqli_fetch_assoc($queryCatID)) {
                $catID = $row['ID'];
                $cat = $row['name'];
                ?>
                <option value="<?php echo $catID ?>"><?php echo $cat ?></option>
                <?php
        }
        ?>
            </select>
        </div>

        <div class="form-group">
            <label for="item[price]">Giá sản phẩm: </label>
            <input type="text" class="form-control" name="item[price]" id="item[price]">
        </div>

        <div class="form-group">
            <label for="image" >Chọn ảnh</label>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>

        <div class="form-group">
            <label for="item[description]">Mô tả: </label>
            <textarea name="item[description]" id="item[description]" class="form-control" cols="30" rows="5"></textarea>
        </div>

        <div class="form-group">
            <label for="item[quantity]">Số lượng: </label>
            <input type="text" class="form-control" name="item[quantity]" id="item[quantity]">
        </div>
        <br><br>
        <input type="submit" class="btn btn-primary" name="add" value="Thêm sản phẩm">
    </form>
</div>

</body>

</html>