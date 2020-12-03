<?php require "include/header.php"; ?>
<?php 
if(!Session::get('customerId')) {
    header("Location:login.php");
}
 ?>
 <?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$Total = $_POST['Total'];
	$CustID = Session::get('customerId');
	$insertOrder = $cart->orderProduct($CustID,$Total);
	
    $delData = $cart->delCustomerCart($CustID);
    header("Location:success.php");
}
  ?>
<style type="text/css">
.division{width:50%; float:left;}
.tblone{width: 95%; margin-right:15px; border:2px solid #ddd;}
.tblone th{font-size: 15px;}
.tblone tr td{color: black; text-align: justify;}
.tbltwo{float:right; text-align:left; width:58%; border:2px solid #ddd; margin-right:14px; margin-top: -4px; margin-right: 24px;}
.tbltwo tr td{font-size: 15px; color: black; font-weight: bold; text-align:justify; padding: 5px 10px;}
</style>
		<div class="section group">
			<div class="division">
				<table class="tblone">
							<tr>
								<th>STT</th>
								<th>Sản phẩm</th>								
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Tổng cộng</th>								
							</tr>
							<?php 
                            $CustNo = Session::get('customerId');
							$select = "SELECT * FROM tblCart WHERE CustNo = '$CustNo'";
							$getCustNo = $database->select($select);
							if( ($row = $getCustNo->fetch_assoc()) != NULL ) {$CartID = $row['CartID'];}
							//Lấy sản phẩm trong giỏ hàng đã có của khách
							$getPro = $cart->getCartProduct($CartID);
                            if ($getPro) {
                                $i=0;
                                $sum = 0;
                                $qty = 0;
                                while ($result = $getPro->fetch_assoc()) {
                                    $i++; ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['ProductName']; ?></td>								
								<td>₫<?php echo number_format($result['UnitPrice']); ?></td>
								<td><?php echo $result['QtyOrdered']; ?></td>								
								<td>₫<?php echo number_format($total = $result['UnitPrice'] * $result['QtyOrdered']); ?></td>								
							</tr>
							<?php 
                    			}}
                    		?>
						</table>
						
						<table class="tbltwo">
							<tr>								
								<td>Tổng cộng</td>
								<td>:</td>
								<td>₫<?php echo number_format($cart->getTotalMoney());?></td>								
							</tr>
							<tr>								
								<td>Giảm giá</td>
								<td>:</td>
								<td>₫0</td>								
							</tr>
							<tr>
								<td>VAT 10%</td>
								<td>:</td>
								<td>
								<?php 
									$vat = $cart->getTotalMoney() * 0.1;
									echo "₫".number_format($vat); 
								?>
								</td>
							</tr>
							<tr>
								<td>Thành tiền</td>
								<td>:</td>
								<td>₫<?php 
                                $gTotal = $cart->getTotalMoney() + $vat;
                        		echo number_format($gTotal); ?></td>
							</tr>
							<tr>								
								<td>Số sản phẩm</td>
								<td>:</td>
								<td><?php echo $cart->getQty(); ?></td>								
							</tr>
					   </table>
			</div>			
			<div class="division">
			<?php 
            $id = Session::get('customerId');
            $getData = $customer->getCustomerData($id);
            if ($getData) {
                while ($result = $getData->fetch_assoc()) {
                    ?>
			<table class="tblone">
				<tr>
					<td  colspan="3" style="text-align: center;"><h2>Thông tin tài khoản</h2></td>					
				</tr>
				<tr>
					<td width="30%">Tên</td>
					<td width="10%">:</td>
					<td ><?php echo $result['CustName']; ?></td>
				</tr>
				<tr>
					<td>Địa chỉ</td>
					<td>:</td>
					<td><?php echo $result['CustAddress']; ?></td>
				</tr>
				<tr>
					<td>Số điện thoại</td>
					<td>:</td>
					<td><?php echo $result['TelNo']; ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><?php echo $result['Email']; ?></td>
				</tr>
				<tr>
					<td colspan="3"><a href="editprofile.php" class="blackBtn" style="margin-top: 30px; text-align:center; cursor: pointer;">THAY ĐỔI</a></td>
				</tr>				
			</table>
			<?php
                }
            } ?>			
		</div>
	</div>
	<div>
		<form action="" method ="post">
			<input type="hidden" name="Total" value = "<?php echo $gTotal?>"/>
			<input type="submit" name="submit" class="blackBtn" style="font-weight: bold; width:20%; margin:20px auto 0; padding: 20px; text-align:center; cursor: pointer;" value="ĐẶT HÀNG"/>
		</form>
	</div>
	</div> <!-- END of templatemo_main -->
	<?php require "include/footer.php"?>
