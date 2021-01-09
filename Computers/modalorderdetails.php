<?php 
require "include/topheader.php";
if(isset($_POST['OrderNo']))  
{  
    $output = '';  
    $select = "SELECT * FROM tblOrderInvoiceDetail, tblProduct WHERE OrderID = '".$_POST['OrderNo']."' AND tblOrderInvoiceDetail.ProductID = tblProduct.ProductID";
    $getPro = $database->select($select);
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
        $total = $cart->DiscountPrice($rows['UnitPrice'],$rows['PerDiscount']) * $rows['QtyOrdered'];
        $output .= '
        <tr>
            <td style="vertical-align: middle;  text-align: center;"><img style="width: 100px; height: 100px" src="'. $product->checkImg($rows['ProductImg']) .'" alt="image" /></td> 
            <td style="vertical-align: middle;  text-align: center;"><span>'. $rows['ProductName'].'</span></td> 
            <td style="vertical-align: middle;  text-align: center;"><p>'. $rows['QtyOrdered'].'</p></td>
            <td style="vertical-align: middle;  text-align: center;">₫'. number_format($cart->DiscountPrice($rows['UnitPrice'],$rows['PerDiscount'])).'</td>
            <td style="vertical-align: middle;  text-align: center;">₫'. number_format($total) .'</td></td>
        </tr>';
                }
            }
    $output .= '
    </table>';
    echo $output;
}
?>