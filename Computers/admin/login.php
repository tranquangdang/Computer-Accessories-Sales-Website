<?php include '../classes/Adminlogin.php' ?>
<?php 
$admin = new Adminlogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $AdminUser = $_POST['AdminUser'];
    $AdminPass = md5($_POST['AdminPass']);

    $loginChk= $admin->adminLogin($AdminUser, $AdminPass);
}


 ?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Quản trị viên</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Quản trị viên</h1>
				<span style="color:red; font-size:18px;">
			</span>
			<div>
				<input type="text" placeholder="Tài khoản" name="AdminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Mật khẩu" name="AdminPass"/>
			</div>
			<div>
				<input type="submit" value="Đăng nhập" />
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
