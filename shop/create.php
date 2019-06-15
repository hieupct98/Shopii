<?php
require_once("shop_header.php");
if (isset($_POST['add'])) {
    $data = $_POST['item'];
    $data['image'] = $conn->real_escape_string($_FILES['image']['name']);
    $img = $data['image'];
    $temp = $_FILES['image']['tmp_name'];
    $item = new Item($data);
    $result = $item->create();

    if ($result === true) {
        move_uploaded_file($temp, "../img/$img");
        header("Location:index.php");
    }
} ?>
<div class="container">
    <br>
    <br>
    <h1>Nhập thông tin sản phẩm muốn thêm:</h1>
    <br>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="item[name]">Tên sản phẩm: </label>
            <input type="text" class="form-control" name="item[name]">
        </div>

        <div class="form-group">
            <label for="item[catID]">Danh mục: </label>
            <select name="item[catID]" class="custom-select">
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
            <input type="text" class="form-control" name="item[price]">
        </div>

        Ảnh sản phẩm:
        <div class="custom-file">
            <label for="image" class="custom-file-label">Chọn ảnh</label>
            <input type="file" class="custom-file-input" name="image">
        </div>

        <div class="form-group">
            <label for="item[description]">Mô tả: </label>
            <textarea name="item[description]" class="form-control" cols="30" rows="5"></textarea>
        </div>

        <div class="form-group">
            <label for="item[quantity]">Số lượng: </label>
            <input type="text" class="form-control" name="item[quantity]">
        </div>
        <br><br>
        <input type="submit" class="btn btn-primary" name="add" value="Thêm sản phẩm">
    </form>
</div>

</body>

</html>