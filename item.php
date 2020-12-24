<?php
session_start();
include_once("_connect.php");
include("functions/Class.profile.php");
include_once("functions/functions.php");
if (!isset($_GET["id"])) {
    die;
}
$game_type = $_GET["id"];
$check_login = check_login();
if ($check_login) {
    $id = $_SESSION["id"];
    $account = new Profile($id);
    $username = $account->get_username();
}
$res = mysqli_query($conn, "SELECT * FROM table_product WHERE id = $game_type AND `status` = 1");

if (mysqli_num_rows($res)) {
    $row_game = mysqli_fetch_assoc($res);
    $data_banner = json_decode($row_game["banner"], true);
    $money = number_format($row_game["money"]) . " VND";
    if (count($data_banner) > 0) {
        $data_banner = $data_banner[0];
        $banner = mysqli_query($conn, "SELECT * FROM table_medias WHERE id = $data_banner");
        $banner = mysqli_fetch_assoc($banner);
        $banner = $banner["url_file"];
    } else {
        $banner = "/assets/img/no-thumbnail.jpg";
    }
    $html = breadcrumb($row_game);
    $info_shop = new Profile($row_game["user_id"]);
} else {
    header("Location: /404.php");
    die;
}
?>
<DOCTYPE html></DOCTYPE>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo $row_game["name"] ?></title>
    <link rel="stylesheet" href="/css3/index.css">
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
                        </div>
                        <div class="col-lg-6">
                            <a href="/edit_item.php?id=<?php echo $game_type; ?>" class="btn btn-success float-right"><i class="far fa-edit"></i>Chỉnh sửa</a>
                            <input type="hidden" id="product_id" value="<?php echo $game_type ?>">
                            <div class="h5"><?php echo $row_game["name"] ?></div>
                            <div class="d-block">
                                <div class="d-inline-block pr-2 border-right align-middle">
                                    <div class="d-block">
                                        <div class="d-inline-block font-weight-bold text-danger pr-1"><?php echo $row_game["stats"]; ?></div>
                                        <div class="d-inline-block"><?php echo render_vote($row_game["stats"]); ?></div>
                                    </div>
                                </div>
                                <div class="d-inline-block pl-2 align-middle pr-2 border-right">
                                    <div class="d-block">
                                        <div class="d-inline-block font-weight-bold text-danger pr-1"><?php echo $row_game["count_voted"]; ?></div>
                                        <div class="d-inline-block">đánh giá</div>
                                    </div>
                                </div>
                                <div class="d-inline-block pl-2 align-middle">
                                    <div class="d-block">
                                        <div class="d-inline-block font-weight-bold text-danger pr-1"><?php echo $row_game["selled"]; ?></div>
                                        <div class="d-inline-block">đã bán</div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-block">
                                <p class="text-warning h4"><?php echo $money ?></p>
                            </div>
                            <div class="d-block">
                                <div class="form-group">
                                    <div class="d-inline-block mr-2">
                                        <label>Số lượng</label>
                                    </div>
                                    <div class="d-inline-block">
                                        <input type="number" min="1" id="soluong" max="<?php echo $row_game["soluong"]; ?>" value="1" class="form-control" required>
                                    </div>
                                    <div class="d-inline-block text-muted ml-2">
                                        <small><?php echo $row_game["soluong"]; ?> sản phẩm có sẵn</small>
                                    </div>
                                </div>
                            </div>
                            <div class="d-block">
                                <div class="d-inline-block">
                                    <button class="btn btn-primary add_to_cart"><i class="fas fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
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
                                    <a href="/profile.php?id=<?php echo $info_shop->get_id(); ?>" class="text-success">Xem trang cá nhân</a>
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
                            <pre><?php echo $row_game["descryption"]; ?></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            })
        });
    </script>
</body>

</html>