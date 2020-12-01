<div class="header-main">
    <div class="header">
        <div class="contact-information">
            <div class="connect">
                <span>Kênh người bán</span>
                <span class="header-space">|</span>
                <span class="header-space">Kết nối</span>
                <span class="social-network">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-google-plus-g"></i>
                </span>
            </div>
            <div class="information-user">
                <span class="notification"><i class="fas fa-bell "></i>Thông báo
                    <div class="notification-hover">
                        <p>Thông báo</p>
                    </div></span>
                <span class="user-space">|</span>
                <span class="user-space"> <i class="fas fa-question-circle"></i>Trợ giúp</span>
                <?php if ($check_login) { ?>
                    <span class="user-space">|</span>
                    <span class="user-space"><a href="/profile.php?id=<?php echo $id ?>"><?php echo $username; ?></a></span>
                    <span class="user-space">|</span>
                    <span class="user-space"><a href="/logout.php">Đăng xuất</a></span>
                <?php } else { ?>
                    <span class="user-space">|</span>
                    <span class="user-space"><a href="/login.php">Đăng nhập</a></span>
                    <span class="user-space">|</span>
                    <span class="user-space"><a href="/regsister.php">Đăng kí</a></span>
                <?php } ?>
            </div>
        </div>
        <div class="header-logo">
            <div class="logo">
                <div class="logo-border">
                    <div class="logo-in">SHOP GAME</div>
                </div>
            </div>
            <div class="search-information">
                <input type="text" name="search" placeholder="Nhập sản phẩm tìm kiếm" class="header-input"> <!--   Tìm kiếm sản phẩm phần header   -->
                <i class="fas fa-search"></i>
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>
</div>