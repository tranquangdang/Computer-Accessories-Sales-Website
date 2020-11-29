<?php
$tableName = "tblProduct";
$targetpage = "index.php";
$limit = 12;
$stages = 3;
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
if (isset($_GET['CategoryNo'])) {
    $cate = $_GET['CategoryNo'];
    $sql2 = "select * from tblProductCategory where CategoryID in (" . $cate . ")";
    $result = mysqli_query($connect, $sql2);
    $st = '';
    while (($row = mysqli_fetch_assoc($result)) != null) {
        $st .= ' ' . $row['CategoryName'];
    }
    echo '<h1>' . $st . '</h1>';
    $sql = "select * from tblProduct where CategoryNo in (" . $cate . ")";
    $query1 = "SELECT * FROM tblProduct WHERE CategoryNo in (" . $cate . ") LIMIT " . $start . ", " . $limit;
} else {
    $sql = "select * from tblProduct";
    $query1 = "SELECT * FROM tblProduct  LIMIT " . $start . ", " . $limit;
}

$total_pages = mysqli_num_rows(mysqli_query($connect, $sql));

// Get page data
$results = mysqli_query($connect, $query1);
while (($rows = mysqli_fetch_assoc($results)) != null) {?>
<div class="product_box">
    <a href="productdetail.php?ProductID=<?php echo $rows['ProductID']; ?>" style="display: block">
        <h3><?php echo $rows['ProductName']; ?></h3>
        <img src="<?php echo $rows['ProductImg']; ?>" alt="product image" />
        <p class="discount">₫<?php echo number_format($rows['UnitPrice']); ?></p>
        <p class="product_price"><a>₫</a><?php echo number_format($rows['UnitPrice']); ?></p>
    </a>
</div>

<?php
}

// Initial page num setup
if ($page == 0) {$page = 1;}
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($total_pages / $limit);
$LastPagem1 = $lastpage - 1;

$paginate = '';
if ($lastpage > 1) {

    $paginate .= "<div class='paginate'>";
    // Previous
    if ($page > 1) {
        $paginate .= "<a href='$targetpage?page=$prev'>Quay lại</a>";
    } else {
        $paginate .= "<span class='disabled'>Quay lại</span>";}

    // Pages
    if ($lastpage < 7 + ($stages * 2)) // Not enough pages to breaking it up
    {
        for ($counter = 1; $counter <= $lastpage; $counter++) {
            if ($counter == $page) {
                $paginate .= "<span class='current'>$counter</span>";
            } else {
                $paginate .= "<a href='$targetpage?page=$counter'>$counter</a>";}
        }
    } elseif ($lastpage > 5 + ($stages * 2)) // Enough pages to hide a few?
    {
        // Beginning only hide later pages
        if ($page < 1 + ($stages * 2)) {
            for ($counter = 1; $counter < 4 + ($stages * 2); $counter++) {
                if ($counter == $page) {
                    $paginate .= "<span class='current'>$counter</span>";
                } else {
                    $paginate .= "<a href='$targetpage?page=$counter'>$counter</a>";}
            }
            $paginate .= "...";
            $paginate .= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
            $paginate .= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";
        }
        // Middle hide some front and some back
        elseif ($lastpage - ($stages * 2) > $page && $page > ($stages * 2)) {
            $paginate .= "<a href='$targetpage?page=1'>1</a>";
            $paginate .= "<a href='$targetpage?page=2'>2</a>";
            $paginate .= "...";
            for ($counter = $page - $stages; $counter <= $page + $stages; $counter++) {
                if ($counter == $page) {
                    $paginate .= "<span class='current'>$counter</span>";
                } else {
                    $paginate .= "<a href='$targetpage?page=$counter'>$counter</a>";}
            }
            $paginate .= "...";
            $paginate .= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
            $paginate .= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";
        }
        // End only hide early pages
        else {
            $paginate .= "<a href='$targetpage?page=1'>1</a>";
            $paginate .= "<a href='$targetpage?page=2'>2</a>";
            $paginate .= "...";
            for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++) {
                if ($counter == $page) {
                    $paginate .= "<span class='current'>$counter</span>";
                } else {
                    $paginate .= "<a href='$targetpage?page=$counter'>$counter</a>";}
            }
        }
    }

    // Next
    if ($page < $counter - 1) {
        $paginate .= "<a href='$targetpage?page=$next'>Tiếp theo</a>";
    } else {
        $paginate .= "<span class='disabled'>Tiếp theo</span>";
    }
    $paginate .= "</div>";
}
// pagination
echo '<div id="paginate">'.'<p>'.$total_pages . ' Kết quả</p>'.'<p>'.$paginate.'</p></div>';
?>