<?php require "include/topheader.php"; ?>
<?php
if (isset($_GET['Action'])){
  if (isset($_GET['Type'])) {
    $Type = $product->checkType($_GET['Type']);

    if($_GET['Action'] == 'Set' && isset($_GET['ProductID']) && $Type != "") {
        Cookie::set($Type,$_GET['ProductID']);
    } 
    if($_GET['Action'] == 'Remove' && $Type != "") {
        Cookie::remove($Type);
    }
  } else {
    if($_GET['Action'] == 'RemoveAll') {
      Cookie::destroy();
    }
  }
    header('Location:buildpc.php');
}

if (isset($_POST['ProductList'])) {
  $cart->buildPCtoCart($_POST['ProductList']);
}

?>
<?php require "include/header.php"; ?>
<?php require "include/search.php"; ?>
<style type="text/css">
.order {width: 94%;}
.tblone  tr td{text-align:left;}
.tblone tr td div a {color: #000}
</style>
    		<div class="section group">
          <div style="width: 94%">
            <a href="buildpc.php?Action=RemoveAll" class="btn blackBtn" style="font-weight: normal; display: inline; width: 20%; text-align:center; cursor: pointer; padding:7px 20px">Xây dựng lại</a>
            <a class="btn blackBtn capture" style="font-weight: normal; display: inline; width: 30%; text-align:center; cursor: pointer; padding:7px 20px">Tải xuống cấu hình</a>
            <span class="sumTotal" style="float: right; font-size: 20px; color:crimson">Thành tiền: ₫0</span>
          </div>
          
          <br>
    			<div class="order">
    				<table class="tblone table table-responsive table-bordered thisTable">
                <tr>
                    <th style="width: 13%">Linh kiện</th>
                    <th style="width: 87%">Lựa chọn</th>
                </tr>
                <tr>
                    <td>Bo mạch chủ</td>
                    <td>
                        <?php 
                          if (!isset($_COOKIE['MAIN'])) { ?>
                            <a type="button" class="btn blackBtn Type" data-id="'MAIN1','MAIN2'" style="display: inline-block; padding: 5px; font-size: 11px; text-align:center;">Chọn</a>
                          <?php 
                          } else {
                            echo $product->buildPC('MAIN',$_COOKIE['MAIN']);
                          } 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Bộ vi xử lí</td>
                    <td>
                        <?php 
                          if (!isset($_COOKIE['CPU0'])) { ?>
                            <a type="button" class="btn blackBtn Type" data-id="'CPU01','CPU02'" style="display: inline-block; padding: 5px; font-size: 11px; text-align:center;">Chọn</a>
                          <?php 
                          } else {
                            echo $product->buildPC('CPU0',$_COOKIE['CPU0']);
                          } 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>RAM</td>
                    <td>
                        <?php 
                          if (!isset($_COOKIE['RAM0'])) { ?>
                            <a type="button" class="btn blackBtn Type" data-id="'RAM01'" style="display: inline-block; padding: 5px; font-size: 11px; text-align:center;">Chọn</a>
                          <?php 
                          } else {
                            echo $product->buildPC('RAM0',$_COOKIE['RAM0']);
                          } 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Ổ SSD</td>
                    <td>
                        <?php 
                          if (!isset($_COOKIE['SSD0'])) { ?>
                            <a type="button" class="btn blackBtn Type" data-id="'SSD01'" style="display: inline-block; padding: 5px; font-size: 11px; text-align:center;">Chọn</a>
                          <?php 
                          } else {
                            echo $product->buildPC('SSD0',$_COOKIE['SSD0']);
                          } 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Ổ HDD</td>
                    <td>
                        <?php 
                          if (!isset($_COOKIE['HDD0'])) { ?>
                            <a type="button" class="btn blackBtn Type" data-id="'HDD01'" style="display: inline-block; padding: 5px; font-size: 11px; text-align:center;">Chọn</a>
                          <?php 
                          } else {
                            echo $product->buildPC('HDD0',$_COOKIE['HDD0']);
                          } 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Nguồn</td>
                    <td>
                        <?php 
                          if (!isset($_COOKIE['PSU0'])) { ?>
                            <a type="button" class="btn blackBtn Type" data-id="'PSU01'" style="display: inline-block; padding: 5px; font-size: 11px; text-align:center;">Chọn</a>
                          <?php 
                          } else {
                            echo $product->buildPC('PSU0',$_COOKIE['PSU0']);
                          } 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Vỏ máy tính</td>
                    <td>
                        <?php 
                          if (!isset($_COOKIE['CASE'])) { ?>
                            <a type="button" class="btn blackBtn Type" data-id="'CASE1'" style="display: inline-block; padding: 5px; font-size: 11px; text-align:center;">Chọn</a>
                          <?php 
                          } else {
                            echo $product->buildPC('CASE',$_COOKIE['CASE']);
                          } 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Card màn hình</td>
                    <td>
                        <?php 
                          if (!isset($_COOKIE['VGA0'])) { ?>
                            <a type="button" class="btn blackBtn Type" data-id="'VGA01','VGA02'" style="display: inline-block; padding: 5px; font-size: 11px; text-align:center;">Chọn</a>
                          <?php 
                          } else {
                            echo $product->buildPC('VGA0',$_COOKIE['VGA0']);
                          } 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Tản nhiệt</td>
                    <td>
                        <?php 
                          if (!isset($_COOKIE['COOL'])) { ?>
                            <a type="button" class="btn blackBtn Type" data-id="'COOL1'" style="display: inline-block; padding: 5px; font-size: 11px; text-align:center;">Chọn</a>
                          <?php 
                          } else {
                            echo $product->buildPC('COOL',$_COOKIE['COOL']);
                          } 
                        ?>
                    </td>
                </tr>
                 
            </table>
            <?php 
              if(Session::get('customerId')) {
                echo '<a class="btn blackBtn addToCart" style="float: right; width: 30%; text-align:center; cursor: pointer; padding: 5px 15px">Thêm vào giỏ hàng</a>';
              }
            ?>
    			</div>
    		</div>
       <div class="clear"></div>
</div> <!-- END of main -->
<!-- MODAL -->
<?php require "include/footer.php"; ?>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Danh mục</h4>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<!-- END of MODAL -->
<script type="text/javascript">
$(document).ready(function(){  
    $('.Type').click(function(){
        var Type = $(this).data("id");  
          $.ajax({  
              url:"buildpctype.php",  
              method:"post",  
              data:{Type:Type},  
              success:function(data){   
                  $('.modal-body').html(data)
                  $('#myModal').modal('show');  
              }  
          });  
    });

    var sum = 0;
    $('.total').each(function(){
        sum += parseInt(unFormatMoney($(this).text()));
        $(".sumTotal").text("Thành tiền: ₫" + formatMoney(sum));
    });

    $('input[name=\'quantity\']').on("change keyup click", function() {
      var sumTotal = 0;
      $('.total').each(function(){
        sumTotal += parseInt(unFormatMoney($(this).text()));
        $(".sumTotal").text("Thành tiền: ₫" + formatMoney(sumTotal));
      });
    });

    document.querySelector('.capture').addEventListener('click', function() {
        html2canvas(document.querySelector('.thisTable'), {
            onrendered: function(canvas) {
              return Canvas2Image.saveAsPNG(canvas);
            }
        });
    });

    $('.addToCart').click(function(){
      var st='';
      $('input[class^="proid"]').each(function(){
          var qty = $(this).val();
          var id = $(this).data("id");
          st += ';' + qty + ',' + id;
      });
      $.ajax({  
            url:"buildpc.php",  
            method:"post",  
            data:{ProductList:st},  
            success:function(data){  
              window.location ='shoppingcart.php';
            }  
        });
    });
});

</script>