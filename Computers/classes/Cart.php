<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 


class Cart
{
    private $database;
    private $format;

    public function __construct()
    {
        $this->database = new Database();
        $this->format = new Format();
    }

    //Tính tổng tiền giỏ hàng, hóa đơn
    public function getTotalMoney() {
        //Lấy ra id giỏ hàng
        $CustNo = Session::get('customerId');
        $select = "SELECT * FROM tblCart WHERE CustNo = '$CustNo'";
        $getCustNo = $this->database->select($select);
        while( ($rows = $getCustNo->fetch_assoc()) != NULL ) {$CartID = $rows['CartID'];}
        //Lấy ra bảng chi tiết giỏ hàng của khách hàng
        $query = "SELECT * FROM tblProduct, tblCartDetail, tblCart WHERE 
        tblCart.CustNo ='$CustNo' AND tblCartDetail.CartID = '$CartID' AND tblCartDetail.ProductID = tblProduct.ProductID";
        $getQtyOrdered = $this->database->select($query);
        $Amount = 0;
        $OrderTotalMoney = 0;
        //Duyệt và tính tổng tiền
        while( ($rows = $getQtyOrdered->fetch_assoc()) != NULL ) {
            $Amount = $rows['UnitPrice']*$rows['QtyOrdered'];
            $OrderTotalMoney += $Amount;
        }
        return $OrderTotalMoney;
    }
    
    //Tính tổng món hàng
    public function getQty() {
        //Lấy ra id giỏ hàng
        $CustNo = Session::get('customerId');
        $select = "SELECT * FROM tblCart WHERE CustNo = '$CustNo'";
        $getCustNo = $this->database->select($select);
        while( ($rows = $getCustNo->fetch_assoc()) != NULL ) {$CartID = $rows['CartID'];}
        //Đếm các sản phẩm trong chi tiết giỏ hàng
        $query = "SELECT * FROM tblProduct, tblCartDetail, tblCart WHERE 
        tblCart.CustNo ='$CustNo' AND tblCartDetail.CartID = '$CartID' AND tblCartDetail.ProductID = tblProduct.ProductID";
        $result = mysqli_num_rows($this->database->select($query));
        return $result;
    }

    public function addToCart($QtyOrdered, $ProductID)
    {
        $QtyOrdered = $this->format->validation($QtyOrdered);
        $QtyOrdered = mysqli_real_escape_string($this->database->link, $QtyOrdered);
        $ProductID = mysqli_real_escape_string($this->database->link, $ProductID);
        $CustNo = Session::get('customerId');

        //Coi khách hàng có giỏ chưa
        $select = "SELECT * FROM tblCart WHERE CustNo = '$CustNo'";
        $getCustNo = $this->database->select($select);

        //Nếu chưa tồn tại giỏ hàng, tạo mới 1 giỏ
        if(!$getCustNo) {
            $query = "INSERT INTO tblCart(CustNo) VALUES ($CustNo)";
            $creatCart = $this->database->insert($query);
        }
        
        //Nếu có rồi thì lấy ra ID giỏ hàng
        $select = "SELECT * FROM tblCart WHERE CustNo = '$CustNo'";
        $getCustNo = $this->database->select($select);
        while( ($rows = $getCustNo->fetch_assoc()) != NULL ) {$CartID = $rows['CartID'];}

        //Kiểm tra xem sản phẩm đó đã có trong giỏ hàng hay chưa
        $chquery = "SELECT tblCartDetail.* FROM tblCartDetail, tblCart WHERE 
        tblCartDetail.ProductID = '$ProductID' AND tblCartDetail.CartID = '$CartID' AND tblCartDetail.CartID = tblCart.CartID";
        $getPro = $this->database->select($chquery);

        //Nếu sản phẩm đó đã có, tăng số lượng thêm 1
        if ($getPro) {
            //Lấy ra số lượng sản phẩm sẽ tăng
            $select = "SELECT QtyOrdered FROM tblCartDetail WHERE CartID = '$CartID' AND ProductID = '$ProductID' ";
            $getQtyOrdered = $this->database->select($select);
            while( ($row = $getQtyOrdered->fetch_assoc()) != NULL ) {$QtyOrdered = $row['QtyOrdered'];}
            //Tăng lên 1 rồi cập nhật
            $QtyOrdered++;
            $query = "UPDATE tblCartDetail
                SET
                QtyOrdered = $QtyOrdered
                WHERE CartID = '$CartID' AND ProductID = '$ProductID' ";
            $updated_row = $this->database->update($query);
            header("Location:shoppingcart.php");
        } else {
            //Nếu chưa có thì chèn vô bảng chi tiết giỏ hàng
            $query = "INSERT INTO tblCartDetail (CartID, ProductID, QtyOrdered) VALUES ($CartID, $ProductID, $QtyOrdered)";
            $inserted_row = $this->database->insert($query);
            if ($inserted_row) {
                header("Location:shoppingcart.php");
            } else {
                header("Location:404.php");
            }
        }
    }

    //Lấy thông tin sản phẩm trong giỏ hàng
    public function getCartProduct($CartID)
    {
        $query = "SELECT * FROM tblProduct, tblCartDetail WHERE 
        tblCartDetail.CartID = $CartID AND tblCartDetail.ProductID = tblProduct.ProductID";
        $result = $this->database->select($query);
        return $result;
    }


    //Cập nhật số lượng giỏ hàng
    public function updateCartQuantity($CartID, $ProductID, $QtyOrdered)
    {
        $CartID    = mysqli_real_escape_string($this->database->link, $CartID);
        $ProductID = mysqli_real_escape_string($this->database->link, $ProductID);
        $QtyOrdered= mysqli_real_escape_string($this->database->link, $QtyOrdered);
        $query = "UPDATE tblCartDetail
            SET
            QtyOrdered = $QtyOrdered
            WHERE CartID = '$CartID' AND ProductID = '$ProductID' ";
        $updated_row = $this->database->update($query);
        if ($updated_row) {
            header("Location:shoppingcart.php");
        } else {
            $msg = "<span class='error'>Quantity Not Updated.</span>";
            return $msg;
        }
    }

    //Xóa sản phẩm trong giỏ hàng
    public function delProductByCart($CartID,$ProductID)
    {
        $CartID   = mysqli_real_escape_string($this->database->link, $CartID);
        $ProductID= mysqli_real_escape_string($this->database->link, $ProductID);
        $query = "DELETE FROM tblCartDetail WHERE CartID = '$CartID' AND ProductID = '$ProductID'";
        $deldata = $this->database->delete($query);
        if ($deldata) {
            echo "<script> window.location = 'shoppingcart.php'; </script>";
        }
    }

    public function checkCartItem()
    {
        $CustNo = Session::get('customerId');
        $query = "SELECT * FROM tblCartDetail,tblCart WHERE tblCartDetail.CartID = tblCart.CartID AND tblCart.CustNo = '$CustNo'";
        $result = $this->database->select($query);
        return $result;
    }

/*
    public function orderProduct($CustomerID)
    {
        $SessionId = session_id();
        $query = "SELECT * FROM tblCart WHERE SessionId = '$SessionId'";
        $createOrder = $this->database->select($query);

        $query = "SELECT * FROM tblCart WHERE SessionId = '$SessionId'";
        $getPro = $this->database->select($query);
        if ($getPro) {
            while ($result = $getPro->fetch_assoc()) {
                $ProductID      = $result['ProductID'];
                $OrderAddress    = $result['OrderAddress'];
                $OrderTotalMoney       = $result['OrderTotalMoney'];
                $TelNo          = $result['price'] * $quantity;
                $CustNo          = $result['image'];

                $query = "INSERT INTO tbl_order(cmrId, productId, productName, quantity, price, image) VALUES('$cmrId', '$productId', '$productName', '$quantity', '$price', '$image')";
                $inserted_row = $this->database->insert($query);
            }
        }
    }

    public function payableAmount($cmrId)
    {
        $query = "SELECT price FROM tbl_order WHERE cmrId = '$cmrId' AND date = now()";
        $result = $this->database->select($query);
        return $result;
    }

    public function getOrderProduct($cmrId)
    {
        $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ORDER BY date DESC";
        $result = $this->database->select($query);
        return $result;
    }

    public function checkOrder($cmrId)
    {
        $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId'";
        $result = $this->database->select($query);
        return $result;
    }

    public function getAllOrderProduct()
    {
        $query = "SELECT * FROM tbl_order ORDER BY date DESC";
        $result = $this->database->select($query);
        return $result;
    }

    public function productShifted($id, $time, $price)
    {
        $id     = mysqli_real_escape_string($this->database->link, $id);
        $time   = mysqli_real_escape_string($this->database->link, $time);
        $price  = mysqli_real_escape_string($this->database->link, $price);

        $query = "UPDATE tbl_order
            SET
            status = '1'
            WHERE cmrId = '$id' AND date = '$time' AND price = '$price'";
        $updated_row = $this->database->update($query);
        if ($updated_row) {
            $msg = "<span class='success'>Updated Successfully</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Not Updated.</span>";
            return $msg;
        }
    }

    public function delProductShifted($id, $time, $price)
    {
        $id     = mysqli_real_escape_string($this->database->link, $id);
        $time   = mysqli_real_escape_string($this->database->link, $time);
        $price  = mysqli_real_escape_string($this->database->link, $price);

        $query = "DELETE FROM tbl_order WHERE cmrId = '$id' AND date = '$time' AND price = '$price'";
        $deldata = $this->database->delete($query);
        if ($deldata) {
            $msg = "<span class='success'>Data Deleted Successfully</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Data Not Deleted!</span>";
            return $msg;
        }
    }

    public function productShiftConfirm($id, $time, $price)
    {
        $id     = mysqli_real_escape_string($this->database->link, $id);
        $time   = mysqli_real_escape_string($this->database->link, $time);
        $price  = mysqli_real_escape_string($this->database->link, $price);

        $query = "UPDATE tbl_order
            SET
            status = '2'
            WHERE cmrId = '$id' AND date = '$time' AND price = '$price'";
        $updated_row = $this->database->update($query);
        if ($updated_row) {
            $msg = "<span class='success'>Updated Successfully</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Not Updated.</span>";
            return $msg;
        }
    }*/
}
