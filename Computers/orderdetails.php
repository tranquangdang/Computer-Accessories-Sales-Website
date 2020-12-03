<?php require "include/header.php"; ?>
<?php 
if(!Session::get('customerId')) {
    header("Location:login.php");
}
 ?>
 <?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Cancel'])  && isset($_POST['OrderID'])) {
    $OrderID = $_POST['OrderID'];
    $cancel = $cart->orderCancel($OrderID);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Confirm']) && isset($_POST['OrderID'])) {
    $OrderID = $_POST['OrderID'];
    $confirm = $cart->productShiftConfirm($OrderID);
}
  ?>
 <style type="text/css">
 	.tblone  tr td{text-align:center;}
 </style>
    		<div class="section group">
    			<div class="order">
                    <h2>Chi tiết đơn hàng của bạn</h2>
                    <?php
                        $getOrder = $cart->getOrderInvoiceDetail();
                        if (!$getOrder) {echo '<p style="text-align: center">Không có đơn hàng nào!</p>';}
                        else {?> 
                    <form action="" method="post">
    				<table class="tblone">
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt hàng</th>								
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Hành động</th>
                        </tr>
                        <?php
                            $i=0;
                            while ($result = $getOrder->fetch_assoc()) {
                                $i++; ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['OrderID']; ?>
                                <a href="#" class="hover"  id="<?php echo $result['OrderID']; ?>">(xem chi tiết)</a>
                            </td>
                            <td><?php echo $format->formatDate($result['OrderDate']); ?></td>
                            <td><?php echo number_format($result['OrderTotalMoney']); ?> VNĐ</td>
                            <td>
                                <?php
                                    if ($result['OrderStatus'] == '0') {
                                        echo "Đang chờ xác nhận";
                                    } elseif ($result['OrderStatus'] == '1') {
                                        echo "Đang xử lí";
                                    } elseif ($result['OrderStatus'] == '2') {
                                        echo "Đang giao hàng";
                                    } else {
                                        echo "Đã giao hàng";
                                    }
                                ?>
                            </td>
                            <input type="hidden" name="OrderID" value="<?php echo $result['OrderID'];?>"/>
                            <?php if ($result['OrderStatus'] == '0') {?>
                                <td><input type="submit" name="Cancel" value="Hủy đơn hàng" /></td>
                            <?php } elseif ($result['OrderStatus'] == '1') {?>
                                <td><a onclick="<?php echo "<script language='javascript'>alert('Không thể hủy');"; echo "location.href='orderdetails.php';</script>";?>">Hủy đơn hàng</a></td>
                            <?php } elseif ($result['OrderStatus'] == '2') {?>
                                <td><input type="submit" name="Confirm" value="Đã giao hàng" /></td>
                            <?php } else { ?>
                                <td>Hoàn thành</td>
                            <?php } ?>
                        </tr>
                        <?php
                            }
                        } ?>
                    </table>
                    </form>
    			</div>
    		</div>
       <div class="clear"></div>
</div> <!-- END of templatemo_main -->
<?php require "include/footer.php"; ?>
