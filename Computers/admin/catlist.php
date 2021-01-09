<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php 
$cat = new Category();
if (isset($_GET['delcat'])) {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delcat']);
    $delCat = $cat->delCatById($id);
}
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Quản lý danh mục</h2>
                <div class="block">
                <?php 
                if (isset($delCat)) {
                    echo $delCat;
                }
                 ?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Mã danh mục</th>
							<th>Tên danh mục</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                        $getCat = $cat->getAllCat();
                        if ($getCat) {
                            $i=0;
                            while ($result = $getCat->fetch_assoc()) {
                                $i++; ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['CategoryName']; ?></td>
							<td><a href="catedit.php?CategoryID=<?php echo $result['CategoryID']; ?>">Sửa</a> || <a onclick="return confirm('Are you sure to delete this?')" href="?delcat=<?php echo $result['CategoryID']; ?>">Xóa</a></td>
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

