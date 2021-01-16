<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 


class Customer
{
    private $database;
    private $format;

    public function __construct()
    {
        $this->database = new Database();
        $this->format = new Format();
    }

    //Đăng kí
    public function customerRegistration($data)
    {
        $CustName   = $this->format->validation($data['CustName']);
        $CustAddress= $this->format->validation($data['CustAddress']);
        $TelNo    	= $this->format->validation($data['TelNo']);
        $Email     	= $this->format->validation($data['Email']);
        $Pass   	= $this->format->validation($data['Pass']);
        
        $CustName 	= mysqli_real_escape_string($this->database->link, $CustName);
        $CustAddress= mysqli_real_escape_string($this->database->link, $CustAddress);
        $TelNo 		= mysqli_real_escape_string($this->database->link, $TelNo);
        $Email 		= mysqli_real_escape_string($this->database->link, $Email);
        $Pass 		= mysqli_real_escape_string($this->database->link, $Pass);

        if ($CustName == "" || $CustAddress == "" || $TelNo == "" || $Email == "" || $Pass == "" ) {
            $msg = "<span class='error'>Không được bỏ trống trường nào!</span>";
            return $msg;
        }
        $mailquery = "SELECT * FROM tblCustomer WHERE Email = '$Email' LIMIT 1";
        $mailchk = $this->database->select($mailquery);
        if ($mailchk != false) {
            $msg = "<span class='error'>Email này đã được sử dụng trước đó!</span>";
            return $msg;
        } else {
            $Pass = md5($Pass);
            $query = "INSERT INTO tblCustomer (CustName, CustAddress, TelNo, Email, Pass) VALUES('$CustName', '$CustAddress', '$TelNo', '$Email', '$Pass')";
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

    //Đăng nhập
    public function customerLogin($data)
    {
        $Email 	= $this->format->validation($data['Email']);
        $Pass  	= $this->format->validation($data['Pass']);

        $Email 	= mysqli_real_escape_string($this->database->link, $Email);
        $Pass 	= mysqli_real_escape_string($this->database->link, $Pass);

        if (empty($Email) || empty($Pass)) {
            $msg = "<span class='error'>Không được bỏ trống trường nào!</span>";
            return $msg;
        }
        $Pass = md5($Pass);
        $query = "SELECT * FROM tblCustomer WHERE email = '$Email' AND pass = '$Pass'";
        $result = $this->database->select($query);
        if ($result != false) {
            $value = $result->fetch_assoc();
            Session::set("customerId", $value['CustID']);
            header("Location:index.php");
        } else {
            $msg = "<span class='error'>Sai tài khoản hoặc mật khẩu</span>";
            return $msg;
        }
    }

    //Lấy thông tin khách
    public function getCustomerData($CustID)
    {
        $query = "SELECT * FROM tblCustomer WHERE CustID = '$CustID'";
        $result = $this->database->select($query);
        return $result;
    }

    //Cập nhật thông tin khách
    public function customerUpdate($data, $CustID)
    {
        $CustName   = $this->format->validation($data['CustName']);
        $CustAddress= $this->format->validation($data['CustAddress']);
        $TelNo    	= $this->format->validation($data['TelNo']);
        $Email     	= $this->format->validation($data['Email']);
        
        $CustName 	= mysqli_real_escape_string($this->database->link, $CustName);
        $CustAddress= mysqli_real_escape_string($this->database->link, $CustAddress);
        $TelNo 		= mysqli_real_escape_string($this->database->link, $TelNo);
        $Email 		= mysqli_real_escape_string($this->database->link, $Email);

        if ($CustName == "" || $CustAddress == "" || $TelNo == "" || $Email == "" ) {
            $msg = "<span class='error'>Không được bỏ trống trường nào!</span>";
            return $msg;
        } else {
            $query = "UPDATE tblCustomer
        	SET
        	CustName 	= '$CustName',
        	CustAddress = '$CustAddress',
        	TelNo 	    = '$TelNo',
        	Email       = '$Email'
        	WHERE CustID = $CustID";
            $updated_row = $this->database->update($query);
            if (!$updated_row) {
                $msg = "<span class='success'>Cập nhật thành công! </span>";
            }
            $msg = "<span class='success'>Cập nhật thành công! </span>";
        }
        return $msg;
    }

    public function customerResetPassword($data, $CustID){
        $OldPass   = $this->format->validation($data['OldPass']);
        $NewPass= $this->format->validation($data['NewPass']);
        $ConfirmPass= $this->format->validation($data['ConfirmPass']);

        $OldPass 	= mysqli_real_escape_string($this->database->link, $OldPass);
        $NewPass 	= mysqli_real_escape_string($this->database->link, $NewPass);
        $ConfirmPass= mysqli_real_escape_string($this->database->link, $ConfirmPass);

        if($OldPass == "" || $NewPass == "" || $ConfirmPass == ""){
            $msg = "<span class='error'>Không được bỏ trống trường nào!</span>";
        } else if ($NewPass != $ConfirmPass) {
            $msg = "<span class='error'>Mật khẩu nhập lại không khớp! Vui lòng kiểm tra lại!</span>";
        } else if ($OldPass == $NewPass) {
            $msg = "<span class='error'>Mật khẩu cũ và mật khẩu mới không được giống nhau!</span>";
        } else  {
            $OldPass = md5($OldPass);
            $query = "SELECT * FROM tblCustomer WHERE CustID = '$CustID' AND Pass = '$OldPass'";
            $checkpass = $this->database->select($query);
            if($checkpass) {
                $NewPass = md5($NewPass);
                $query = "UPDATE tblCustomer
                SET
                Pass 	= '$NewPass'
                WHERE CustID = $CustID";
                $updated_row = $this->database->update($query);
                $msg = "<span class='success'>Cập nhật thành công! </span>";
                if (!$updated_row) {
                    $msg = "<span class='error'>Lỗi!</span>";
                }
            } else {
                $msg = "<span class='error'>Sai mật khẩu! Vui lòng kiểm tra lại!</span>";
            }
        }
        return $msg;
    }

    public function getAllCus()
    {
        $query = "SELECT * FROM tblCustomer ORDER BY CustID DESC";
        $result = $this->database->select($query);
        return $result;
    }

    public function delCusById($id)
    {
        $id = $this->format->validation($id);
        $id = mysqli_real_escape_string($this->database->link, $id);
        $query = "DELETE FROM tblCustomer WHERE CustID = '$id'";
        $deldata = $this->database->delete($query);
        if ($deldata) {
            $msg = "<span class='success'>Thành công</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Thất bại!</span>";
            return $msg;
        }
    }
}
