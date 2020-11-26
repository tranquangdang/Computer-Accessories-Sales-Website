<?php require ("include/header.php"); 
//session_destroy();
//Xử lí giỏ hàng
$cart = array();
    if(isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    if (isset($_GET['Action']) && isset($_GET['ProductID'])) {
    $ProductID = $_GET['ProductID'];
        if($_GET['Action'] == 'Add') {
        //Thêm sp vào giỏ hàng
        //Duyệt xem đã có chưa
        for($i=0; $i<count($cart); $i++) {
            if ($cart[$i]['ProductID'] == $ProductID) {
                $cart[$i]['QtyOnHand']++;
                break;
            }
        }
        if($i == count($cart)){
            //sản phẩm chưa có trong giỏ hàng => thêm vào
            //lấy thông tin của sản phẩm
            $sql = "select * from tblProduct where ProductID='".$ProductID."'";
            $results = mysqli_query($connect,$sql);
            while( ($rows = mysqli_fetch_assoc($results))!= NULL ) { //lấy tất cả thông tin sp 
                $rows['QtyOnHand']=1;
                //thêm vào giỏ hàng
                $cart[] = $rows;
                }
            } 
        } else {
            if($_GET['Action'] == 'Delete') { 
            //Xóa sản phẩm trong giỏ hàng
            //Kiểm tra sản phẩm có trong giỏ hàng chưa => xóa
            for($i=0; $i<count($cart); $i++) {
                if ($cart[$i]['ProductID'] == $ProductID) {
                    array_splice($cart, $i, 1); //Hàm xóa phần tử tại vị trí i
                    //Tham số thứ 3 trong hàm là số lượng phần tử cần xóa. Ở đây là xóa 1 phần tử
                    break;
                }
            }
        }
    }
    //Cập nhật giỏ hàng vào session
    $_SESSION['cart'] = $cart;
}
//Xử lý cập nhật giỏ hàng
if (isset($_POST['ProductID']) && isset($_POST['QtyOnHand'])) {
    $ProductID = $_POST['ProductID'];
    $QtyOnHand = $_POST['QtyOnHand'];
    for($i=0; $i<count($cart); $i++) {
        $cart[$i]['QtyOnHand'] = $QtyOnHand[$i];
    }
    //Cập nhật giỏ hàng vào session
    $_SESSION['cart'] = $cart;
}

?>
        <div id="content" class="float_r">
            <h1>Giỏ hàng</h1>
            <form action="shoppingcart.php" method="post">
        	<table width="680px" cellspacing="0" cellpadding="5">
                <tr bgcolor="#ddd">
                        <th width="220" align="left">Hình ảnh </th> 
                        <th width="180" align="left">Mô tả </th> 
                        <th width="100" align="center">Số lượng </th> 
                        <th width="60" align="right">Giá tiền </th> 
                        <th width="90" align="right">Tổng cộng </th> 
                        <th width="90" align="center">Xóa </th> 
                </tr>
                <?php //Hiển thị các sp trong giỏ hàng
                    $OrderTotalMoney = 0;
                    foreach($cart as $rows) {
                        $Amount = $rows['UnitPrice']*$rows['QtyOnHand'];
                        $OrderTotalMoney += $Amount;
                ?>
                <tr>
                    <td><img style="width: 200px; height: 200px" src="<?php echo $rows['ProductImg']; ?>" alt="image 1" /></td> 
                    <td><span><?php echo $rows['ProductName']; ?><input type="hidden" name="ProductID[]" value="<?php echo $rows['ProductID']; ?>" /></span></td> 
                    <td align="center"><input type="number" name="QtyOnHand[]" value="<?php echo $rows['QtyOnHand']; ?>" style="width: 30px; text-align: right" /></td>
                    <td align="right">₫<?php echo number_format($rows['UnitPrice']); ?></td> 
                    <td align="right">₫<?php echo number_format($Amount);?></td>
                    <td align="center"> <a href="shoppingcart.php?Action=Delete&ProductID=<?php echo $rows['ProductID']; ?>"><img src="images/remove_x.gif" alt="remove" /><br />Xóa</a> </td>
                </tr>
                    <?php }?>
                <tr>
                    <td colspan="3" align="right"  height="30px">Vui lòng cập nhật lại giỏ hàng nếu như bạn thay đổi sản phẩm (hoặc số lượng)... <input class="update" type="submit" value="Cập nhật"/></td>
                    <td width="200px" align="right" style="font-size:15px; background:#ddd; font-weight:bold"> Tổng cộng: </td>
                    <td align="right" style="background:#ddd; font-weight:bold"><p class="product_price" style="margin: 0; "><a>₫</a><?php echo number_format($OrderTotalMoney); ?></p></td>
                    <td style="background:#ddd; font-weight:bold"> </td>
                </tr>
            </table>
            </form>
            <div style="float:right; width: 215px; margin-top: 20px;">
                <a class="blackBtn" href="checkout.php?OrderTotalMoney=<?php echo number_format($OrderTotalMoney);?>" style="width: 135px; ">THANH TOÁN</a>
                <br>
                <p><a href="javascript:history.back()">Tiếp tục mua sắm</a></p>        	
            </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php require ("include/footer.php") ?>