<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../classes/Customer.php');
?>
<?php
if (!isset($_GET['custId']) || $_GET['custId'] == null) {
    echo "<script>window.location = 'inbox.php';</script>";
} else {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['custId']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<script>window.location = 'inbox.php';</script>";
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Chi tiết khách hàng</h2>
               <div class="block copyblock">
                <?php
                $cus = new Customer();
                $getCust = $cus->getCustomerData($id);
                if ($getCust) {
                    while ($result = $getCust->fetch_assoc()) {
                        ?> 
                 <form action="" method="post">
                    <table class="form">                    
                        <tr><td>Tên</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['CustName'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr><td>Địa chỉ</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['CustAddress'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr><td>SĐT</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['TelNo'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr><td>Email</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['Email'] ?>" class="medium" />
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
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
