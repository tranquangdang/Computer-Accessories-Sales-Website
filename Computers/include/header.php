<?php 
include 'lib/Session.php';
Session::init();
include 'lib/Database.php';
include 'helpers/Format.php';

spl_autoload_register(function ($class) {
    include_once "classes/".$class.".php";
});
$database = new Database();
$format = new Format();
$product = new Product();
$cart = new Cart();
$category = new Category();
$customer = new Customer(); ?>

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
            <a href="profile.php">Tài khoản</a> | <a href="#">Yêu thích</a> | 
            <?php
                if (isset($_GET['CustID'])) {
                    Session::destroy();
                }
                    if (!Session::get('customerId')) { ?>
                    <a href="login.php">Đăng nhập/Đăng kí</a>
                <?php   } else { ?>
                    <a href="?CustID=<?php Session::get('customerId');?>">Đăng xuất</a>
                <?php   } ?>
            </p>
            <p> 
            <?php 
                if(Session::get('customerId')){
                    $getData = $cart->checkCartItem();
                    if ($getData) {
                        $sum = $cart->getTotalMoney();
                        $qty = $cart->getQty();
                        echo "Giỏ hàng: ₫".number_format($sum)." | <strong>".$qty.' sản phẩm</strong> ( <a href="shoppingcart.php" style="color: red"><b>Xem</b></a> )';

                    } else {
                        echo 'Giỏ hàng rỗng';
                    }
                } else {
                    echo 'Đăng nhập để mua hàng';
                }
            ?>
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
    	