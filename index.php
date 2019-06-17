<?php require_once("includes/header.php"); ?>
<div class="website">
    <div class="container">
        <!-- flexslider -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="1800">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="img/slide1.jpg"
                        alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="img/slide2.jpg"
                        alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="img/slide3.jpg"
                        alt="Third slide">
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
        </div>
        <!-- end flexslider -->
        <!-- begin list item -->
        <div class="boss">
            <div class="wrapper-title-boss">
                San pham moi
            </div>
            
            <div class="wrapper-category product-new slider slider-nav">
                <!-- pd1 -->
                <div class="product">
                    <a href="detail.php?id=1">
                        <div class="img-product">
                            <img src="img/iphone-7-plus.jpg" alt="iphone-7-plus.jpg">
                        </div>
                        <div class="infor">
                            <div class="title-product">
                                iPhone-7-plus
                            </div>
                            <div class="detail">
                                <div class="price">
                                    <span>₫</span>
                                    <span class="cost">100.000</span>
                                </div>
                                <div class="buy">
                                    18769 da ban
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- pd2 -->
                <div class="product">
                    <a href="detail.php?id=1">
                        <div class="img-product">
                            <img src="img/oppo-a5s.jpg" alt="oppo-a5s.jpg">
                        </div>
                        <div class="infor">
                            <div class="title-product">
                                iPhone-7-plus
                            </div>
                            <div class="detail">
                                <div class="price">
                                    <span>₫</span>
                                    <span class="cost">100.000</span>
                                </div>
                                <div class="buy">
                                    18769 da ban
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- pd3 -->
                <div class="product">
                    <a href="detail.php?id=1">
                        <div class="img-product">
                            <img src="img/iphone-7-plus.jpg" alt="iphone-7-plus.jpg">
                        </div>
                        <div class="infor">
                            <div class="title-product">
                                iPhone-7-plus
                            </div>
                            <div class="detail">
                                <div class="price">
                                    <span>₫</span>
                                    <span class="cost">100.000</span>
                                </div>
                                <div class="buy">
                                    18769 da ban
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- pd4 -->
                <div class="product">
                    <a href="detail.php?id=1">
                        <div class="img-product">
                            <img src="img/samsung-galaxy-note8.jpg" alt="samsung-galaxy-note8.jpg">
                        </div>
                        <div class="infor">
                            <div class="title-product">
                                iPhone-7-plus
                            </div>
                            <div class="detail">
                                <div class="price">
                                    <span>₫</span>
                                    <span class="cost">100.000</span>
                                </div>
                                <div class="buy">
                                    18769 da ban
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- pd5 -->
                <div class="product">
                    <a href="detail.php?id=1">
                        <div class="img-product">
                            <img src="img/samsung-galaxy-s10-plus.jpg" alt="iphone-7-plus.jpg">
                        </div>
                        <div class="infor">
                            <div class="title-product">
                                iPhone-7-plus
                            </div>
                            <div class="detail">
                                <div class="price">
                                    <span>₫</span>
                                    <span class="cost">100.000</span>
                                </div>
                                <div class="buy">
                                    18769 da ban
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- end list item -->
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

<?php require_once("includes/footer.php"); ?>

