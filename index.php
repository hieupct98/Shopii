<?php require_once("includes/header.php"); ?>
<div class="website">
    <div class="container">
        <!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="..." class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="..." class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="..." class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div> -->
        <table>
            <tr>
                <th>Tên</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Ảnh</th>
                <th>Mô tả</th>
                <th>Số lượng</th>
                <th>Xem</th>
            </tr>

            <?php
        $items = Item::findAll();
        ?>

            <?php foreach ($items as $sp) { ?>
            <tr>
                <td><?php echo htmlspecialchars($sp->name); ?></td>
                <td>
                    <?php
                    $sp->category = $sp->getCategory();
                    echo htmlspecialchars($sp->category);
                    ?>
                </td>
                <td><?php echo htmlspecialchars($sp->price); ?></td>
                <td style="width:200px"><img style="width:100%" src="img/<?php echo htmlspecialchars($sp->image); ?>"
                        alt="<?php echo htmlspecialchars($sp->name); ?>"></td>
                <td><?php echo htmlspecialchars($sp->description); ?></td>
                <td><?php echo htmlspecialchars($sp->quantity); ?></td>
                <td><a href="detail.php?id=<?php echo $sp->ID; ?>">View</a></td>
            </tr>
            <?php } ?>

        </table>
    </div>
</div>


</body>

</html>