<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Session.php');
Session::init();
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 


class Admin
{
    private $database;
    private $format;

    public function __construct()
    {
        $this->database = new Database();
        $this->format = new Format();
    }

    public function adminRegistration($data)
    {
        $AdminUser = $this->format->validation($data['AdminUser']);
        $AdminPass = $this->format->validation($data['AdminPass']);
        $AdminName = $this->format->validation($data['AdminName']);
        $AdminLevel = $this->format->validation($data['AdminLevel']);
        
        $AdminLevel = mysqli_real_escape_string($this->database->link, $AdminLevel);
        $AdminName = mysqli_real_escape_string($this->database->link, $AdminName);
        $AdminUser = mysqli_real_escape_string($this->database->link, $AdminUser);
        $AdminPass = mysqli_real_escape_string($this->database->link, $AdminPass);

        if ($AdminUser == "" || $AdminPass == "" || $AdminName == "" || $AdminLevel == "") {
            $msg = "<span class='error'>Không được bỏ trống trường nào!</span>";
            return $msg;
        }
        $userquery = "SELECT * FROM tblAdmin WHERE AdminUser = '$AdminUser' LIMIT 1";
        $userchk = $this->database->select($userquery);
        if ($userchk != false) {
            $msg = "<span class='error'>User này đã được sử dụng trước đó!</span>";
            return $msg;
        } else {
            $AdminPass = md5($AdminPass);
            $query = "INSERT INTO tblAdmin (AdminName ,AdminUser, AdminPass, AdminLevel) VALUES('$AdminName', '$AdminUser', '$AdminPass', $AdminLevel)";
            $inserted_row = $this->database->insert($query);
            if ($inserted_row) {
                $msg = "<span class='success'>Đăng ký thành công!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Đăng ký không thành công!</span>";
                return $msg;
            }
        }
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
            $AdminPass = md5($AdminPass);
            $query = "SELECT * FROM tblAdmin WHERE AdminUser = '$AdminUser' AND AdminPass = '$AdminPass'";
            $result = $this->database->select($query);
            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set("adminlogin", true);
                Session::set("adminId", $value['AdminID']);
                Session::set("adminUser", $value['AdminUser']);
                Session::set("adminName", $value['AdminName']);
                Session::set("level", $value['AdminLevel']);
                header("Location:dashboard.php");
            } else {
                echo "<script language='javascript'>alert('Sai tài khoản hoặc mật khẩu');";
                echo "location.href='login.php';</script>";
            }
        }
    }

    public function adminUpdate($data, $AdminID)
    {
        $AdminUser = $this->format->validation($data['AdminUser']);
        $AdminPass = $this->format->validation($data['AdminPass']);
        $AdminName = $this->format->validation($data['AdminName']);
        $AdminLevel = $this->format->validation($data['AdminLevel']);
        
        $AdminLevel = mysqli_real_escape_string($this->database->link, $AdminLevel);
        $AdminName = mysqli_real_escape_string($this->database->link, $AdminName);
        $AdminUser = mysqli_real_escape_string($this->database->link, $AdminUser);
        $AdminPass = mysqli_real_escape_string($this->database->link, $AdminPass);
        if ($AdminUser == "" || $AdminPass == "" || $AdminName == "" || $AdminLevel == "") {
            $msg = "<span class='error'>Không được bỏ trống trường nào!</span>";
            return $msg;
        } else {
            $AdminPass = md5($AdminPass);
            $query = "UPDATE tblAdmin
        	SET
            AdminName 	= '$AdminName',
        	AdminUser 	= '$AdminUser',
        	AdminPass   = '$AdminPass',
            AdminLevel  = '$AdminLevel'
        	WHERE AdminID = $AdminID";
            $updated_row = $this->database->update($query);
            if (!$updated_row) {
                $msg = "<span class='success'>Cập nhật thành công! </span>";
            }
            $msg = "<span class='success'>Cập nhật thành công! </span>";
        }
        return $msg;
    }

    public function delAdminById($id)
    {
        $id = $this->format->validation($id);
        $id = mysqli_real_escape_string($this->database->link, $id);
        $query = "DELETE FROM tblAdmin WHERE AdminID = '$id'";
        $deldata = $this->database->delete($query);
        if ($deldata) {
            $msg = "<span class='success'>Thành công</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Thất bại!</span>";
            return $msg;
        }
    }

    public function getAllAdmin()
    {
        $query = "SELECT * FROM tblAdmin ORDER BY AdminID DESC";
        $result = $this->database->select($query);
        return $result;
    }

    public function getAdminData($AdminID)
    {
        $query = "SELECT * FROM tblAdmin WHERE AdminID = '$AdminID'";
        $result = $this->database->select($query);
        return $result;
    }
}
