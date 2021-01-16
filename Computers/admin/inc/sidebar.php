<div class="grid_2">
    <div class="box sidemenu">
        <div class="block" id="section-menu">
            <ul class="section menu">
                <?php if (Session::get('level') == 0) {?>
                <li><a class="menuitem">Tài khoản</a>
                    <ul class="submenu">
                        <li><a href="adminlist.php">Admin</a> </li>
                        <li><a href="createadmin.php">Tạo mới Admin</a> </li>
                        <li><a href="customerlist.php">Khách hàng</a> </li>
                    </ul>
                </li>
                <?php }?>
                <li><a class="menuitem">Danh mục sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="catadd.php">Thêm danh mục</a> </li>
                        <li><a href="catlist.php">Quản lý danh mục</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="productadd.php">Thêm sản phẩm</a> </li>
                        <li><a href="productlist.php">Quản lý sản phẩm</a> </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
