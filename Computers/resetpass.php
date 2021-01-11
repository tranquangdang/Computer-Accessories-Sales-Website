<?php require "include/header.php"; ?>
<?php require "include/sidebarprofile.php"; ?>
<?php 
if(!Session::get('customerId')) {
    header("Location:login.php");
}
$CustID = Session::get('customerId');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$update = $customer->customerResetPassword($_POST, $CustID);
}
?>
 <style type="text/css">
 	 .tbl {width: 50%; margin: 0 auto}
	 .tbl tr td{text-align: justify;}
	 .tbl tbody tr td {border-top: none; padding: 5px}
 </style>
		<div id="content" class="float_r">
			<form action="" method="post">
				<table class="table table-responsive tbl">
				<?php if (isset($update)) {
							echo "<tr><td colspan='3' style='text-align: center;''>".$update."</td></tr>";
						} ?>
					<tr>
						<td  colspan="3" style="text-align: center;"><h4 style="font-weight: 700;">Thay đổi mật khẩu</h4></td>				
					</tr>
					<tr>
						<td>Mật khẩu cũ</td>
						<td>:</td>
						<td><input type="text" name="OldPass"></td>
					</tr>
					<tr>
						<td>Mật khẩu mới</td>
						<td>:</td>
						<td><input type="text" name="NewPass"></td>
					</tr>
					<tr>
						<td>Nhập lại mật khẩu</td>
						<td>:</td>
						<td><input type="text" name="ConfirmPass"></td>
					</tr>
					<tr>
						<td colspan="3"><input  type="submit" name="submit" class="btn blackBtn" style="margin: 0 auto; text-align:center; cursor: pointer; vertical-align: middle; padding: 7px 15px" value="CẬP NHẬT" /></td>
					</tr>				
				</table>
			</form>		
		</div>
	<div class="cleaner"></div>
</div> <!-- END of main -->

<?php require "include/footer.php"?>
