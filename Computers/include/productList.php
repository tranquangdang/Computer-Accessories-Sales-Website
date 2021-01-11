<?php
if (isset($_GET['CategoryNo'])) {
    $cate = $_GET['CategoryNo'];
    $sql2 = "select * from tblProductCategory where CategoryID in (" . $cate . ")";
    $getCateName = $database->select($sql2);
    $st = '';
    while (($row = $getCateName->fetch_assoc()) != null) {
        $st .= ' ' . $row['CategoryName'];
    }
    echo '<h1>' . $st . '</h1>';
    $sql = "SELECT * FROM tblProduct WHERE CategoryNo in (" . $cate . ")";

    $targetPage = "products.php?CategoryNo=".urlencode($_GET['CategoryNo'])."&";
} else if (isset($_GET['Keyword'])) {
    $keyword = $_GET['Keyword'];
    $sql = "SELECT * FROM tblProduct WHERE ProductName LIKE '%$keyword%'";

    $targetPage = "products.php?Keyword=".$_GET['Keyword']."&";
} else {
    $sql = "select * from tblProduct";

    $targetPage = "products.php?";
}

$limit = 12;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
if ($page) {
    $start = ($page - 1) * $limit;
} else {
    $start = 0;
}

$getProduct = $database->select($sql." LIMIT " . $start . ", " . $limit);
    if($getProduct) {
        if (isset($_GET['Keyword'])) {
            $keyword = $_GET['Keyword'];
            echo "<h3> Kết quả cho từ khóa '$keyword'</h3>";
        }
        while ($rows = $getProduct->fetch_assoc()) {
            if ($rows['QtyOnHand'] > 0) {?>
            <div class="product_box"  style="position: relative;">
                <a href="productdetail.php?ProductID=<?php echo $rows['ProductID']; ?>" style="display: block ">
                    <h3><?php echo $rows['ProductName']; ?></h3>
                    <img src="<?php echo $product->checkImg($rows['ProductImg']); ?>" alt="product image"/>
                    <label style=" <?php if ($rows['PerDiscount'] <= 0) echo 'display: none;'?> ">Giảm <?php echo $rows['PerDiscount'].'%'; ?></label>
                    <p class="discount"><?php if ($rows['PerDiscount'] > 0) echo '₫'.number_format($rows['UnitPrice']); ?></p>
                    <p class="product_price"><span>₫</span><?php echo number_format($cart->DiscountPrice($rows['UnitPrice'],$rows['PerDiscount'])); ?></p>
                </a>
            </div>
    <?php   }
        }
    $total_pages = mysqli_num_rows($database->select($sql));
    } else {
        echo '<h1>Không tìm thấy kết quả trên!</h1>';
    }
    if(isset($total_pages)){
        ?>
        <div style="position: absolute; bottom: 0; right: 0; padding: 10px 30px;">
            <?php $pagination->Pagination('tblProduct', $targetPage, $total_pages, $page); ?>
        </div>
    <?php
    }
?>