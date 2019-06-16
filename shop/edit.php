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

if (isset($_POST['edit'])) {
    //truyền dữ liệu vào biến tạm
    $data = $_POST['item'];
    $data['userID'] = $_SESSION['ID'];
    $data['image'] = $conn->real_escape_string($_FILES['image']['name']);
    if (empty($data['image'])) {
        $data['image'] = $item->image;
    }
    $img = $data['image'];
    $temp = $_FILES['image']['tmp_name'];
    //truyền dữ liệu vào obj
    $item->merge_attributes($data);
    //đẩy dữ liệu lên database
    $result = $item->update();

    if ($result === true) {
        $_SESSION['message'] = "Sửa thành công sản phẩm $item->name";
        if (!file_exists("../img/{$img}")) {
            move_uploaded_file($temp, "../img/$img");
        }
        header("Location:index.php");
    }
} ?>
<div class="container">
    <br>
    <br>
    <h1>Sửa thông tin sản phẩm:</h1>
    <br>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="item[name]">Tên sản phẩm: </label>
            <input type="text" class="form-control" name="item[name]" id="item[name]" value="<?php echo htmlspecialchars($item->name) ?>">
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
                    <option value="<?php echo $catID ?>"
                    <?php if ($item->catID == $catID) {
                        echo 'selected';
                            } ?>>
                    <?php echo $cat ?>
                    </option>
                <?php
            }
            ?>
            </select>
        </div>

        <div class="form-group">
            <label for="item[price]">Giá sản phẩm: </label>
            <input type="text" class="form-control" name="item[price]" id="item[price]" value="<?php echo htmlspecialchars($item->price) ?>">
        </div>

        <div class="custom-file">
            <label for="image">Chọn ảnh</label>
            <input type="file" class="form-control-file" name="image" id="image" value="<?php echo htmlspecialchars($item->image) ?>">
        </div>

        <div class="form-group">
            <label for="item[description]">Mô tả: </label>
            <textarea name="item[description]" id="item[description]" class="form-control" cols="30" rows="5"><?php echo htmlspecialchars($item->description) ?></textarea>
        </div>

        <div class="form-group">
            <label for="item[quantity]">Số lượng: </label>
            <input type="text" name="item[quantity]" id="item[quantity]" class="form-control" value="<?php echo htmlspecialchars($item->quantity) ?>">
        </div>
        <br><br>
        <input type="submit" class="btn btn-primary" name="edit" value="Lưu">
    </form>
</div>



</body>

</html>