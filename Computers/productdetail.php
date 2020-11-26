<?php require ("include/header.php") ?>
        <div id="content" class="float_r">
            <?php
            if(isset($_GET['ProductID'])) {
                $id = $_GET['ProductID'];
                $sql= "select * from tblProduct where ProductID= '".$id."'";
                $results = mysqli_query($connect,$sql);
                while( ($rows = mysqli_fetch_assoc($results))!= NULL )
			    {
			?>
        	<h1><?php echo $rows['ProductName']; ?></h1>
            <div class="content_half float_l">
        	<a  rel="lightbox[portfolio]" href="#"><img class="detail" src="<?php echo $rows['ProductImg']; ?>" alt="image" /></a>
            </div>
            <div class="content_half float_r">
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
                        <td><input type="number" value="1" style="width: 30px; text-align: right" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" ><a href="shoppingcart.php?Action=Add&ProductID=<?php echo $rows['ProductID']; ?>" class="blackBtn" style="margin-top: 30px; text-align:center;">THÊM VÀO GIỎ HÀNG</a></td>
                    </tr>
                </table>
                <div class="cleaner h20"></div>

			</div>
            <div class="cleaner h30"></div>
            
            <h5>Mô tả sản phẩm:</h5>
            <p><?php echo $rows['Intro']; ?></p>	
            <?php 
                }
            }
            ?>
            <div class="cleaner h50"></div>
            
            <h3>Sản phẩm có liên quan</h3>
        	<?php require ("include/productList.php") ?>    
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php require ("include/footer.php") ?>