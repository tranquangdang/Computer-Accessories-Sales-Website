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
    $sql = "select * from tblProduct where CategoryNo in (" . $cate . ")";
} else {
    $sql = "select * from tblProduct";
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

while (($rows = $getProduct->fetch_assoc()) != null) {?>
<div class="product_box">
    <a href="productdetail.php?ProductID=<?php echo $rows['ProductID']; ?>" style="display: block">
        <h3><?php echo $rows['ProductName']; ?></h3>
        <img src="<?php echo $rows['ProductImg']; ?>" alt="product image" />
        <p class="discount">₫<?php echo number_format($rows['UnitPrice']); ?></p>
        <p class="product_price"><a>₫</a><?php echo number_format($rows['UnitPrice']); ?></p>
    </a>
</div>

<?php }
$total_pages = mysqli_num_rows($database->select($sql));

?>