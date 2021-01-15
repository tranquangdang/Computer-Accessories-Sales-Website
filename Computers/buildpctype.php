<?php 
require "include/topheader.php";
if(isset($_POST['Type']))  
{  
    $output = '';  
    $select = "SELECT * FROM tblProduct WHERE CategoryNo in (" . $_POST['Type'] . ")";
    $getPro = $database->select($select);
    $output .= '<input type="Text"; placeholder="Tìm kiếm" style="width: 100%;"/>'; 
    if($getPro) {
    while ($rows = $getPro->fetch_assoc()) {
        $ProductID = $rows['ProductID'];
        $output .= '
        <div class="pani" style="border-bottom: 1px solid #dfdfdf; height: 152px; position: relative">
            <a href="productdetail.php?ProductID='. $ProductID .'" style=" color: #000">
                <img style="width: 150px; height: 150px; float: left; margin: 0 10px" src="'. $product->checkImg($rows['ProductImg']) .'" alt="image" />
                <h4>'. $rows['ProductName'].'</h4>
                <p class="price">₫'. number_format($product->DiscountPrice($rows['UnitPrice'],$rows['PerDiscount'])).'</p>
            </a>
            <a  class="btn blackBtn choose"
                href ="buildpc.php?Action=Set&Type='.substr($_POST['Type'],1,4).'&ProductID='.$ProductID.'"
                style="
                    position: absolute;
                    bottom: 0;
                    right: 0;
                    width: 10%; color: white; 
                    margin: 0 5px 5px 0;
                    padding: 5px; 
                    font-size: 11px;
                    text-align: center;
                ">
                Chọn
            </a>
        </div>
        <div class="cleaner"></div>';
        }
    };
    echo $output;
}
?>