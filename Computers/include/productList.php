<?php 
    $sql= "select * from tblProduct";
    $results = mysqli_query($connect,$sql);
    while( ($rows = mysqli_fetch_assoc($results))!= NULL )
{
?>
<div class="product_box">
    <a href="productdetail.php?ProductID=<?php echo $rows['ProductID']; ?>" style="display: block">
        <h3><?php echo $rows['ProductName']; ?></h3>
        <img src="<?php echo $rows['ProductImg']; ?>" alt="product image" />
        <p class="discount">₫<?php echo number_format($rows['UnitPrice']); ?></p>
        <p class="product_price"><a>₫</a><?php echo number_format($rows['UnitPrice']); ?></p>
    </a>
</div>
<?php }
    mysqli_close($connect);
?>