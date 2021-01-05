<?php require ("include/header.php") ?>
<?php require ("include/sidebar.php") ?>
        <div id="content" class="float_r">
        	<h2>Lựa chọn phương thức thanh toán</h2>
            <table class="table table-responsive table-bordered">
                <tr>
                    <td style="vertical-align: middle;  text-align: center;" height="80px"> <img src="images/paypal.gif" style="margin-left:20px" alt="paypal" /></td>
                    <td style="padding: 0px 20px; color: black; font-size: 20px; vertical-align: middle;  text-align: center;">Thanh toán online
                    </td>
                    <td style="vertical-align: middle;  text-align: center;"><a a class="btn blackBtn" style="display: inline-block; font-size: 13px;  padding: 10px; text-align:center;" href="#">Thanh toán ngay</a></td>
                </tr>
                <tr>
                    <td style="vertical-align: middle;  text-align: center;"  height="80px"><img src="images/cod.jpg" style="margin-left:20px" alt="paypal" /></td>
                    <td  style="padding: 0px 20px; color: black; font-size: 20px; vertical-align: middle;  text-align: center;">Thanh toán COD</td>
                    <td style="vertical-align: middle;  text-align: center;"><a class="btn blackBtn" style="display: inline-block; font-size: 13px;  padding: 10px; text-align:center;" href="paymentoffline.php">Thanh toán ngay</a></td>
                </tr>
            </table>
            <br>
            <h5><strong>Mã giảm giá</strong></h5>
            <div class=" table table-responsive content_half float_l checkout"  style="width: 45%;">
                <input type="text"  style="width:200px; height: 30px; font-size: 20px; margin-top: 5px;" placeholder ="Nhập tại đây..." />
                <a class="btn blackBtn" style="float: right; font-size: 13px; width:30%;  padding: 10px; text-align:center;" href="#">ÁP DỤNG</a>
            </div>
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of main -->
    
    <?php require ("include/footer.php") ?>