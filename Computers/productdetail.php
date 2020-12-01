<?php require ("include/header.php") ?>
<?php
if (isset($_GET['ProductID'])) {
    $ProductID = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['ProductID']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    $addCart = $cart->addToCart($quantity, $ProductID);
}
?>
        <div id="content" class="float_r">
            <?php
                $results = $product->getProById($ProductID);
                while( ($rows = $results->fetch_assoc())!= NULL )
			    {
			?>
        	<h1><?php echo $rows['ProductName']; ?></h1>
            <div class="content_half float_l">
        	<a  rel="lightbox[portfolio]" href="#"><img class="detail" src="<?php echo $rows['ProductImg']; ?>" alt="image" /></a>
            </div>
            <div class="content_half float_r">
                <form action="" method="post">
                <table>
                    <tr>
                        <td align="right"><p class="product_price"><a>₫</a><?php echo number_format($rows['UnitPrice']); ?></p></td>
                        <td ><p class="discount">₫<?php echo number_format($rows['UnitPrice']); ?></p></td>
                    </tr>
                    <tr>
                        <td>Số lượng trong kho:</td>
                        <td><?php echo $rows['QtyOnHand']; ?></td>
                    </tr>
                    <tr>
                        <td>Nhà sản xuất:</td>
                        <td><?php echo $rows['Brand']; ?></td>
                    </tr>
                    <tr>
                    	<td>Số lượng</td>
                        <td><input type="number" name="quantity" value="1" min="1" onKeyDown="return false" max="<?php echo $rows['QtyOnHand']; ?>" style="width: 30px; text-align: right" /></td>
                    </tr>
                    <tr>
                        <input type="hidden" name="ProductID" value="<?php echo $rows['ProductID']; ?>"/>
                        <td colspan="2">
                            <?php 
                            if(Session::get('customerId')) {
                                echo '<input type="submit" name="submit" class="blackBtn" style="margin-top: 30px; text-align:center; cursor: pointer;" value="THÊM VÀO GIỎ HÀNG" />';
                            } else {
                                echo '<a href="login.php" class="blackBtn" style="margin-top: 30px; text-align:center; cursor: pointer;">ĐĂNG NHẬP NGAY</a>';
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                </form>
                <div class="cleaner h20"></div>

			</div>
            <div class="cleaner h30"></div>
            
            <h5>Mô tả sản phẩm:</h5>
            <p><?php echo $rows['Intro']; ?></p>	
            <?php 
                }
            ?>
            <div class="cleaner h50"></div>
            
            <h3>Sản phẩm có liên quan</h3>
        	<?php require ("include/productList.php") ?>    
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php require ("include/footer.php") ?>