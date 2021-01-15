<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 

class Product
{
    private $database;
    private $format;
    private $cart;

    public function __construct()
    {
        $this->database = new Database();
        $this->format = new Format();
        $this->cart = new Cart();
    }

    //Lấy tất cả các sp
    public function getAllProduct()
    {
        $query = "SELECT * FROM tblProduct";
        $result = $this->database->select($query);
        return $result;
    }

    //Lấy sản phẩm theo id
    public function getProById($ProductID)
    {
        $query = "SELECT * FROM tblProduct WHERE ProductId = '$ProductID'";
        $result = $this->database->select($query);
        return $result;
    }

    //Lấy sản phẩm theo danh mục
    public function productByCate($CategoryID)
    {
        $CategoryID  = mysqli_real_escape_string($this->database->link, $CategoryID);
        $query  = "SELECT * from tblProductCategory where CategoryNo in (" . $CategoryID . ")";
        $result = $this->database->select($query);
        return $result;
    }

    //Lấy sản phẩm theo hãng
    public function productByBrand($Brand)
    {
        $Brand  = mysqli_real_escape_string($this->database->link, $Brand);
        $query  = "SELECT * from tblProduct where Brand in (" . $Brand . ")";
        $result = $this->database->select($query);
        return $result;
    }

    //Thêm sp
    public function productInsert($data, $file)
    {
        $CategoryNo = $this->format->validation($data['CategoryNo']);
        $Brand      = $this->format->validation($data['Brand']);
        $ProductName= $this->format->validation($data['ProductName']);
        $Intro      = $this->format->validation($data['Intro']);
        $UnitPrice  = $this->format->validation($data['UnitPrice']);
        $PerDiscount= $this->format->validation($data['PerDiscount']);
        $QtyOnHand  = $this->format->validation($data['QtyOnHand']);

        $CategoryNo = mysqli_real_escape_string($this->database->link, $CategoryNo);
        $Brand      = mysqli_real_escape_string($this->database->link, $Brand);
        $ProductName= mysqli_real_escape_string($this->database->link, $ProductName);
        $Intro      = mysqli_real_escape_string($this->database->link, $Intro);
        $UnitPrice  = mysqli_real_escape_string($this->database->link, $UnitPrice);
        $PerDiscount= mysqli_real_escape_string($this->database->link, $PerDiscount);
        $QtyOnHand  = mysqli_real_escape_string($this->database->link, $QtyOnHand);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['ProductImg']['name'];
        $file_size = $file['ProductImg']['size'];
        $file_temp = $file['ProductImg']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "../images/product/".$unique_image;

        if (empty($file_name)) {
            echo "<span class='error'>Vui lòng chọn hình ảnh !</span>";
        } elseif ($file_size >4048567) {
            echo "<span class='error'>Dung lượng ảnh phải nhỏ hơn 4MB! </span>";
        } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>Bạn chỉ có thể upload các file sau: ".implode(', ', $permited)."</span>";
        } elseif ($CategoryNo == "" || $Brand == "" || $ProductName == "" || $Intro == "" || $UnitPrice == "" || $PerDiscount == "" || $QtyOnHand == "") {
            $msg = "<span class='error'>Chưa điền đầy đủ cho tất cả các trường!</span>";
            return $msg;
        } else if ($QtyOnHand <= 0) {
            $msg = "<span class='error'>Phải lớn hơn 0!</span>";
            return $msg;
        } else if ($UnitPrice < 0 || $PerDiscount < 0) {
            $msg = "<span class='error'>Phải lớn hơn hoặc bằng 0!</span>";
            return $msg;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tblProduct (CategoryNo, Brand, ProductName, ProductImg, Intro, UnitPrice, PerDiscount, QtyOnHand) VALUES('$CategoryNo', '$Brand', '$ProductName', '$uploaded_image', '$Intro', '$UnitPrice', $PerDiscount, '$QtyOnHand')";
            $inserted_row = $this->database->insert($query);
            if ($inserted_row) {
                $msg = "<span class='success'>Thêm sản phẩm thành công!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Thêm sản phẩm không thành công!</span>";
                return $msg;
            }
        }
    }

    //Cập nhật sp
    public function productUpdate($data, $file, $ProductID)
    {
        $CategoryNo = $this->format->validation($data['CategoryNo']);
        $Brand      = $this->format->validation($data['Brand']);
        $ProductName= $this->format->validation($data['ProductName']);
        $Intro      = $this->format->validation($data['Intro']);
        $UnitPrice  = $this->format->validation($data['UnitPrice']);
        $PerDiscount= $this->format->validation($data['PerDiscount']);
        $QtyOnHand  = $this->format->validation($data['QtyOnHand']);

        $CategoryNo = mysqli_real_escape_string($this->database->link, $CategoryNo);
        $Brand      = mysqli_real_escape_string($this->database->link, $Brand);
        $ProductName= mysqli_real_escape_string($this->database->link, $ProductName);
        $Intro      = mysqli_real_escape_string($this->database->link, $Intro);
        $UnitPrice  = mysqli_real_escape_string($this->database->link, $UnitPrice);
        $PerDiscount= mysqli_real_escape_string($this->database->link, $PerDiscount);
        $QtyOnHand  = mysqli_real_escape_string($this->database->link, $QtyOnHand);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['ProductImg']['name'];
        $file_size = $file['ProductImg']['size'];
        $file_temp = $file['ProductImg']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "../images/product/".$unique_image;

        if ($CategoryNo == "" || $Brand == "" || $ProductName == "" || $Intro == "" || $UnitPrice == "" || $PerDiscount == "" ||  $QtyOnHand == "") {
            $msg = "<span class='error'>Chưa điền đầy đủ cho tất cả các trường!</span>";
            return $msg;
        } else if ($QtyOnHand <= 0) {
            $msg = "<span class='error'>Phải lớn hơn 0!</span>";
            return $msg;
        } else if ($UnitPrice < 0 || $PerDiscount < 0) {
            $msg = "<span class='error'>Phải lớn hơn hoặc bằng 0!</span>";
            return $msg;
        } else {
            if (!empty($file_name)) {
                if ($file_size >4048567) {
                    echo "<span class='error'>Dung lượng ảnh phải nhỏ hơn 4MB! </span>";
                } elseif (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'>Bạn chỉ có thể upload các file sau: ".implode(', ', $permited)."</span>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tblProduct
                                SET
                                    CategoryNo ='$CategoryNo',
                                    Brand      ='$Brand',
                                    ProductName='$ProductName',
                                    ProductImg ='$uploaded_image',
                                    Intro      ='$Intro',
                                    UnitPrice  ='$UnitPrice',
                                    PerDiscount = '$PerDiscount',
                                    QtyOnHand  ='$QtyOnHand'
                                WHERE ProductID = '$ProductID'
                                ";
                    $updated_row = $this->database->update($query);
                    if ($updated_row) {
                        $msg = "<span class='success'>Cập nhật thành công!</span>";
                        return $msg;
                    } else {
                        $msg = "<span class='error'>Cập nhật không thành công!</span>";
                        return $msg;
                    }
                }
            } else {
                $query = "UPDATE tblProduct
                                SET
                                    CategoryNo ='$CategoryNo',
                                    Brand      ='$Brand',
                                    ProductName='$ProductName',
                                    Intro      ='$Intro',
                                    UnitPrice  ='$UnitPrice',
                                    PerDiscount = '$PerDiscount',
                                    QtyOnHand  ='$QtyOnHand'
                                WHERE ProductID = '$ProductID'
                                ";
                $updated_row = $this->database->update($query);
                if ($updated_row) {
                    $msg = "<span class='success'>Cập nhật thành công!</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Cập nhật không thành công!</span>";
                    return $msg;
                }
            }
        }
    }

    //Xóa sp
    public function delProById($ProductId)
    {
        $query = "SELECT * FROM tblProduct WHERE ProductID = '$ProductId'";
        $getData = $this->database->select($query);
        if ($getData) {
            while ($delImg = $getData->fetch_assoc()) {
                $dellink = $delImg['ProductImg'];
                if(substr($dellink,0,4) != "http") {
                    unlink($dellink);
                }
            }
        }
        $delquery = "DELETE FROM tblProduct WHERE ProductID = '$ProductId'";
        $deldata = $this->database->delete($delquery);
        if ($deldata) {
            $msg = "<span class='success'>Xóa thành công!</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Xóa không thành công!</span>";
            return $msg;
        }
    }

    public function checkImg($ProductImg)
    {
        if(substr($ProductImg,0,3) == "../"){
            $ProductImg = substr($ProductImg,3);
        }
        return $ProductImg;
    }

    public function DiscountPrice($UnitPrice, $PerDiscount)
    {
        return $UnitPrice - (($UnitPrice * $PerDiscount)/100);
    }

    public function checkType($Type) {
        if ($Type != "") {
            switch ($Type) {
                case 'MAIN':
                    return 'MAIN';
                    break;
                case 'CPU0':
                    return 'CPU0';
                    break;
                case 'RAM0':
                    return 'RAM0';
                    break;
                case 'PSU0':
                    return 'PSU0';
                    break;
                case 'VGA0':
                    return 'VGA0';
                    break;
                case 'COOL':
                    return 'COOL';
                    break;
                case 'CASE':
                    return 'CASE';
                    break;
                case 'HDD0':
                    return 'HDD0';
                    break;
                case 'SSD0':
                    return 'SSD0';
                    break;
                default:
                    return  "";
            }
        }
    }

    public function buildPC($Type,$ProductID) {
        $dot = "'";
        $select = $this->getProById($ProductID);
        if($select) {
            $rows= $select->fetch_assoc();
            $price = $this->DiscountPrice($rows['UnitPrice'],$rows['PerDiscount']);  
        $output = '
        <div style="height: 152px">
            <a href="productdetail.php?ProductID='.$rows["ProductID"].'">
                <img style="width: 150px; height: 150px; float: left; margin: 0 10px" src="'.$this->checkImg($rows["ProductImg"]).'" alt="image" />
                <h4>'.$rows['ProductName'].'</h4>
                <p class="price">₫'.number_format($price).'</p>
            </a>
            <input type="hidden" value="1" class="proid'.$rows["ProductID"].'" data-id="'.$rows["ProductID"].'"/>
            <span>Số lượng: </span><input type="number" name="quantity" class="clp'.$rows["ProductID"].'" data-id="'.$price.'" value="1" onKeyDown="return false" min="1" max="'.$rows["QtyOnHand"].'"/>
            <br><br>
            <span>Tổng tiền: ₫</span><span class="total" id="id'.$rows["ProductID"].'">'.number_format($price).'</span>
            <a  class="btn blackBtn"
            href ="buildpc.php?Action=Remove&Type='.$Type.'"
            style="
                float: right; 
                width: 10%; color: white; 
                padding: 5px; 
                font-size: 11px;
                text-align: center;
            ">
            Xóa
            </a>
        </div>
        <div class="cleaner"></div>
        <script type="text/javascript">
        $(".clp'.$rows["ProductID"].'").on("change keyup click", function() {
            var price = $(this).data("id");
            var quantity = $(this).val();
            
            $("#id'. $rows["ProductID"].'").text(formatMoney(price * quantity));
            $('.$dot.'input[class^="proid'.$rows["ProductID"].'"]'.$dot.').val(quantity);
        });
        </script>';
        }
        return $output;
    }

}
