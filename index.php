<?php require_once("includes/header.php"); ?>
<div class="website bg_grey pt-3">
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
                    <img class="d-block w-100" src="img/slide1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="img/slide2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="img/slide3.jpg" alt="Third slide">
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
        <br>
        <!-- list item new product-->
        <div class="boss my-3">
            <div class="spacebetween wrapper-title" style="align-items:baseline;">
                <div class="wrapper-title-boss">Sản phẩm mới</div>
                <div class="mr-3"><a href="products.php">Xem tất cả</a></div>
            </div>
            <div class="wrapper-category product-new slider slider-nav">
                <?php
                $items = Item::topNewProducts(6);
                foreach ($items as $sp) { ?>
                <div class="product">
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
        </div>
        <!-- end list item sp mới -->
        <!-- list item Category -->
        <?php
        $category = Category::findAll();
        foreach ($category as $cat) { ?>
        <div class="boss my-3">
            <div class="spacebetween wrapper-title" style="align-items:baseline;">
                <div class="wrapper-title-boss">
                    <?php echo htmlspecialchars($cat->Name); ?>
                </div>
                <div class="mr-3"><a href="products.php?catID=<?php echo htmlspecialchars($cat->id); ?>">Xem tất cả</a></div>
            </div>

            <div class="wrapper-category product-new slider slider-nav">
                <!-- pd1 -->
                <?php
                $items = Item::findByCategory($cat->Name);
                foreach ($items as $sp) { ?>
                <div class="product">
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
            <br>
        </div>
        <?php } ?>
        <!-- end list item -->
    </div>
</div>

<?php require_once("includes/footer.php"); ?>