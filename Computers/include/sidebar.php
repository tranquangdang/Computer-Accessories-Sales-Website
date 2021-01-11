<div id="sidebar" class="float_l">
    <div class="sidebar_box"><span class="bottom"></span>
        <h3>Sản phẩm chính</h3>   
        <div id="sidebar" class="content ddsmoothmenuvertical"> 
            <ul class="sidebar_list">
                <li><a href="products.php?CategoryNo='CPU01','CPU02'">CPU - Bộ vi xử lý</a>
                    <ul>
                        <li><a href="products.php?CategoryNo='CPU02'">CPU Intel</a></li>
                        <li><a href="products.php?CategoryNo='CPU01'">CPU AMD</a></li>
                    </ul>
                </li>
                <li><a href="products.php?CategoryNo='VGA01','VGA02'">VGA - Card màn hình</a>
                    <ul>
                        <li><a href="products.php?CategoryNo='VGA01'">VGA Nividia</a></li>
                        <li><a href="products.php?CategoryNo='VGA02'">VGA AMD</a></li>
                    </ul>
                </li>
                <li><a href="products.php?CategoryNo='MAIN1','MAIN2'">Mainboard - Bo mạch chủ</a>
                    <ul>
                        <li><a href="products.php?CategoryNo='MAIN1'">Mainboard Intel</a></li>
                        <li><a href="products.php?CategoryNo='MAIN2'">Mainboard AMD</a></li>
                    </ul>
                </li>
                <li><a href="products.php?CategoryNo='RAM01'">Ram - Bộ nhớ trong</a></li>
                <li><a href="products.php?CategoryNo='HDD01','SSD01'">Ổ cứng</a>
                    <ul>
                        <li><a href="products.php?CategoryNo='HDD01'">Ổ cứng HDD</a></li>
                        <li><a href="products.php?CategoryNo='SSD01'">Ổ cứng SSD</a></li>
                    </ul>
                </li>
                <li><a href="products.php?CategoryNo='PSU01'">PSU - Nguồn máy tính</a></li>
                <li><a href="products.php?CategoryNo='COOL1'">Tản nhiệt</a></li>
                <li><a href="products.php?CategoryNo='CASE1'">Case - Thùng máy tính</a></li>
                <li><a href="products.php">Khác</a>
                    <ul>
                        <li><a href="#submenu1">Phụ kiện laptop</a>
                            <ul>
                                <li><a href="#submenu1">Pin - cáp sạc</a></li>
                                <li><a href="#submenu2">Linh kiện laptop</a></li>
                            </ul>
                        </li>
                        <li><a href="#submenu1">Phần mềm</a>
                            <ul>
                                <li><a href="#submenu1">Windows</a></li>
                                <li><a href="#submenu2">Anti Virus</a></li>
                                <li><a href="#submenu2">Khác</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar_box"><span class="bottom"></span>
        <h3>Bán chạy nhất </h3>   
        <div class="content"> 
            <?php
            $count = 0;
            $getProduct = $product->getAllProduct();
            while( ($rows = $getProduct->fetch_assoc()) != NULL && $count < 5 ) { $count++;
                if ($rows['QtyOnHand'] > 0) {?>
                <div class="bs_box">
                    <a href="productdetail.php?ProductID=<?php echo $rows['ProductID']; ?>">
                        <img src="<?php echo $product->checkImg($rows['ProductImg']); ?>" alt="image" />
                        <h5><?php echo $rows['ProductName']; ?></h5>
                        <p class="price">₫<?php echo number_format($cart->DiscountPrice($rows['UnitPrice'],$rows['PerDiscount'])); ?></p>
                    </a>
                </div>
                <div class="cleaner"></div>
            <?php }
            } ?>
        </div>
    </div>
</div>