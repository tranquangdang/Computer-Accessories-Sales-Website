<?php 
include '../lib/Session.php';
Session::checkSession();
?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php 
$product = new Product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $insertProduct = $product->productInsert($_POST, $_FILES);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm mới sản phẩm</h2>
        <div class="block">
        <?php 
        if (isset($insertProduct)) {
            echo $insertProduct;
        }
         ?>               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="ProductName" placeholder="Nhập tên sản phẩm..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Danh mục</label>
                    </td>
                    <td>
                        <select id="select" name="CategoryNo">
                            <option>Chọn danh mục</option>
                            <?php 
                            $cat = new Category();
                            $getCat = $cat->getAllCat();
                            if ($getCat) {
                                while ($result = $getCat->fetch_assoc()) {
                                    ?>
                            <option value="<?php echo $result['CategoryID']; ?>"><?php echo $result['CategoryName']; ?></option>
                            <?php
                                }
                            } ?>                          
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Hãng</label>
                    </td>
                    <td>
                        <input type="text" name="Brand" placeholder="Nhập tên sản hãng..." class="medium" />
                    </td>
                </tr>
                
                 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả</label>
                    </td>
                    <td>
                        <textarea class="tinymce" style="resize: none; width: 580px; height: 300px;" name="Intro"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Số lượng</label>
                    </td>
                    <td>
                        <input type="text" name="QtyOnHand" placeholder="Nhập số lượng..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Giá bán</label>
                    </td>
                    <td>
                        <input type="text" name="UnitPrice" placeholder="Nhập giá bán..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>% Giảm giá</label>
                    </td>
                    <td>
                        <input type="text" name="PerDiscount" placeholder="Nhập % muốn giảm..." class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Hình ảnh</label>
                    </td>
                    <td>
                        <input type="file" name="ProductImg" />
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Thêm" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


