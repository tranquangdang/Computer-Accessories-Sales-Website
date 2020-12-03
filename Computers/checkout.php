<?php require ("include/header.php") ?>
<?php require ("include/sidebar.php") ?>
        <div id="content" class="float_r">
        	<h2>Lựa chọn phương thức thanh toán</h2>
            <table style="border:1px solid #CCCCCC;" width="100%">
                <tr>
                    <td height="80px"> <img src="images/paypal.gif" style="margin-left:20px" alt="paypal" /></td>
                    <td style="padding: 0px 20px; color: black; font-size: 20px">Thanh toán online
                    </td>
                    <td><a a class="blackBtn" style="display: inline-block; font-size: 13px;  padding: 10px; text-align:center;" href="#">Thanh toán ngay</a></td>
                </tr>
                <tr>
                    <td  height="80px"><img src="images/cod.jpg" style="margin-left:20px" alt="paypal" /></td>
                    <td  style="padding: 0px 20px; color: black; font-size: 20px">Thanh toán COD</td>
                    <td><a class="blackBtn" style="display: inline-block; font-size: 13px;  padding: 10px; text-align:center;" href="paymentoffline.php">Thanh toán ngay</a></td>
                </tr>
            </table>
            <br>
            <h5><strong>Mã giảm giá</strong></h5>
            <div class="content_half float_l checkout"  style="width: 45%;">
                <input type="text"  style="width:200px; height: 30px; font-size: 20px;" placeholder ="Nhập tại đây..." />
                <a class="blackBtn" style="float: right; font-size: 13px; width:20%;  padding: 10px; text-align:center;" href="#">ÁP DỤNG</a>
            </div>
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php require ("include/footer.php") ?>