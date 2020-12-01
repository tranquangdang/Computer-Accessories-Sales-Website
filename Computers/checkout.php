<?php require ("include/header.php") ?>
<?php require ("include/sidebar.php") ?>
        <div id="content" class="float_r">
        	<h2>Thanh Toán</h2>
            <h5><strong>Hóa Đơn</strong></h5>
            <div class="content_half float_l checkout">
				Họ và tên:
                  <input type="text"  style="width:300px;"  />
                <br />
                <br />
              Địa chỉ:
				<input type="text"  style="width:300px;"  />
            </div>
            
            <div class="content_half float_r checkout">
            	eMail:
				<input type="text"  style="width:300px;"  />
                <br />
                <br />
                Số điện thoại:
                <input type="text"  style="width:300px;"  />
            </div>
            
            <div class="cleaner h50"></div>
            <h3>Giỏ hàng</h3>
            <h4>Tổng tiền: <strong>₫<?php if(isset($_GET['OrderTotalMoney'])) echo $_GET['OrderTotalMoney'];?></strong></h4>
			<p><input type="checkbox" />
			Tôi đồng ý với <a href="#">điều khoản</a> của website này</p>
            <table style="border:1px solid #CCCCCC;" width="100%">
                <tr>
                    <td height="80px"> <img src="images/paypal.gif" alt="paypal" /></td>
                    <td width="400px;" style="padding: 0px 20px;">Thanh toán online
                    </td>
                    <td><a href="#" class="more">Thanh toán ngay</a></td>
                </tr>
                <tr>
                    <td  height="80px"><img src="images/cod.jpg" alt="paypal" />
                    </td>
                    <td  width="400px;" style="padding: 0px 20px;">Thanh toán COD</td>
                    <td><a href="#" class="more">Thanh toán ngay</a></td>
                </tr>
            </table>
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php require ("include/footer.php") ?>