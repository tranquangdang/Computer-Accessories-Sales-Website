<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
if (!isset($_GET['proid']) || $_GET['proid'] == null) {
    echo "<script>window.location = 'productlist.php';</script>";
} else {
    $proid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
}
$pd = new Product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateProduct = $pd->productUpdate($_POST, $_FILES, $proid);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block">
        <?php 
        if (isset($updateProduct)) {
            echo $updateProduct;
        }
         ?>
         <?php 
         $getPro = $pd->getProById($proid);
         if ($getPro) {
             while ($value = $getPro->fetch_assoc()) {
                 ?>               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="ProductName" value="<?php echo $value['ProductName'] ?>" class="medium" />
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
                            <option 
                            <?php 
                            if ($value['CategoryNo'] == $result['CategoryID']) {
                                ?>
                                selected = "selected"
                            <?php
                            } ?>
                            value="<?php echo $result['CategoryID']; ?>"><?php echo $result['CategoryName']; ?></option>
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
                        <input type="text" name="Brand" value="<?php echo $value['Brand'] ?>" class="medium" />
                    </td>
                </tr>
                
                 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả</label>
                    </td>
                    <td>
                        <textarea class="tinymce" style="resize: none; width: 580px; height: 300px;"  name="Intro"><?php echo $value['Intro'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input type="text" name="UnitPrice" value="<?php echo $value['UnitPrice'] ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>% Giảm giá</label>
                    </td>
                    <td>
                        <input type="text" name="PerDiscount"  value="<?php echo $value['PerDiscount'] ?>" placeholder="Nhập % muốn giảm..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Số lượng</label>
                    </td>
                    <td>
                        <input type="text" name="QtyOnHand" value="<?php echo $value['QtyOnHand'] ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Hình ảnh</label>
                    </td>
                    <td>
                        <img src="<?php echo $value['ProductImg']; ?>" height="200px" width="200px"><br>
                        <input type="file" name="ProductImg" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Cập nhật" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
             }
         } ?>
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


