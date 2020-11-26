<?php session_start(); ?>
<?php  include("connect.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Website Đăng Trường</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js"></script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "top_nav", 
	orientation: 'h', 
	classname: 'ddsmoothmenu', 
	contentsource: "markup" 
})

</script>

</head>

<body>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1><a href="index.php">Đăng Trường Computers</a></h1></div>
        <div id="header_right">
        	<p>
	        <a href="#">Tài khoản</a> | <a href="#">Yêu thích</a> | <a href="#">Đăng nhập / Đăng ký</a></p>
            <p>
            	Giỏ hàng: <strong>3 sản phẩm</strong> ( <a href="shoppingcart.php" style="color: red"><b>Xem</b></a> )
			</p>
		</div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="products.php">Sản phẩm</a>
                    <ul>
                        <li><a href="#submenu1">Linh kiện mới</a></li>
                        <li><a href="#submenu2">Linh kiện cũ</a></li>
                        <li><a href="#submenu3">Sản phẩm khác</a></li>
                    </ul>
                </li>
                <li><a href="contact.php">Liên hệ</a>
                    <ul>
                        <li><a href="#submenu1">Thông tin</a></li>
                    </ul>
                </li>
                <li><a href="faqs.php">Tuyển dụng</a></li>
                <li><a href="about.php">Về chúng tôi</a></li>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="templatemo_search">
            <form action="#" method="get">
              <input type="text" value=" " name="keyword" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
              <input type="submit" name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
    </div> <!-- END of templatemo_menubar -->
    
    <div id="templatemo_main">
    	<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Sản phẩm chính</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                        <li><a href="products.php">CPU - Bộ vi xử lý</a></li>
                        <li><a href="products.php">VGA - Card màn hình</a></li>
                        <li><a href="products.php">Mainboard - Bo mạch chủ</a></li>
                        <li><a href="products.php">Ram - Bộ nhớ trong</a></li>
                        <li><a href="products.php">Ổ cứng</a></li>
                        <li><a href="products.php">PSU - Nguồn máy tính</a></li>
                        <li><a href="products.php">Tản nhiệt</a></li>
                        <li><a href="products.php">Case - Thùng máy tính</a></li>
                        <li><a href="products.php">Khác</a></li>
                    </ul>
                </div>
            </div>
            <div class="sidebar_box"><span class="bottom"></span>
            	<h3>Bán chạy nhất </h3>   
                <div class="content"> 
                	<div class="bs_box">
                    	<a href="#"><img src="images/product/01.webp" alt="image" /></a>
                        <h4><a href="#">Tản nước AIO ASUS ROG RYUJIN 360</a></h4>
                        <p class="price">₫7.490.000</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/product/02.webp" alt="image" /></a>
                        <h4><a href="#">Mainboard ASUS EX-B365M-V5</a></h4>
                        <p class="price">₫2.500.000</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/product/03.webp" alt="image" /></a>
                        <h4><a href="#">Quạt Case Cooler Master Masterfan SF360R ARGB</a></h4>
                        <p class="price">₫1.195.000</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/product/04.webp" alt="image" /></a>
                        <h4><a href="#">Card màn hình NVIDIA Quadro P2200 5GB GDDR5X</a></h4>
                        <p class="price">₫11.299.000</p>
                        <div class="cleaner"></div>
                    </div>
                </div>
            </div>
        </div>