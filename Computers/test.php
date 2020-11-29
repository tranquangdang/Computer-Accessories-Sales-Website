

<?php 
    //Phân trang
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $limit = 15; // 10 title per page
    $start = ($page - 1) * $limit;

    if (isset($_GET['CategoryNo'])) {
        $cate = $_GET['CategoryNo'];
        $sql2= "select * from tblProductCategory where CategoryID in (".$cate.")";
        $result = mysqli_query($connect,$sql2);
        $st='';
        while( ($row = mysqli_fetch_assoc($result))!= NULL) {
            $st .= ' '.$row['CategoryName'];
        }
        echo '<h1>'.$st.'</h1>';
        $sql= "select * from tblProduct where CategoryNo in (".$cate.")";
        $total_title = mysqli_num_rows(mysqli_query($connect, $sql));
        $total_page = $total_title / $limit;
        $query = "SELECT * FROM tblProduct WHERE CategoryNo in (".$cate.") LIMIT " . $start . ", " . $limit;
    } else {
        $sql= "select * from tblProduct";
        $total_title = mysqli_num_rows(mysqli_query($connect, $sql));
        $total_page = $total_title / $limit;
        $query = "SELECT * FROM tblProduct  LIMIT " . $start . ", " . $limit;
    }

    $results = mysqli_query($connect,$query);
    while( ($rows = mysqli_fetch_assoc($results))!= NULL) {
?>

<div class="product_box">
    <a href="productdetail.php?ProductID=<?php echo $rows['ProductID']; ?>" style="display: block">
        <h3><?php echo $rows['ProductName']; ?></h3>
        <img src="<?php echo $rows['ProductImg']; ?>" alt="product image" />
        <p class="discount">₫<?php echo number_format($rows['UnitPrice']); ?></p>
        <p class="product_price"><a>₫</a><?php echo number_format($rows['UnitPrice']); ?></p>
    </a>
</div>
<?php } ?>
    <div class="page" style="float: right">
<?php
    for ($i = 1; $i <= $total_page; $i++) {
        echo '<a class="current" href="products.php?page=' . $i . '">' . $i . '</a> ';
    }
    ?>
    </div>