
<div id="footer">
    
</div> <!-- END of wrapper -->
</div> <!-- END of wrapper -->
<div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Báo cáo PHP</h4>
						<ul>
							<li><a href="https://www.facebook.com/100028284979748">Trần Quang Đăng</a></li>
							<li><a href="https://www.facebook.com/100004801414568">Huỳnh Phước Trường</a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Thông tin</h4>
						<ul>
							<li><a href="about.php">Về chúng tôi</a></li>
							<li><a href="contact.php">Liên hệ</a></li>
							<li><a href="faqs.php">Điều khoản sử dụng</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Tài khoản</h4>
						<ul>
							<?php if(Session::get('customerId')) {?>
							<li><a href="profile.php">Tài khoản</a></li>
							<?php
							$CustNo = Session::get('customerId');
							$select = "SELECT * FROM tblCart WHERE CustNo = '$CustNo'";
							$result = $database->select($select);
							if($result && $cart->checkCartItem()) {?>
							<li><a href="shoppingcart.php">Xem giỏ hàng</a></li>
							<?php }}?>
							<li><a href="buildpc.php">Xây dựng cấu hình</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Địa chỉ và SĐT</h4>
						<ul>
							<li><span>48 Cao Thắng, Thanh Bình, Hải Châu, Đà Nẵng</span></li>
              				<li><span>+8469696969</span></li>
						</ul>
						<div class="social-icons">
							<h4>Theo dõi chúng tôi</h4>
					   		  <ul>
							      <li class="facebook"><a href="#" target="_blank"> </a></li>
							      <li class="twitter"><a href="#" target="_blank"> </a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p>Trần Quang Đăng &amp; All rights Reseverd </p>
		   </div>
     	</div>
	</div>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script> 
	<script type="text/javascript">
		$(document).ready(function() {
			$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
    

</body>
</html>