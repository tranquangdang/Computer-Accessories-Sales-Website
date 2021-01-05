<?php require "include/header.php"; ?>
<?php 
if(!Session::get('customerId')) {
    header("Location:login.php");
}
 ?>
<style type="text/css">
.psuccess{width: 500px; min-height: 200px; text-align: center; border: 1px solid #ddd; margin: 0 auto; padding:20px;}	
.psuccess h2{border-bottom: 1px solid #ddd; margin-bottom: 20px; padding-bottom: 10px; color: crimson;}	
.psuccess p{line-height:25px; font-size:18px; text-align: left; }
 </style>
	<div class="section group">
		<div class="psuccess">
			<h2>Đặt hàng thành công!</h2>
			<p>Tổng tiền thanh toán là:
			<?php 
                echo number_format($cart->getTotalMoneyInvoice())." VNĐ";
            ?>
			</p>			
            <p>Chúng tôi đã nhận được yêu cầu từ đơn đặt hàng của bạn. Chúng tôi sẽ liên hệ với bạn trong khoảng thời gian sớm nhất. Cảm ơn vì đã lựa chọn chúng tôi!</p>
            <p>Bạn có thể kiểm tra đơn hàng <a href="orderdetails.php">tại đây</a></p>			
		</div>
	</div>
</div> <!-- END of main -->
<?php require "include/footer.php"?>
