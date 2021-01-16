<?php 
include '../lib/Session.php';
Session::checkSession();
?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Customer.php'; ?>
<?php 
$cus = new Customer();
if (isset($_GET['delcus'])) {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delcus']);
    $delCus = $cus->delCusById($id);
}
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Quản tài khoản khách hàng</h2>
                <div class="block">
                <?php 
                if (isset($delCus)) {
                    echo $delCus;
                }
                 ?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Mã khách hàng</th>
							<th>Tên khách hàng</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                        $getCus = $cus->getAllCus();
                        if ($getCus) {
                            $i=0;
                            while ($result = $getCus->fetch_assoc()) {
                                $i++; ?>
						<tr class="odd gradeX">
							<td><?php echo $result['CustID']; ?></td>
							<td><?php echo $result['CustName']; ?></td>
							<td><a href="customer.php?custId=<?php echo $result['CustID']; ?>">Sửa</a> || <a onclick="return confirm('Chắc chắn xóa?')" href="?delcus=<?php echo $result['CustID']; ?>">Xóa</a></td>
						</tr>
						<?php
                            }
                        } ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

