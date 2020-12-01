<?php require "include/header.php"; ?>
<?php 
if(!Session::get('customerId')) {
    header("Location:login.php");
}
 ?>
 <?php 
$CustID = Session::get('customerId');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$update = $customer->customerUpdate($_POST, $CustID);
	header("Location:profile.php");
}
?>

<style type="text/css">
 	.tblone{width: 50%; margin: 0 auto; border:2px solid #ddd;}
 	.tblone tr td{text-align: justify; font-size: 20px}
 </style>
		<div class="section group">
			<?php 
            $id = Session::get('customerId');
            $getData = $customer->getCustomerData($id);
            if ($getData) {
                while ($result = $getData->fetch_assoc()) {
					?>
			<form action="" method="post">
			<table class="tblone">
			<?php if (isset($update)) {
                        echo "<tr><td colspan='3' style='text-align: center;''>".$update."</td></tr>";
                    } ?>
				<tr>
					<td  colspan="3" style="text-align: center;"><h2>Thông tin tài khoản</h2></td>					
				</tr>
				<tr>
					<td width="30%">Tên</td>
					<td width="10%">:</td>
					<td><input type="text" name="CustName" value="<?php echo $result['CustName']; ?>"></td>
				</tr>
				<tr>
					<td>Địa chỉ</td>
					<td>:</td>
					<td><input type="text" name="CustAddress" value="<?php echo $result['CustAddress']; ?>"></td>
				</tr>
				<tr>
					<td>Số điện thoại</td>
					<td>:</td>
					<td><input type="text" name="TelNo" value="<?php echo $result['TelNo']; ?>"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><input type="text" name="Email" value="<?php echo $result['Email']; ?>"></td>
				</tr>
				<tr>
					<td colspan="3"><input  type="submit" name="submit" class="blackBtn" style="width:100%;text-align:center; cursor: pointer;" value="CẬP NHẬT" /></td>
				</tr>				
			</table>
			</form>
			<?php
                }
            } ?>			
		</div>

		<div class="cleaner"></div>
</div> <!-- END of templatemo_main -->

<?php require "include/footer.php"?>
