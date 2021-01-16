<?php 
include '../lib/Session.php';
Session::checkSession();
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
if (!isset($_GET['CategoryID']) || $_GET['CategoryID'] == null) {
    echo "<script>window.location = 'catlist.php';</script>";
} else {
    $CategoryID = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['CategoryID']);
}
$cat = new Category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $CategoryName = $_POST['CategoryName'];
    
    $updatetCat= $cat->catUpdate($CategoryName, $CategoryID);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Chỉnh sửa danh mục</h2>
               <div class="block copyblock">
               <?php 
               if (isset($updatetCat)) {
                   echo $updatetCat;
               }
                ?>
                <?php 
                $getCat = $cat->getCatById($CategoryID);
                if ($getCat) {
                    while ($result = $getCat->fetch_assoc()) {
                        ?> 
                 <form action="" method="post">
                    <table class="form">                    
                        <tr>
                            <td>
                                <input type="text" name="CategoryName" value="<?php echo $result['CategoryName'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Lưu" />
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
<?php include 'inc/footer.php';?>
