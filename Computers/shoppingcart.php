<?php require ("include/header.php"); ?>
<?php 

//Sự kiện xóa
if (isset($_GET['ProductID']) && isset($_GET['CartID'])) {
    $ProductID = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['ProductID']);
    $CartID = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['CartID']);
    $delProduct = $cart->delProductByCart($CartID,$ProductID);
    if(!$cart->getCartProduct($CartID)){
        header("Location:index.php");
    }
}

//Sự kiện cập nhật số lượng
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $CartID = $_POST['CartID'];
    $ProductID = $_POST['ProductID'];
    $QtyOrdered = $_POST['QtyOrdered'];
    $updateCart = $cart->updateCartQuantity($CartID, $ProductID, $QtyOrdered);
}
?>
<?php require ("include/sidebar.php"); ?>
        <div id="content" class="float_r">
            <h1>Giỏ hàng</h1>
        	<table class="table table-responsive table-bordered">
                <tr>
                    <th style="padding-left: 5px; vertical-align: middle;  text-align: center;">Hình ảnh </th> 
                    <th style="vertical-align: middle;  text-align: center;">Mô tả </th> 
                    <th style="padding: 5px; vertical-align: middle;  text-align: center;" >Số lượng </th> 
                    <th style="vertical-align: middle;  text-align: center;">Giá tiền </th> 
                    <th style="padding-right: 5px; vertical-align: middle;  text-align: center;">Tổng cộng </th> 
                    <th style="vertical-align: middle;  text-align: center;">Xóa </th> 
                </tr
                <?php 
                    //Lấy id của khách đang đăng nhập
                    $CustNo = Session::get('customerId');
                    $select = "SELECT * FROM tblCart WHERE CustNo = '$CustNo'";
                    $getCustNo = $database->select($select);
                    if( ($row = $getCustNo->fetch_assoc()) != NULL ) {$CartID = $row['CartID'];}
                    //Lấy sản phẩm trong giỏ hàng đã có của khách
                    $getPro = $cart->getCartProduct($CartID);

                    if($getPro) {
                    $sum = 0;
                    $qty = 0;
                    //Duyệt để hiển thị thông tin sản phẩm trong giỏ hàng của khách
                    while ($rows = $getPro->fetch_assoc()) {
                    
                    ?>
                <tr>
                    <td><img style="width: 200px; height: 200px; vertical-align: middle;  text-align: center;" src="<?php echo $rows['ProductImg']; ?>" alt="image" /></td> 
                    <td style="font-size:15px; color: black; font-weight: bold; vertical-align: middle;  text-align: center;"><span><?php echo $rows['ProductName']; ?></span></td> 
                    <td style="vertical-align: middle;  text-align: center;">
                        <form action="" method="post">
                            <input type="hidden" name="CartID" value="<?php echo $rows['CartID']; ?>"/>
                            <input type="hidden" name="ProductID" value="<?php echo $rows['ProductID']; ?>"/>
                            <input type="number" name="QtyOrdered" value="<?php echo $rows['QtyOrdered']; ?>" min="1" onKeyDown="return false" style="width: 50px; text-align: right" />
                            <input class="update btn" type="submit" name="submit" value="Cập nhật"/>
                        </form>
                    </td>
                    <td style="vertical-align: middle;  text-align: center;">₫<?php echo number_format($rows['UnitPrice']); ?></td>
                    <td style="vertical-align: middle;  text-align: center;">₫<?php $total = $rows['UnitPrice'] * $rows['QtyOrdered']; echo number_format($total); ?></td></td>
                    <td style="vertical-align: middle;  text-align: center;"> <a class="btn" href="shoppingcart.php?CartID=<?php echo $rows['CartID']; ?>&ProductID=<?php echo $rows['ProductID']; ?>"><img src="images/remove_x.gif" alt="remove" /><br />Xóa</a> </td>
                </tr>
                    <?php 
                        }
                    }
                    ?>
                <tr>
                    <td colspan="3" style="font-size:20px; background:#ddd; font-weight:bold; vertical-align: middle;  text-align: right;"> Tổng cộng: </td>
                    <td colspan="3" style="background:#ddd; font-weight:bold; vertical-align: middle;  text-align: left  ;"><p class="product_price" style="margin: 0 10px; "><a>₫</a><?php 
                        //Coi có sp trong giỏ k
                        $total = $cart->getTotalMoney();
                        if ($getData) {
                            echo number_format($total);
                        }?>
                        </p>
                    </td>
                </tr>
            </table>
            <div style="float:right; width: 215px; margin-top: 20px;">
                <a class="blackBtn btn" href="checkout.php" style=" text-align: center; width: 200px; ">MUA HÀNG</a>
                <br>
                <p><a href="javascript:history.back()">Tiếp tục mua sắm</a></p>        	
            </div>
        </div>
        <div class="cleaner"></div>
    </div> <!-- END of main -->
    
    <?php require ("include/footer.php") ?>