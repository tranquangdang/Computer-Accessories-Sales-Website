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
        	<table width="680px" cellspacing="0" cellpadding="5">
                <tr bgcolor="#ddd">
                        <th  align="left">Hình ảnh </th> 
                        <th  align="left">Mô tả </th> 
                        <th  align="center">Số lượng </th> 
                        <th  align="right">Giá tiền </th> 
                        <th  align="right">Tổng cộng </th> 
                        <th  align="center">Xóa </th> 
                </tr>
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
                    <td><img style="width: 200px; height: 200px" src="<?php echo $rows['ProductImg']; ?>" alt="image" /></td> 
                    <td style="font-size:15px; color: black; font-weight: bold"><span><?php echo $rows['ProductName']; ?></span></td> 
                    <td align="center">
                        <form action="" method="post">
                            <input type="hidden" name="CartID" value="<?php echo $rows['CartID']; ?>"/>
                            <input type="hidden" name="ProductID" value="<?php echo $rows['ProductID']; ?>"/>
                            <input type="number" name="QtyOrdered" value="<?php echo $rows['QtyOrdered']; ?>" min="1" onKeyDown="return false" style="width: 30px; text-align: right" />
                            <input class="update" type="submit" name="submit" value="Cập nhật"/>
                        </form>
                    </td>
                    <td align="right">₫<?php echo number_format($rows['UnitPrice']); ?></td>
                    <td align="right">₫<?php $total = $rows['UnitPrice'] * $rows['QtyOrdered']; echo number_format($total); ?></td></td>
                    <td align="center"> <a href="shoppingcart.php?CartID=<?php echo $rows['CartID']; ?>&ProductID=<?php echo $rows['ProductID']; ?>"><img src="images/remove_x.gif" alt="remove" /><br />Xóa</a> </td>
                </tr>
                    <?php 
                        $qty = $qty + $rows['QtyOrdered'];
                        $sum = $sum + $total;
                    }}
                    ?>
                <tr>
                    <td colspan="3" align="right"  height="30px"> </td>
                    <td align="right" style="font-size:15px; background:#ddd; font-weight:bold"> Tổng cộng: </td>
                    <td colspan="3" align="right" style="background:#ddd; font-weight:bold"><p class="product_price" style="margin: 0; "><a>₫</a><?php 
                        //Coi có sp trong giỏ k
                        $getData = $cart->checkCartItem();
                        if ($getData) {
                            echo number_format($sum);
                        }?>
                        </p>
                    </td>
                </tr>
            </table>
            <div style="float:right; width: 215px; margin-top: 20px;">
                <a class="blackBtn" href="checkout.php?OrderTotalMoney=<?php echo number_format($sum);?>" style="width: 135px; ">THANH TOÁN</a>
                <br>
                <p><a href="javascript:history.back()">Tiếp tục mua sắm</a></p>        	
            </div>
        </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php require ("include/footer.php") ?>