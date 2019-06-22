<?php require_once("includes/header.php"); ?>
<?php
$sql = "SELECT * FROM products INNER JOIN user_product ON products.ID = user_product.productID";
if (isset($_GET['catID'])) {
    $catID = $_GET['catID'];
    $sql .= " WHERE catID = $catID";
}
if (isset($_GET['search'])) {
    $search = urldecode($_GET['search']);
    $sql .= " WHERE name LIKE '%{$search}%' or description like '%{$search}%'";
}
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    switch ($sort) {
        case 'time':
            $orderBy = " ORDER BY create_at DESC";
            break;
        case 'priceasc':
            $orderBy = " ORDER BY price ASC";
            break;
        case 'pricedesc':
            $orderBy = " ORDER BY price DESC";
            break;
        default:
            $orderBy = " ORDER BY create_at DESC";
            break;
    }
    $sql .= $orderBy;
}
$current_page = $_GET['page'] ?? 1;
$per_page = 12;
$count_sql = str_replace("SELECT *","SELECT COUNT(*)",$sql);
$count = $conn->query($count_sql);
$result = $count->fetch_array();
$total_count = array_shift($result);
$pagination = new Pagination($current_page,$per_page,$total_count);
$sql .= " LIMIT {$per_page}";
$sql .= " OFFSET {$pagination->offset()}";
$category = Category::findAll();
?>
<div class="bg_grey">
    <div class="d-flex" style="margin:0 5px;">
        <!-- sidebar show categories -->
        <div class="sidebar-category w-25 mr-3 my-4">
            <div class="CatList">
                <div class="cat-list-title">
                    <a href="products.php" class="CatListHeader">Tất cả sản phẩm</a>
                </div>
                <div class="CatListBody">
                    <?php
                    foreach ($category as $cat) {
                        echo "<a href='products.php?catID={$cat->id}' class='cat-list user-link'";
                        if (isset($_GET['catID'])) {
                            if ($catID == $cat->id) echo " style='color:#ee4d2d; font-weight: 700;'";
                        }
                        echo ">$cat->Name</a>";
                        echo "<br>";    
                    } 
                    ?>
                </div>
            </div>
        </div>
        <!-- end sidebar -->
        <div class="showProduct w-75">
            <?php if (isset($_GET['search'])) { ?>
            <div class="SearchResult mt-4">
                <h2>Kết quả tìm kiếm cho: <?php echo $search; ?></h2>
            </div>
            <?php } ?>
            <!-- vùng hiển thị lựa chọn sắp xếp -->
            <div class="SortSection spacebetween my-4">
                <div>Sắp xếp theo:</div>
                <div>
                    <select id="ddlSort">
                        <option value="products.php?<?php echo queryString("sort","time"); ?>"
                            <?php if (isset($_GET['sort']) && $_GET['sort'] == "time") echo 'selected="selected"'; ?>>
                            Mới nhất</option>
                        <option value="products.php?<?php echo queryString("sort","priceasc"); ?>"
                            <?php if (isset($_GET['sort']) && $_GET['sort'] == "priceasc") echo 'selected="selected"'; ?>>
                            Giá tăng dần</option>
                        <option value="products.php?<?php echo queryString("sort","pricedesc"); ?>"
                            <?php if (isset($_GET['sort']) && $_GET['sort'] == "pricedesc") echo 'selected="selected"'; ?>>
                            Giá giảm dần</option>
                    </select>
                </div>
            </div>
            <!-- hiển thị các sản phẩm -->
            <div class="ProductList">
            <?php
                $items = Item::findByQuery($sql);
                foreach ($items as $sp) { ?>
                <div class="product bg-white m-2" style="width:22%;">
                    <a href="productdetail.php?id=<?php echo $sp->ID; ?>">
                        <div class="img-product">
                            <img src="img/<?php echo htmlspecialchars($sp->image); ?>"
                                alt="<?php echo htmlspecialchars($sp->name); ?>">
                        </div>
                        <div class="infor">
                            <div class="title-product">
                                <?php echo htmlspecialchars($sp->name); ?>
                            </div>
                            <div class="detail">
                                <div class="price">
                                    <span>₫</span>
                                    <span class="cost"><?php echo priceFormat(htmlspecialchars($sp->price)); ?></span>
                                </div>
                                <div class="buy">
                                    <?php echo htmlspecialchars($sp->stock) . " còn lại"; ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php } ?>    
            </div>
            <div>
                <ul class="pagination">
                    <li class="page-item <?php if($pagination->previous_page()===false) echo 'disabled'; ?>">
                        <a class="page-link"
                            href="products.php?<?php echo queryString("page",$pagination->previous_page()); ?>">Previous</a>
                    </li>
                    <?php for ($i=1;$i<=$pagination->total_pages();$i++) { ?>
                    <li class="page-item <?php if ($current_page == $i) { echo 'active';} ?>">
                        <a class="page-link" href="products.php?<?php echo queryString("page",$i); ?>"><?php echo $i; ?>
                            <?php 
                            if ($current_page == $i) {
                            echo "<span class='sr-only'>(current)</span>";
                            }
                            ?>
                        </a>
                    </li>
                    <?php } ?>
                    <li class="page-item <?php if($pagination->next_page()===false) echo 'disabled'; ?>">
                    <a class="page-link"
                        href="products.php?<?php echo queryString("page",$pagination->next_page()); ?>">Next</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>