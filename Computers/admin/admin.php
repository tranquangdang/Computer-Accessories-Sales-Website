<?php include '../classes/Admin.php'?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
$admin = new Admin();
if (!isset($_GET['adminId']) || $_GET['adminId'] == null) {
    echo "<script>window.location = 'adminlist.php';</script>";
} else {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['adminId']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $update = $admin->adminUpdate($_POST, $id);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Chi tiết admin</h2>
               <div class="block copyblock">
                <?php
                $getAdmin = $admin->getAdminData($id);
                if ($getAdmin) {
                    while ($result = $getAdmin->fetch_assoc()) {
                        ?> 
                 <form action="" method="post">
                    <table class="form"> 
                    <?php if (isset($update)) {
                        echo "<tr><td colspan='3' style='text-align: center;''>".$update."</td></tr>";
                    } ?>  
                        <tr><td>Level</td>
                            <td>
                                <input type="text" name="AdminName" value="<?php echo $result['AdminLevel']; ?>" class="medium" />
                            </td>
                        </tr>  
                        <tr><td>Họ và tên</td>
                            <td>
                                <input type="text" name="AdminName" value="<?php echo $result['AdminName']; ?>" class="medium" />
                            </td>
                        </tr>                
                        <tr><td>Username</td>
                            <td>
                                <input type="text" name="AdminUser" value="<?php echo $result['AdminUser']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr><td>Mật khẩu</td>
                            <td>
                                <input type="text" name="AdminPass" value="" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><a href="javascript:history.back()">Quay lại</a></p>      
                            </td>
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
<?php include 'inc/footer.php';?>
