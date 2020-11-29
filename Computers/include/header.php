<?php session_start(); ?>
<?php  include("connect.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Website Đăng Trường</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />

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

ddsmoothmenu.init({
	mainmenuid: "sidebar", 
	orientation: 'h', 
	classname: 'ddsmoothmenuvertical', 
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
                <li><a class="visited" href="index.php">Trang chủ</a></li>
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
                <div id="sidebar" class="content ddsmoothmenuvertical"> 
                	<ul class="sidebar_list">
                        <li><a href="products.php?CategoryNo='CPU01','CPU02'">CPU - Bộ vi xử lý</a>
                            <ul>
                                <li><a href="products.php?CategoryNo='CPU02'">CPU Intel</a></li>
                                <li><a href="products.php?CategoryNo='CPU01'">CPU AMD</a></li>
                            </ul>
                        </li>
                        <li><a href="products.php?CategoryNo='VGA01','VGA02'">VGA - Card màn hình</a>
                            <ul>
                                <li><a href="products.php?CategoryNo='VGA01'">VGA Nividia</a></li>
                                <li><a href="products.php?CategoryNo='VGA02'">VGA AMD</a></li>
                            </ul>
                        </li>
                        <li><a href="products.php?CategoryNo='MAIN1','MAIN2'">Mainboard - Bo mạch chủ</a>
                            <ul>
                                <li><a href="products.php?CategoryNo='MAIN1'">Mainboard Intel</a></li>
                                <li><a href="products.php?CategoryNo='MAIN2'">Mainboard AMD</a></li>
                            </ul>
                        </li>
                        <li><a href="products.php?CategoryNo='RAM01'">Ram - Bộ nhớ trong</a></li>
                        <li><a href="products.php?CategoryNo='HDD01','SSD01'">Ổ cứng</a>
                            <ul>
                                <li><a href="products.php?CategoryNo='HDD01'">Ổ cứng HDD</a></li>
                                <li><a href="products.php?CategoryNo='SSD01'">Ổ cứng SSD</a></li>
                            </ul>
                        </li>
                        <li><a href="products.php?CategoryNo='PSU01'">PSU - Nguồn máy tính</a></li>
                        <li><a href="products.php?CategoryNo='COOL1'">Tản nhiệt</a></li>
                        <li><a href="products.php?CategoryNo='CASE1'">Case - Thùng máy tính</a></li>
                        <li><a href="products.php">Khác</a>
                            <ul>
                                <li><a href="#submenu1">PC - Máy tính bộ</a>
                                    <ul>
                                        <li><a href="#submenu1">Văn phòng</a></li>
                                        <li><a href="#submenu2">Gaming</a></li>
                                    </ul>
                                </li>
                                <li><a href="#submenu2">Laptop</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sidebar_box"><span class="bottom"></span>
            	<h3>Bán chạy nhất </h3>   
                <div class="content"> 
                    <?php 
                    $sql= "select * from tblProduct";
                    $results = mysqli_query($connect,$sql);
                    $count = 0;
                    while( ($rows = mysqli_fetch_assoc($results)) != NULL && $count < 5 ) { $count++;?>
                    <div class="bs_box">
                        <a href="productdetail.php?ProductID=<?php echo $rows['ProductID']; ?>"><img src="<?php echo $rows['ProductImg']; ?>" alt="image" /></a>
                        <h4><a href="productdetail.php?ProductID=<?php echo $rows['ProductID']; ?>"><?php echo $rows['ProductName']; ?></a></h4>
                        <p class="price">₫<?php echo number_format($rows['UnitPrice']); ?></p>
                        <div class="cleaner"></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>