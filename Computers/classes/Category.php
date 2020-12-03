<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 


class Category
{
    private $database;
    private $format;

    public function __construct()
    {
        $this->database = new Database();
        $this->format = new Format();
    }

    public function catInsert($catName)
    {
        $catName = $this->format->validation($catName);
        $catName = mysqli_real_escape_string($this->database->link, $catName);
        if (empty($catName)) {
            $msg = "<span class='error'>Không được để trống!</span>";
            return $msg;
        } else {
            $query = "INSERT INTO tblProductCategory (CategoryName) VALUES('$catName')";
            $catinsert = $this->database->insert($query);
            if ($catinsert) {
                $msg = "<span class='success'>Thành công!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Thất bại</span>";
                return $msg;
            }
        }
    }

    public function getAllCat()
    {
        $query = "SELECT * FROM tblProductCategory ORDER BY CategoryID DESC";
        $result = $this->database->select($query);
        return $result;
    }

    public function getCatById($catid)
    {
        $query = "SELECT * FROM tblProductCategory WHERE CategoryID = '$catid'";
        $result = $this->database->select($query);
        return $result;
    }

    public function catUpdate($catName, $catid)
    {
        $catName = $this->format->validation($catName);
        $catName = mysqli_real_escape_string($this->database->link, $catName);
        $catid = mysqli_real_escape_string($this->database->link, $catid);
        if (empty($catName)) {
            $msg = "<span class='error'>Không được để trống!</span>";
            return $msg;
        } else {
            $query = "UPDATE tblProductCategory
        	SET
        	CategoryName = '$catName'
        	WHERE CategoryID = '$catid'";
            $updated_row = $this->database->update($query);
            if ($updated_row) {
                $msg = "<span class='success'>Thành công!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Thất bại!</span>";
                return $msg;
            }
        }
    }
    public function delCatById($id)
    {
        $query = "DELETE FROM tblProductCategory WHERE CategoryID = '$id'";
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
