<?php require "include/header.php"; ?>
<?php 
if(!Session::get('customerId')) {
    header("Location:login.php");
}
 ?>
 <?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Cancel'])) {
    $OrderID = $_POST['OrderID'];
    $cancel = $cart->orderCancel($OrderID);
    header("Location:orderdetails.php");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Confirm'])) {
    $OrderID = $_POST['OrderID'];
    $confirm = $cart->ConfirmShip($OrderID);
    header("Location:orderdetails.php");
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
                                        echo "Chưa xác nhận";
                                    } elseif ($result['OrderStatus'] == '1') {
                                        echo "Đã xác nhận";
                                    } elseif ($result['OrderStatus'] == '2') {
                                        echo "Đang chuẩn bị đơn hàng";
                                    } elseif ($result['OrderStatus'] == '3') {
                                        echo "Đang giao hàng";
                                    } else {
                                        echo "Đã giao hàng";
                                    }
                                ?>
                            </td>
                            <input type="hidden" name="OrderID" value="<?php echo $result['OrderID'];?>"/>
                            <?php if ($result['OrderStatus'] == '0') {?>
                                <form action="" method="post">
                                    <td><input type="submit" name="Cancel" value="Hủy đơn hàng" /><input type="hidden" name="OrderID" value="<?php $result['OrderID']?>" /></td>
                                </form>
                            <?php } elseif ($result['OrderStatus'] == '1') {?>
                                <td><a onclick="<?php echo "<script language='javascript'>alert('Không thể hủy');"; echo "location.href='orderdetails.php';</script>";?>">Hủy đơn hàng</a></td>
                            <?php } elseif ($result['OrderStatus'] == '2') {?>
                                <td><a onclick="<?php echo "<script language='javascript'>alert('Không thể hủy');"; echo "location.href='orderdetails.php';</script>";?>">Hủy đơn hàng</a></td>
                            <?php } elseif ($result['OrderStatus'] == '3') {?>
                                <form method="post">
                                    <td><input type="submit" name="Confirm" value="Đã nhận được hàng" /><input type="hidden" name="OrderID" value="<?php $result['OrderID']?>" /></td>
                                </form>
                            <?php } else { ?>
                                <td>Hoàn thành</td>
                            <?php } ?>
                        </tr>
                        <?php
                            }
                        } ?>
                    </table>
    			</div>
    		</div>
       <div class="clear"></div>
</div> <!-- END of templatemo_main -->
<?php require "include/footer.php"; ?>
