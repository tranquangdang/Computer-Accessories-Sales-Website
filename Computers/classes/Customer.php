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
        $Pass 		= mysqli_real_escape_string($this->database->link, md5($Pass));

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
        $Pass 	= mysqli_real_escape_string($this->database->link, md5($Pass));

        if (empty($Email) || empty($Pass)) {
            $msg = "<span class='error'>Không được bỏ trống trường nào!</span>";
            return $msg;
        }
        $query = "SELECT * FROM tblCustomer WHERE email = '$Email' AND pass = '$Pass'";
        $result = $this->database->select($query);
        if ($result != false) {
            $value = $result->fetch_assoc();
            Session::set("customerLogin", true);
            Session::set("customerId", $value['CustID']);
            Session::set("customerName", $value['CustName']);
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
            $msg = "<span class='error'>Fields must not be empty!</span>";
            return $msg;
        } else {
            $query = "UPDATE tblCustomer
        	SET
        	CustName 	= '$CustName',
        	CustAddress = '$CustAddress',
        	TelNo 	    = '$TelNo',
        	Email       = '$Email',
        	WHERE CustID = '$CustID'";
            $updated_row = $this->database->update($query);
            if ($updated_row) {
                $msg = "<span class='success'>Cập nhật thành công!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Cập nhật thất bại!</span>";
                return $msg;
            }
        }
    }
}
