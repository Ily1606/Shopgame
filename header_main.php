<div class="header-main">
    <div class="container">
        <div class="d-inline-block header_logo">
            <img src="/assets/img/logo.png">
        </div>
        <div class="d-inline-block">
            <form action="/search.php" method="GET">
                <input type="text" name="q" placeholder="Nhập sản phẩm tìm kiếm" value="<?php if (isset($_GET["q"])) echo htmlspecialchars($_GET["q"]); ?>" class="header-input">
                <button class="btn-search"><i class="fas fa-search"></i></button>
                <a href="/cart.php" class="cart_login">
                    <i class="fas fa-shopping-cart icon_nav"></i>Giỏ hàng <span class="text-danger"><?php if (isset($_SESSION["cart"])) echo "(" . count($_SESSION["cart"]) . ")"; ?></span>
                </a>
            </form>
        </div>
        <div class="d-inline-block">
            <?php if ($check_login) { ?>
                <span class="user-space"><a href="/profile/profile.php?id=<?php echo $id ?>" class="text-danger"><?php echo $username; ?></a></span>
                <span class="user-space">|</span>
                <span class="user-space"><a href="/logout.php">Đăng xuất</a></span>
            <?php } else { ?>
                <span class="user-space user-space-10 "><a href="/login.php">Đăng nhập</a></span>
                <span class="user-space">|</span>
                <span class="user-space user-space-10"><a href="/regsister.php">Đăng kí</a></span>
            <?php } ?>
        </div>
    </div>
</div>