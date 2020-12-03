<?php
$filepath = realpath(dirname(__FILE__));
include($filepath.'/../lib/Session.php');
Session::checkLogin();
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 


class Adminlogin
{
    private $database;
    private $format;

    public function __construct()
    {
        $this->database = new Database();
        $this->format = new Format();
    }

    public function adminLogin($AdminUser, $AdminPass)
    {
        $AdminUser = $this->format->validation($AdminUser);
        $AdminPass = $this->format->validation($AdminPass);
        $AdminUser = mysqli_real_escape_string($this->database->link, $AdminUser);
        $AdminPass = mysqli_real_escape_string($this->database->link, $AdminPass);

        if (empty($AdminUser) || empty($AdminPass)) {
            $loginmsg = "Tài khoản và mật khẩu không được để trống!";
            return $loginmsg;
        } else {
            $query = "SELECT * FROM tblAdmin WHERE AdminUser = '$AdminUser' AND AdminPass = '$AdminPass'";
            $result = $this->database->select($query);
            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set("adminlogin", true);
                Session::set("adminId", $value['AdminId']);
                Session::set("adminUser", $value['AdminUser']);
                Session::set("adminName", $value['AdminName']);
                Session::set("lavel", $value['AdminLevel']);
                header("Location:dashboard.php");
            } else {
                echo "<script language='javascript'>alert('Sai tài khoản hoặc mật khẩu');";
                echo "location.href='login.php';</script>";
            }
        }
    }
}
