<?php require "include/header.php"; ?>
<?php require "include/sidebarprofile.php"; ?>
<?php 
if(!Session::get('customerId')) {
    header("Location:login.php");
}
$CustID = Session::get('customerId');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$update = $customer->customerUpdate($_POST, $CustID);
}
?>
 <style type="text/css">
 	 .tbl {width: 50%; margin: 0 auto}
	 .tbl tr td{text-align: justify;}
	 .tbl tbody tr td {border-top: none; padding: 5px}
 </style>
		<div id="content" class="float_r">
		<?php 
            $id = Session::get('customerId');
            $getData = $customer->getCustomerData($id);
            if ($getData) {
                while ($result = $getData->fetch_assoc()) {
					?>
			<form action="" method="post">
			<table class="table table-responsive tbl">
			<?php if (isset($update)) {
                        echo "<tr><td colspan='3' style='text-align: center;''>".$update."</td></tr>";
                    } ?>
				<tr>
					<td  colspan="3" style="text-align: center;"><h4 style="font-weight: 700;"> Thông tin tài khoản</h4></td>				
				</tr>
				<tr>
					<td >Tên</td>
					<td >:</td>
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
					<td colspan="3"><input  type="submit" name="submit" class="btn blackBtn" style="margin: 0 auto; text-align:center; cursor: pointer; vertical-align: middle; padding: 7px 15px" value="CẬP NHẬT" /></td>
				</tr>				
			</table>
			</form>
			<?php
                }
            } ?>		
		</div>
	<div class="cleaner"></div>
</div> <!-- END of main -->

<?php require "include/footer.php"?>
