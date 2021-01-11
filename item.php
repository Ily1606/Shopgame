<?php
session_start();
include_once("_connect.php");
include("functions/Class.profile.php");
include("functions/Class.product.php");
include_once("functions/functions.php");
if (!isset($_GET["id"])) {
    die;
}
$product_id = mysqli_real_escape_string($conn, $_GET["id"]);
$check_login = check_login();
if ($check_login) {
    $id = $_SESSION["id"];
    $account = new Profile($id);
    $username = $account->get_username();
}
$product = new Product($product_id);
if ($product->num) {
    $banner = $product->get_banner();
    $html = breadcrumb($product->get_res());
    $info_shop = new Profile($product->get_ower());
} else {
    header("Location: /404.php");
    die;
}
?>
<DOCTYPE html></DOCTYPE>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo $product->get_name(); ?></title>
    <?php include_once("header.php"); ?>
    <link rel="stylesheet" href="/assets/css/main.css">
</head>

<body>
    <?php include_once("header_main.php"); ?>
    <?php include_once("nav.php") ?>
    <div class="container">
        <div class="mt-4">
            <?php echo $html; ?>
        </div>
        <div class="row">
            <div class="card cover_page mt-2" style="min-height: 400px;">
                <div class="card-body">
                    <div class="row m-2">
                        <div class="col-lg-6">
                            <img src="<?php echo $banner ?>">
                            <h6 class="mt-4">Ảnh của sản phẩm</h6>
                            <div class="d-block list_picture mt-2">
                                <?php
                                $list_poster = $product->get_list_poster();
                                for ($i = 0; $i < count($list_poster); $i++) { ?>
                                    <div class="d-inline-block p-0 show_modal_img"><img src="<?php echo $list_poster[$i]; ?>" /></div>
                                <?php }
                                ?>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <?php
                            if ($account->get_id()  == $product->get_ower()) {
                            ?>
                                <a href="/edit_item.php?id=<?php echo $product_id; ?>" class="btn btn-success float-right"><i class="far fa-edit"></i>Chỉnh sửa</a>
                            <?php } ?>
                            <input type="hidden" id="product_id" value="<?php echo $product_id ?>">
                            <div class="h5"><?php echo $product->get_name(); ?></div>
                            <div class="d-block">
                                <div class="d-inline-block pr-2 border-right align-middle">
                                    <div class="d-block">
                                        <div class="d-inline-block font-weight-bold text-danger pr-1"><?php echo $product->get_stats(); ?></div>
                                        <div class="d-inline-block"><?php echo render_vote($product->get_stats()); ?></div>
                                    </div>
                                </div>
                                <div class="d-inline-block pl-2 align-middle pr-2 border-right">
                                    <div class="d-block">
                                        <div class="d-inline-block font-weight-bold text-danger pr-1"><?php echo $product->get_count_voted(); ?></div>
                                        <div class="d-inline-block">đánh giá</div>
                                    </div>
                                </div>
                                <div class="d-inline-block pl-2 align-middle">
                                    <div class="d-block">
                                        <div class="d-inline-block font-weight-bold text-danger pr-1"><?php echo $product->get_selled(); ?></div>
                                        <div class="d-inline-block">đã bán</div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-block mb-2">
                                <div class="d-inline-block">
                                    <p class="text-warning mr-3 mt-2 mb-2" style="font-size: 24px;"><?php echo number_format($product->get_current_money()); ?> VND</p>
                                    <?php if ($product->get_enable_sale()) { ?>
                                        <div class="text-danger">
                                            <span style="text-decoration: line-through;"><?php echo number_format($product->get_money()); ?> VND</span>
                                            <span class="mr-2 ml-2">|</span>
                                            <span class="font-weight-bold">
                                                <?php echo $product->get_countdown_endsale(); ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="d-inline-block border-left ml-3 pl-3">
                                    <p class="mb-0">Phí vận chuyển: <b class="text-success"><?php echo number_format($product->get_money_ship()); ?> VND</b></p>
                                </div>
                            </div>
                            <div class="d-block">
                                <div class="form-group">
                                    <div class="d-inline-block mr-2">
                                        <label>Số lượng</label>
                                    </div>
                                    <div class="d-inline-block">
                                        <input type="number" min="1" id="soluong" max="<?php echo $product->get_soluong(); ?>" value="1" class="form-control" required>
                                    </div>
                                    <div class="d-inline-block text-muted ml-2">
                                        <small><?php echo $product->get_soluong() -  $product->get_selled(); ?> sản phẩm có sẵn</small>
                                    </div>
                                </div>
                            </div>
                            <div class="d-block">
                                <p>Hình thức thanh toán</p>
                                <p><small><i class="fas fa-money-check-alt text-success mr-2"></i>Thanh toán trực tuyến (do shopgame làm trung gian)</small></p>
                                <?php if ($product->get_enable_ship()) { ?><p><small><i class="fas fa-shipping-fast text-success mr-2"></i>Thanh toán khi nhận hàng</small></p><?php } ?>
                            </div>
                            <div class="d-block">
                                <div class="d-inline-block">
                                    <?php if ($product->get_soluong() -  $product->get_selled()) { ?>
                                        <button class="btn btn-primary add_to_cart"><i class="fas fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                                    <?php } else { ?>
                                        <button class="btn btn-secondary" disabled><i class="fas fa-shopping-cart"></i>Đã hết hàng</button>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="d-block mt-4">
                                <div class="h6">Thông tin về shop</div>
                                <div class="d-inline-block align-middle">
                                    <img src="<?php echo $info_shop->get_avatar(); ?>" class="rounded-circle" width="50px" height="50px">
                                </div>
                                <div class="d-inline-block align-middle ml-3">
                                    <div><?php echo $info_shop->get_fullname(); ?></div>
                                    <div><?php echo $info_shop->get_email(); ?></div>
                                    <a href="/profile/profile.php?id=<?php echo $info_shop->get_id(); ?>" class="text-success">Xem trang cá nhân</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card cover_page mt-2">
                <div class="card-body">
                    <div class="row m-2">
                        <div class="d-block mt-2">
                            <div>Mô tả: </div>
                            <pre><?php echo $product->get_descryption(); ?></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal_bg">
        <span aria-hidden="true" class="close_modal">&times;</span>
    </div>
    <div class="modal_content">
    </div>
    <?php include_once("footer.php"); ?>
    <script>
        $(document).ready(function() {
            $(".add_to_cart").click(function() {
                $.ajax({
                    url: "/controler/cart.php?action=add",
                    method: "POST",
                    data: "soluong=" + $("#soluong").val() + "&product_id=" + $("#product_id").val(),
                    success: function(e) {
                        e = JSON.parse(e);
                        if (e.status) {
                            toastr.success(e.message);
                            setTimeout(function() {
                                window.location.href = "/cart.php";
                            }, 3000)
                        } else {
                            toastr.error(e.message);
                        }
                    },
                    error: function() {
                        toastr.error("Có lỗi khi thêm sản phẩm vào giỏ hàng!");
                    }
                })
            });
            $(".star_rate").on("click", "i", function() {
                $.ajax({
                    url: "/controler/rate.php",
                    method: "POST",
                    data: "rate=" + $(this).attr("for_stats") + "&product_id=" + $("#product_id").val(),
                    success: function(e) {
                        e = JSON.parse(e);
                        if (e.status) {
                            toastr.success(e.msg);
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        } else {
                            toastr.error(e.msg);
                        }
                    }
                })
            });
            $(".show_modal_img").click(function() {
                $(".modal_bg").fadeIn();
                $(".modal_content").html('<img src="' + $(this).find('img').attr('src') + '">').fadeIn();
            });
            $(".modal_bg, .close_modal").click(function() {
                $(".modal_bg").fadeOut();
                $(".modal_content").fadeOut();
            })
        });
    </script>
</body>

</html>