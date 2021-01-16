<?php 
include '../lib/Session.php';
Session::checkSession();
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../classes/Customer.php');
$cus = new Customer();
?>
<?php
if (!isset($_GET['custId']) || $_GET['custId'] == null) {
    echo "<script>window.location = 'inbox.php';</script>";
} else {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['custId']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $update = $cus->customerUpdate($_POST, $id);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Chi tiết khách hàng</h2>
               <div class="block copyblock">
                <?php
                $getCust = $cus->getCustomerData($id);
                if ($getCust) {
                    while ($result = $getCust->fetch_assoc()) {
                        ?> 
                 <form action="" method="post">
                    <table class="form"> 
                    <?php if (isset($update)) {
                        echo "<tr><td colspan='3' style='text-align: center;''>".$update."</td></tr>";
                    } ?>                   
                        <tr><td>Tên</td>
                            <td>
                                <?php 
                                    if (!Session::get('level') == 0) {
                                        echo '<p>'.$result['CustName'].'</p>';
                                    } else {
                                        echo '<input type="text" name="CustName" value="'.$result['CustName'].'" class="medium" />';
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr><td>Địa chỉ</td>
                            <td>
                                <?php 
                                    if (!Session::get('level') == 0) {
                                        echo '<p>'.$result['CustName'].'</p>';
                                    } else {
                                        echo '<input type="text" name="CustAddress" value="'.$result['CustAddress'].'" class="medium" />';
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr><td>SĐT</td>
                            <td>
                                <?php 
                                    if (!Session::get('level') == 0) {
                                        echo '<p>'.$result['CustName'].'</p>';
                                    } else {
                                        echo '<input type="text" name="TelNo" value="'.$result['TelNo'].'" class="medium" />';
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr><td>Email</td>
                            <td>
                                <?php 
                                    if (!Session::get('level') == 0) {
                                        echo '<p>'.$result['CustName'].'</p>';
                                    } else {
                                        echo '<input type="text" name="Email" value="'.$result['Email'].'" class="medium" />';
                                    }
                                ?>
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
