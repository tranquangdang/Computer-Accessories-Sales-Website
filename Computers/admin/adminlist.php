<?php include '../classes/Admin.php'?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
$admin = new Admin();
if (isset($_GET['deladmin'])) {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['deladmin']);
    $delAdmin = $admin->delAdminById($id);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Quản admin</h2>
                <div class="block">
                <?php 
                if (isset($delAdmin)) {
                    echo $delAdmin;
                }
                 ?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
                            <th>Level</th>
							<th>Mã Admin</th>
                            <th>Tên Admin</th>
							<th>Username</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                        $getAdmin = $admin->getAlladmin();
                        if ($getAdmin) {
                            $i=0;
                            while ($result = $getAdmin->fetch_assoc()) {
                                $i++; ?>
						<tr class="odd gradeX">
                            <td><?php echo $result['AdminLevel']; ?></td>
							<td><?php echo $result['AdminID']; ?></td>
                            <td><?php echo $result['AdminName']; ?></td>
							<td><?php echo $result['AdminUser']; ?></td>
							<td><a href="admin.php?adminId=<?php echo $result['AdminID']; ?>">Sửa</a> <?php if($result['AdminID'] != Session::get("adminId")) {?> ||  <a onclick="return confirm('Chắc chắn xóa?')" href="?deladmin=<?php echo $result['AdminID']; ?>">Xóa</a><?php }?></td>
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

