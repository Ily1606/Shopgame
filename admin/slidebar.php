<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="index.html"><img src="../assets/images/favicon.png" width="25" alt="Aero" /><span class="m-l-10">Shop game</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="#"><img src="/assets/img/avatar.jpg" alt="User" /></a>
                    <div class="detail">
                        <h4>
                            <?php echo $username ?>
                        </h4>
                        <small>
                            Administrator</small>
                    </div>
                </div>
            </li>
            <li class="active open">
                <a href="/admin/index.php"><i class="zmdi zmdi-home"></i><span>Trang quản trị viên</span></a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle"><i class="fas fa-list"></i><span>Danh mục</span></a>
                <ul class="ml-menu">
                    <li><a href="list_add.php">Danh sách danh mục</a></li>
                    <li><a href="list_add.php">Thêm danh mục</a></li>
                    <li><a href="list_add.php">Thêm danh mục</a></li>
                    <li><a href="list_edit.php">Sửa danh mục</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle"><i class="fab fa-product-hunt"></i><span>Sản phẩm</span></a>
                <ul class="ml-menu">
                    <li><a href="/admin/product/view.php">Danh sách sản phẩm</a></li>
                    <li><a href="list_add.php">Thêm sản phẩm</a></li>
                    <li><a href="list_edit.php">Sửa sản phẩm</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle"><i class="fas fa-users"></i> <span>Thành viên</span></a>
                <ul class="ml-menu">
                    <li><a href="list_add.php">Danh sách thành viên</a></li>
                    <li><a href="list_add.php">Thêm thành viên</a></li>
                    <li><a href="list_edit.php">Sửa thành viên</a></li>
                </ul>
            </li>
            <li>
                <a href="/logout.php"><i class="zmdi zmdi-link"></i><span>Đăng xuất</span></a>
            </li>
        </ul>
    </div>
</aside>