<?php 
require "include/topheader.php";
if(isset($_POST['OrderNo']))  
{  
    $output = '';  
    $select = "SELECT * FROM tblOrderInvoiceDetail, tblProduct WHERE OrderID = '".$_POST['OrderNo']."' AND tblOrderInvoiceDetail.ProductID = tblProduct.ProductID";
    $getPro = $database->select($select);
    $query = "SELECT * FROM tblOrderInvoice WHERE OrderID = '".$_POST['OrderNo']."'";
    $getInfo = $database->select($query);
    if($getInfo) {
    $row = $getInfo->fetch_assoc();
    $output .= '
    <p>Số điện thoại: '.$row['TelNo'].'</p>
    <p>Địa chỉ nhận hàng: '.$row['OrderAddress'].'</p>
    <br>';
    }
    $output .= '
    <table class="table table-responsive table-bordered">
        <tr>
            <th style="padding-left: 5px; vertical-align: middle;  text-align: center;">Hình ảnh </th> 
            <th style="vertical-align: middle;  text-align: center;">Mô tả </th> 
            <th style="padding: 5px; vertical-align: middle;  text-align: center;" >Số lượng </th> 
            <th style="vertical-align: middle;  text-align: center;">Giá tiền </th> 
            <th style="padding-right: 5px; vertical-align: middle;  text-align: center;">Tổng cộng </th> 
        </tr>';
    if($getPro) {
    $sum = 0;
    $qty = 0;
    while ($rows = $getPro->fetch_assoc()) {
        $total = $product->DiscountPrice($rows['UnitPrice'],$rows['PerDiscount']) * $rows['QtyOrdered'];
        $output .= '
        <tr>
            <td><a href="productdetail.php?ProductID='.$rows['ProductID'].' style="display: block "><img style="max-width: 140px; height: 150px; vertical-align: middle;  text-align: center;" src="'.$product->checkImg($rows['ProductImg']).'" alt="image" /></a></td> 
            <td style="font-size:15px; color: black; font-weight: bold; vertical-align: middle;  text-align: center;"><a href="productdetail.php?ProductID='. $rows['ProductID'].'" style="display: block; color: #000;"><span>'. $rows['ProductName'].'</span></a></td> 
            <td style="vertical-align: middle;  text-align: center;"><p>'. $rows['QtyOrdered'].'</p></td>
            <td style="vertical-align: middle;  text-align: center;">₫'. number_format($product->DiscountPrice($rows['UnitPrice'],$rows['PerDiscount'])).'</td>
            <td style="vertical-align: middle;  text-align: center;">₫'. number_format($total) .'</td></td>
        </tr>';
                }
            }
    $output .= '
    </table>';
    echo $output;
}
?>