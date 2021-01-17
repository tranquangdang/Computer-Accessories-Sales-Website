
<?php
//Lấy sản phẩm theo thể loại
if (isset($_GET['CategoryNo'])) {
    $cate = $_GET['CategoryNo'];
    $sql2 = "select * from tblProductCategory where CategoryID in (" . $cate . ")";
    $getCateName = $database->select($sql2);
    $st = '';
    if ($getCateName) {
        while ($row = $getCateName->fetch_assoc()) {
        $st .= ' ' . $row['CategoryName'];
        }
    }
    
    echo '<h1>' . $st . '</h1>';
    $sql = "SELECT * FROM tblProduct WHERE QtyOnHand > 0 AND CategoryNo in (" . $cate . ")";

    $targetPage = "products.php?CategoryNo=".urlencode($_GET['CategoryNo']).'&';
//Lấy sản phẩm theo tìm kiếm
} else if (isset($_GET['Keyword'])) {
    $keyword = $_GET['Keyword'];
    $sql = "SELECT * FROM tblProduct WHERE QtyOnHand > 0 AND ProductName LIKE '%$keyword%'";

    $targetPage = "products.php?Keyword=".$_GET['Keyword'].'&';
//Hiển thị bình thường
} else {
    $sql = "SELECT * FROM tblProduct WHERE QtyOnHand > 0";

    $targetPage = "products.php?";
}

//Bình thường thì không sắp xếp
if(!isset($_GET['Sort'])){
    $_GET['Sort'] = 'none';
} else {
    $targetPage = $targetPage.$Page->setVariableSort($_GET['Sort']).'&';
}

$limit = 12; //12 sản phẩm trong 1 trang
if (isset($_GET['page'])) {
    if (is_numeric($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
} else {
    $page = 1;
}

if (is_numeric($page)) {
    $start = ($page - 1) * $limit;
} else {
    $start = 0;
}

$type = $Page->sortSQL($_GET['Sort']);
if($_GET['Sort'] == 'topsell') {
    $sql = str_replace(' * FROM tblProduct WHERE ',' tblProduct.* FROM tblOrderInvoiceDetail, tblProduct WHERE ',$sql);
}
$getProduct = $database->select($sql.$type." LIMIT " . $start . ", " . $limit);
    if($getProduct) {?>
        <div class="sortType">
            <a href="<?php echo $Page->buildQuery('Sort', 'asc') ?>" > Giá thấp </a>
            <a href="<?php echo $Page->buildQuery('Sort', 'desc') ?>" > Giá cao </a>
            <a href="<?php echo $Page->buildQuery('Sort', 'new') ?>" > Mới nhất </a>
            <a href="<?php echo $Page->buildQuery('Sort', 'discount') ?>" > Khuyến mãi </a>
            <a href="<?php echo $Page->buildQuery('Sort', 'topsell') ?>" > Mua nhiều </a>
        </div>
        <?php
        while ($rows = $getProduct->fetch_assoc()) {?>
            <div class="product_box"  style="position: relative;">
                <a href="productdetail.php?ProductID=<?php echo $rows['ProductID']; ?>" style="display: block ">
                    <h3><?php echo $rows['ProductName']; ?></h3>
                    <img src="<?php echo $product->checkImg($rows['ProductImg']); ?>" alt="product image"/>
                    <label style=" <?php if ($rows['PerDiscount'] <= 0) echo 'display: none;'?> ">Giảm <?php echo $rows['PerDiscount'].'%'; ?></label>
                    <p class="discount"><?php if ($rows['PerDiscount'] > 0) echo '₫'.number_format($rows['UnitPrice']); ?></p>
                    <p class="product_price"><span>₫</span><?php echo number_format($product->DiscountPrice($rows['UnitPrice'],$rows['PerDiscount'])); ?></p>
                </a>
            </div>
    <?php   }
    $total_pages = mysqli_num_rows($database->select($sql.$type));
    } else {
        echo '<h1>Không tìm thấy kết quả trên!</h1><br>';
        echo '<a href="javascript:history.back()">Tiếp tục mua sắm</a>';
    }
    if(isset($total_pages)){
        ?>
        <div style="position: absolute; bottom: 0; right: 0; padding: 10px 30px;">
            <?php $Page->Pagination($targetPage, $total_pages, $page); ?>
        </div>
    <?php
    }
?>
