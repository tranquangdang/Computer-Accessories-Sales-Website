<?php require "include/topheader.php"; ?>
<?php 
if(!Session::get('customerId')) {
    header("Location:login.php");
}
if (isset($_GET['cancel'])) {
    $OrderID = $_GET['cancel'];
    $cancel = $cart->orderCancel($OrderID);
}
if (isset($_GET['confirm'])) {
    $OrderID =  $_GET['confirm'];
    $confirm = $cart->ConfirmShip($OrderID);
}
?>
<?php require "include/header.php"; ?>
<?php require "include/search.php"; ?>
 <style type="text/css">
    .order {width: 94%;}
 	.tblone  tr td{text-align:center;}
 </style>
    		<div class="section group">
    			<div class="order">
                    <h2>Chi tiết đơn hàng của bạn</h2>
                    <?php
                        $getOrder = $cart->getOrderInvoiceDetail();
                        if (!$getOrder) {echo '<p style="text-align: center">Không có đơn hàng nào!</p>';}
                        else {?> 
    				<table class="tblone table table-responsive table-bordered">
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
                            <td style="vertical-align: middle;  text-align: center;"><?php echo $i; ?></td>
                            <td style="vertical-align: middle;  text-align: center;"><?php $id = $result['OrderID'];  echo $id; ?>
                                <a type="button" class="btn blackBtn detailsBtn" data-id="<?php echo $id ?>" style="padding: 5px; font-size: 11px; text-align:center;">Xem chi tiết</a>
                            </td>
                            <td style="vertical-align: middle;  text-align: center;"><?php echo $format->formatDate($result['OrderDate']); ?></td>
                            <td style="vertical-align: middle;  text-align: center;"><?php echo number_format($result['OrderTotalMoney']); ?> VNĐ</td>
                            <td style="vertical-align: middle;  text-align: center;">
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
                            </td style="vertical-align: middle;  text-align: center;">
                            <?php if ($result['OrderStatus'] == '0') {?>
                                <td style="vertical-align: middle;  text-align: center;"><a class="blackBtn btn" style="padding: 5px; font-size: 11px; text-align:center;" href="?cancel=<?php echo $result['OrderID'] ?>">Hủy đơn hàng</a></td>
                            <?php } elseif ($result['OrderStatus'] == '1') {?>
                                <td style="vertical-align: middle;  text-align: center;"><p style="margin: 0; padding: 5px;">Không thể hủy</p></td>
                            <?php } elseif ($result['OrderStatus'] == '2') {?>
                                <td style="vertical-align: middle;  text-align: center;"><p style="margin: 0; padding: 5px;">Không thể hủy</p></td>
                            <?php } elseif ($result['OrderStatus'] == '3') {?>
                                <td style="vertical-align: middle;  text-align: center;"><a class="blackBtn btn" style="padding: 5px; font-size: 11px; text-align:center;" href="?confirm=<?php echo $result['OrderID'] ?>">Đã nhận được hàng</a></td>
                            <?php } else { ?>
                                <td style="vertical-align: middle;  text-align: center;">Hoàn thành</td>
                            <?php } ?>
                        </tr>
                        <?php
                            }
                        } ?>
                    </table>
    			</div>
    		</div>
       <div class="clear"></div>
</div> <!-- END of main -->
<?php require "include/footer.php"; ?>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Chi tiết sản phẩm</h4>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){  
    $('.detailsBtn').click(function(){
        var OrderNo = $(this).data("id");  
           $.ajax({  
                url:"modalorderdetails.php",  
                method:"post",  
                data:{OrderNo:OrderNo},  
                success:function(data){  
                    $('.modal-body').html(data);  
                    $('#myModal').modal('show');  
                }  
           });  
    });  
});
</script>
