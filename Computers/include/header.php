<?php require "include/topheader.php"; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Website Đăng Trường</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

<div id="body_wrapper">
<div id="wrapper">

	<div id="header">
    	<div id="site_title"><h1><a href="index.php">Đăng Trường Computers</a></h1></div>
        <div id="header_right">
        	<p>
            <?php
                if (isset($_GET['CustID'])) {
                    Session::destroy();
                }
                    if (!Session::get('customerId')) { ?>
                    <a href="login.php">Đăng nhập/Đăng kí</a>
                <?php   } else { ?>
                    <a href="profile.php">Tài khoản</a> | 
                    <a href="orderdetails.php">Đơn hàng</a> | 
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
    </div> <!-- END of header -->
    
    <div id="menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a class="visited" href="index.php">Trang chủ</a></li>
                <li><a href="products.php">Sản phẩm</a>
                    <ul>
                        <li><a href="#submenu1">PC - Máy tính bộ</a>
                            <ul>
                                <li><a href="#submenu1">Văn phòng</a></li>
                                <li><a href="#submenu2">Gaming</a></li>
                            </ul>
                        </li>
                        <li><a href="#submenu2">Laptop</a></li>
                        <li><a href="#submenu3">Link kiện cũ</a></li>
                    </ul>
                </li>
                <li><a href="contact.php">Liên hệ</a>
                    <ul>
                        <li><a href="#submenu1">Thông tin</a></li>
                    </ul>
                </li>
                <li><a href="#">Xây dựng cấu hình</a></li>
                <li><a href="about.php">Về chúng tôi</a></li>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="search">
            <form action="products.php" method="get">
              <input type="text" value="" name="Keyword" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
              <input type="submit" name="" value="" alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
    </div> <!-- END of menubar -->
    
    <div id="main">
    	