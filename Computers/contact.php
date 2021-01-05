<?php require ("include/header.php") ?>
<?php require ("include/sidebar.php") ?>
        <div id="content" class="float_r">
        	<h1>Liên hệ với chúng tôi</h1>
            <div class="content_half float_l">
                <p>Gửi mail bằng cách điền các thông tin dưới đây:</p>
                <div id="contact_form">
                   <form method="post" name="contact" action="#">
                        
                        <label for="author">Họ và tên:</label> <input type="text" id="author" name="author" class="required input_field" />
                        <div class="cleaner h10"></div>
                        <label for="email">Email:</label> <input type="text" id="email" name="email" class="validate-email required input_field" />
                        <div class="cleaner h10"></div>
                        
                        <label for="phone">Số điện thoại:</label> <input type="text" name="phone" id="phone" class="input_field" />
                        <div class="cleaner h10"></div>
        
                        <label for="text">Nội dung:</label> <textarea id="text" name="text" rows="0" cols="0" class="required"></textarea>
                        <div class="cleaner h10"></div>
                        
                        <input type="submit" class="submit_btn" name="submit" id="submit" value="Gửi" />
                        
                    </form>
                </div>
            </div>
        <div class="content_half float_r">
        	<h5>Địa chỉ cửa hàng</h5>
			48 Cao Thắng, <br />
			Thanh Bình, Hải Châu<br />
			Đà Nẵng<br /><br />
						
			SĐT: +84123456789<br />
			Email: <a href="mailto:info@yourcompany.com">info@dangtruong.com</a><br/>
			
            <div class="cleaner h40"></div>
			
			<br />
            Mọi chi tiết thắc mắc xin liên hệ đến thông tin trên
        </div>
        
        <div class="cleaner h40"></div>
        
        <iframe width="680" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.7896185889294!2d108.21172711485858!3d16.076403388876525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142184792140755%3A0xd4058cb259787dac!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBTxrAgUGjhuqFtIEvhu7kgdGh14bqtdCAtIMSQ4bqhaSBo4buNYyDEkMOgIE7hurVuZw!5e0!3m2!1svi!2s!4v1606222028268!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>   
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of main -->
    
    <?php require ("include/footer.php") ?>