<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../classes/Cart.php');
$ct = new Cart();
$fm = new Format();
?>
<?php 
if (isset($_GET['Confirm'])) {
    $OrderID	= $_GET['Confirm'];
    $Confirm = $ct->Confirm($OrderID);
}

if (isset($_GET['Prepare'])) {
    $OrderID	= $_GET['Prepare'];
    $Prepare = $ct->Prepare($OrderID);
}

if (isset($_GET['Ship'])) {
    $OrderID	= $_GET['Ship'];
    $Ship = $ct->Ship($OrderID);
}

if (isset($_GET['Remove'])) {
    $OrderID	= $_GET['Remove'];

    $Remove = $ct->orderCancel($OrderID);
}
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php
                 if (isset($shift)) {
                     echo $shift;
                 }
    if (isset($delOrder)) {
        echo $delOrder;
    }
  ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Ngày đặt hàng</th>								
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Hành động</th>
                            <th>Xóa</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                        
                        $getOrder = $ct->getAllOrderProduct();
                        if ($getOrder) {
                            $i=0;
                            while ($result = $getOrder->fetch_assoc()) {
                                $i++;?>
						<tr class="odd gradeX">
                            <td><?php echo $i ?></td>
                            <td><?php echo $result['OrderID']; ?></td>
                            <td><?php echo $result['CustName']; ?></td>
							<td><?php echo $fm->formatDate($result['OrderDate']); ?></td>
							<td><?php echo number_format($result['OrderTotalMoney']); ?> VNĐ</td>
							<td><a href="customer.php?custId=<?php echo $result['CustNo']; ?>">Xem thông tin khách</a></td>
							    <?php if ($result['OrderStatus'] == '0') {?>
							        <td><a href="?Confirm=<?php echo $result['OrderID']; ?>">Xác nhận đơn hàng</a></td>
                                <?php
                                } elseif ($result['OrderStatus'] == '1') {
                                    ?> 
                                <td><a href="?Prepare=<?php echo $result['OrderID']; ?>">Chuẩn bị đơn hàng</a></td>
                                <?php
                                } elseif ($result['OrderStatus'] == '2') {
                                ?> 
                                <td><a href="?Ship=<?php echo $result['OrderID']; ?>">Giao hàng</a></td>
                                <?php
                                } else {
                                    ?>							
                                <td>Hoàn thành</td>
							<?php
                                } ?>
                                <td><a href="?Remove=<?php echo $result['OrderID']; ?>">Xóa đơn hàng</a></td>
						</tr>
						<?php
                            }
                        } ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
