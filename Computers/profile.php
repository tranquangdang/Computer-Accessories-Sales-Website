<?php require "include/header.php"; ?>
<?php 
if(!Session::get('customerId')) {
    header("Location:login.php");
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
					<td colspan="3"><a href="editprofile.php" class="blackBtn" style="margin-top: 30px; text-align:center; cursor: pointer;">CẬP NHẬT</a></td>
				</tr>				
			</table>
			<?php
                }
            } ?>			
		</div>

		<div class="cleaner"></div>
</div> <!-- END of templatemo_main -->

<?php require "include/footer.php"?>
