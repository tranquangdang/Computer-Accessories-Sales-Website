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
.tblone{ float: left; width:68%;}
.tblone th{ vertical-align: middle; text-align:center; font-size: 15px;}
.tblone tr td{color: black; text-align: justify;}
.tbltwo{float:right; text-align:left; width:30%;}
.tbltwo tbody tr td {border-top: none; padding: 3px}
</style>
	<div class="section group" style="width: 930px">
		<table class="table table-responsive table-bordered tblone">
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
				<td>₫<?php echo number_format($cart->DiscountPrice($result['UnitPrice'],$result['PerDiscount'])); ?></td>
				<td><?php echo $result['QtyOrdered']; ?></td>								
				<td>₫<?php echo number_format($total = $cart->DiscountPrice($result['UnitPrice'],$result['PerDiscount']) * $result['QtyOrdered']); ?></td>								
			</tr>
			<?php 
				}}
			?>
		</table>

		<table class="table table-responsive tbltwo">
			<tr>
				<td colspan="3">
					<h3 style="margin: 0; "><b>Thanh toán</b></h3>
				</td>
			</tr>
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
				<td>Số sản phẩm</td>
				<td>:</td>
				<td><?php echo $cart->getQty(); ?></td>								
			</tr>
			<tr>
				<td style="vertical-align: middle;">Thành tiền</td>
				<td style="vertical-align: middle;">:</td>
				<td style="color: #1435C3; font-size: 25px; font-weight: 700; vertical-align: middle;">₫<?php 
				$gTotal = $cart->getTotalMoney() + $vat;
				echo number_format($gTotal); ?></td>
			</tr>
			<tr>
				<td colspan="3">
				<form action="" method ="post">
					<input type="hidden" name="Total" value = "<?php echo $gTotal?>"/>
					<input type="submit" name="submit" class="btn blackBtn" style="font-weight: bold; margin:20px auto 0; padding: 20px; text-align:center; cursor: pointer;" value="ĐẶT HÀNG"/>
				</form>
				</td>
			</tr>
		</table>
	</div>
</div> <!-- END of main -->
	<?php require "include/footer.php"?>
