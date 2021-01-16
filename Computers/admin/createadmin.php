<?php include '../classes/Admin.php'?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
$admin = new Admin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $create = $admin->adminRegistration($_POST);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Chi tiết admin</h2>
               <div class="block copyblock">
                 <form action="" method="post">
                    <table class="form"> 
                    <?php if (isset($create)) {
                        echo "<tr><td colspan='3' style='text-align: center;''>".$create."</td></tr>";
                        } ?>   
                        <tr><td>Họ và tên</td>
                            <td>
                                <input type="text" name="AdminName" value="" class="medium" />
                            </td>
                        </tr>                
                        <tr><td>Username</td>
                            <td>
                                <input type="text" name="AdminUser" value="" class="medium" />
                            </td>
                        </tr>
                        <tr><td>Mật khẩu</td>
                            <td>
                                <input type="text" name="AdminPass" value="" class="medium" />
                            </td>
                        </tr>
                        <tr><td>Level</td>
                            <td>
                                <input type="text" name="AdminLevel" value="" class="medium" />
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <input type="submit" name="submit" Value="Tạo mới" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
