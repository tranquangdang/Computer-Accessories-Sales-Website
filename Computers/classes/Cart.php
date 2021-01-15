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
        if($this->getCartProduct($CartID)){
            while( ($rows = $getQtyOrdered->fetch_assoc()) != NULL ) {
                $Amount = ($rows['UnitPrice'] - (($rows['UnitPrice'] * $rows['PerDiscount'])/100))*$rows['QtyOrdered'];
                $OrderTotalMoney += $Amount;
            }
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
        $select = $this->database->select($query);
        if(!$select) {
            $result = 0;
        } else {
            $result = mysqli_num_rows($select);
        }
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
            $new = $QtyOrdered;
            //Lấy ra số lượng sản phẩm sẽ tăng
            $select = "SELECT QtyOrdered FROM tblCartDetail WHERE CartID = '$CartID' AND ProductID = '$ProductID' ";
            $getQtyOrdered = $this->database->select($select);
            while( ($row = $getQtyOrdered->fetch_assoc()) != NULL ) {$old = $row['QtyOrdered'];}
            //Tăng lên 1 rồi cập nhật
            $QtyOrdered = $old + $new;
            $query = "UPDATE tblCartDetail
                SET
                QtyOrdered = $QtyOrdered
                WHERE CartID = '$CartID' AND ProductID = '$ProductID' ";
            $updated_row = $this->database->update($query);
            if ($updated_row) {
                header("Location:shoppingcart.php");
            } else {
                echo "<script language='javascript'>alert('Lỗi')</script>";
            }
        } else {
            //Nếu chưa có thì chèn vô bảng chi tiết giỏ hàng
            $query = "INSERT INTO tblCartDetail (CartID, ProductID, QtyOrdered) VALUES ($CartID, $ProductID, $QtyOrdered)";
            $inserted_row = $this->database->insert($query);
            if ($inserted_row) {
                header("Location:shoppingcart.php");
            } else {
                echo "<script language='javascript'>alert('Lỗi')</script>";
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
            echo "<script language='javascript'>alert('Lỗi')</script>";
        }
    }

    //Xóa sản phẩm trong giỏ hàng
    public function delProductByCart($CartID,$ProductID)
    {
        $CartID   = mysqli_real_escape_string($this->database->link, $CartID);
        $ProductID= mysqli_real_escape_string($this->database->link, $ProductID);
        $query = "DELETE FROM tblCartDetail WHERE CartID = '$CartID' AND ProductID = '$ProductID'";
        $deldata = $this->database->delete($query);
        if(!$this->getCartProduct($CartID)){
            header("Location:index.php");
        }
        if ($deldata) {
            echo "<script> window.location = 'shoppingcart.php'; </script>";
        } else {
            echo "<script language='javascript'>alert('Lỗi');</script>";
        }
    }

    public function delCustomerCart()
    {
        $CustNo = Session::get('customerId');
        $select = "SELECT * FROM tblCart WHERE CustNo = '$CustNo'";
        $getCustNo = $this->database->select($select);
        while( ($rows = $getCustNo->fetch_assoc()) != NULL ) {$CartID = $rows['CartID'];}
        $query = "DELETE FROM tblCartDetail WHERE CartID = '$CartID'";
        $this->database->delete($query);
    }

    public function checkCartItem()
    {
        $CustNo = Session::get('customerId');
        $query = "SELECT * FROM tblCartDetail,tblCart WHERE tblCartDetail.CartID = tblCart.CartID AND tblCart.CustNo = '$CustNo'";
        $result = $this->database->select($query);
        return $result;
    }


    public function orderProduct($CustID,$OrderTotalMoney)
    {
        $query = "SELECT * FROM tblCart WHERE CustNo = '$CustID'";
        $getCart = $this->database->select($query);
        if ($getCart) {
            $select = "SELECT * FROM tblCustomer WHERE CustID = '$CustID'";
            $getInfo = $this->database->select($select);
            while(($rows = $getInfo->fetch_assoc()) != NULL ) {
                $OrderAddress = $rows['CustAddress']; 
                $TelNo = $rows['TelNo'];
            }
            $query = "INSERT INTO tblOrderInvoice(CustNo, OrderAddress, OrderTotalMoney, TelNo) VALUES($CustID, '$OrderAddress', $OrderTotalMoney, '$TelNo')";
            $inserted_row = $this->database->insert($query);
        }

        $query = "SELECT * FROM tblCartDetail, tblCart, tblProduct 
        WHERE CustNo = '$CustID' AND tblCartDetail.CartID = tblCart.CartID AND tblCartDetail.ProductID = tblProduct.ProductID";
        $getPro = $this->database->select($query);
        if ($getPro) {
            $select = "SELECT * FROM tblOrderInvoice WHERE CustNo = '$CustID' AND OrderDate = now()";
            $getOrderID = $this->database->select($select);
            while( ($rows = $getOrderID->fetch_assoc()) != NULL ) {$OrderID = $rows['OrderID'];}
            while ($result = $getPro->fetch_assoc()) {
                $ProductID      = $result['ProductID'];
                $QtyOrdered       = $result['QtyOrdered'];
                $Amount          = ($result['UnitPrice'] - (($result['UnitPrice'] * $result['PerDiscount'])/100)) * $QtyOrdered;

                $query = "INSERT INTO tblOrderInvoiceDetail (OrderID, ProductID, QtyOrdered, Amount) VALUES($OrderID, $ProductID, $QtyOrdered, $Amount)";
                $inserted_row = $this->database->insert($query);
            }
        }
    }

    public function getTotalMoneyInvoice()
    {
        $CustID = Session::get('customerId');
        $query = "SELECT * FROM tblOrderInvoice WHERE CustNo = '$CustID' AND OrderDate = now()";
        $result = $this->database->select($query);
        if(!$result) {
            $Total = 0;
        } else {
            while( ($rows = $result->fetch_assoc()) != NULL ) {$Total = $rows['OrderTotalMoney'];}
        }
        return $Total;
    }

    public function getOrderInvoiceDetail()
    {
        $CustID = Session::get("customerId");
        $query = "SELECT * FROM tblOrderInvoice WHERE CustNo = '$CustID' ORDER BY OrderDate DESC";
        $result = $this->database->select($query);
        return $result;
    }

    public function orderCancel($OrderID)
    {
        $query = "DELETE FROM tblOrderInvoiceDetail WHERE OrderID = '$OrderID'";
        $result = $this->database->delete($query);
        $query = "DELETE FROM tblOrderInvoice WHERE OrderID = '$OrderID'";
        $result = $this->database->delete($query);
    }

    public function getOrderDetailById($OrderID)
    {
        $query = "SELECT * FROM tblOrderDetail WHERE OrderID = '$OrderID'";
        $result = $this->database->select($query);
        return $result;
    }
    public function getAllOrderProduct()
    {
        $CustID = Session::get("customerId");
        $query = "SELECT * FROM tblOrderInvoice, tblCustomer WHERE tblOrderInvoice.CustNo = tblCustomer.CustID ORDER BY OrderDate DESC";
        $result = $this->database->select($query);
        return $result;
    }

    
    public function Confirm($OrderID)
    {
        $OrderID   = mysqli_real_escape_string($this->database->link, $OrderID);

        $query = "UPDATE tblOrderInvoice
            SET
            OrderStatus = 1
            WHERE  OrderID = '$OrderID'";
        $updated_row = $this->database->update($query);
    }

    public function Prepare($OrderID)
    {
        $OrderID   = mysqli_real_escape_string($this->database->link, $OrderID);

        $query = "UPDATE tblOrderInvoice
            SET
            OrderStatus = 2
            WHERE  OrderID = '$OrderID'";
        $updated_row = $this->database->update($query);
    }

    public function Ship($OrderID)
    {
        $OrderID   = mysqli_real_escape_string($this->database->link, $OrderID);

        $query = "UPDATE tblOrderInvoice
            SET
            OrderStatus = 3
            WHERE  OrderID = '$OrderID'";
        $updated_row = $this->database->update($query);
    }

    public function ConfirmShip($OrderID)
    {
        $OrderID   = mysqli_real_escape_string($this->database->link, $OrderID);

        $query = "UPDATE tblOrderInvoice
            SET
            OrderStatus = 4
            WHERE  OrderID = '$OrderID'";
        $updated_row = $this->database->update($query);
    }

    public function buildPCtoCart($ProductList) {
        if($ProductList != "") {
            $Product = explode(';',substr($ProductList,1));

            foreach($Product as $Value) {
                $temp = '';
                $temp = explode(',',$Value);
                $this->addToCart($temp[0],$temp[1]);
            }
        }
    }
}
