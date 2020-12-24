<?php
session_start();
include_once("_connect.php");
include_once("functions/Class.profile.php");
include_once("functions/functions.php");
$check_login = check_login();
if ($check_login) {
    $id = $_SESSION["id"];
    $account = new Profile($id);
    $username = $account->get_username();
}
?>
<DOCTYPE html></DOCTYPE>
<html>

<head>
    <meta charset="utf-8">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="/css3/index.css">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
        <meta name="description" content="Shopgame - Trang web thương mại điện tử - mua bán sản phẩm game" />
        <title>Shop game</title>
        <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon" />
        <link rel="stylesheet" href="/assets//bootstrap/dist/css/bootstrap.min.css" />

        <link rel="stylesheet" type="text/css" href="/assets/fontawesome/css/all.css">
        <link rel="stylesheet" type="text/css" href="/assets/toastr/css/toastr.css">
        <script src="/assets/jquery/jquery.js"></script>
        <script src="/assets/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/assets/toastr/js/toastr.min.js"></script>
        <link rel="stylesheet" href="/assets/css/main.css">
    </head>

<body>
    <?php include_once("header_main.php"); ?>
    <?php include_once("nav.php") ?>
    <div class="container mt-2 text-center">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <?php echo $row["name"]; ?>
                </div>
                <div class="d-flex">
                    <div class="col">
                        Sản phẩm
                    </div>
                    <div class="col">
                        Đơn giá
                    </div>
                    <div class="col">
                        Số lượng
                    </div>
                    <div class="col">
                        Tổng tiền
                    </div>
                    <div class="col">
                        Thao tác
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_SESSION["cart"])) {
            $cart_data = $_SESSION["cart"];
        } else {
            $cart_data = array();
        }
        if (count($cart_data) > 0) {
            foreach ($cart_data as $item) {
                $product_id = $item["product_id"];
                $soluong = $item["soluong"];
                $res = mysqli_query($conn, "SELECT * FROM table_product WHERE id = $product_id");
                $row = mysqli_fetch_assoc($res);
                $data_poster = json_decode($row["poster"], true);
                $data_poster = $data_poster[0];
                $poster = mysqli_query($conn, "SELECT * FROM table_medias WHERE id = $data_poster");
                $poster = mysqli_fetch_assoc($poster);
                $poster = $poster["url_file"];
        ?>
                <div class="card item" for_id="<?php echo $product_id; ?>">
                    <div class="card-body">
                        <div class="card-title">
                            <?php echo $row["name"]; ?>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="col">
                                    <img src="<?php echo $poster; ?>" height="100px">
                                </div>
                                <div class="col">
                                    <?php echo number_format($row["money"]) ?> VND
                                </div>
                                <div class="col">
                                    <input type="number" min="1" class="soluong" value="<?php echo $soluong; ?>" class="form-control" required>
                                </div>
                                <div class="col total_money">
                                    <?php echo number_format($row["money"] * $soluong) ?> VND
                                </div>
                                <div class="col">
                                    <button class="btn btn-danger delete">Xoá</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        } else { ?>
            <div class="card">
                <div class="card-body">Không có sản phẩm trong giỏ hàng</div>
            </div>
        <?php } ?>
    </div>
    <script>
        $(document).ready(function() {
            $(".delete").click(function() {
                var product_id = $(this).parents(".item").attr("for_id");
                $.ajax({
                    url: "/controler/cart.php?action=delete",
                    method: "POST",
                    data: "product_id=" + product_id,
                    success: function(e) {
                        e = JSON.parse(e);
                        if (e.status) {
                            toastr.success(e.message);
                            $(".item[for_id='" + product_id + "']").remove();
                        }
                    },
                    error: function() {
                        toastr.error("Có lỗi khi xóa sản phẩm khỏi giỏ hàng!");
                    }
                })
            });
            $(".soluong").change(function() {
                var product_id = $(this).parents(".item").attr("for_id");
                $.ajax({
                    url: "/controler/cart.php?action=update",
                    method: "POST",
                    data: "soluong=" + $(this).val() + "&product_id=" + product_id,
                    success: function(e) {
                        e = JSON.parse(e);
                        if (e.status) {
                            $(".item[for_id='" + product_id + "']").find('.total_money').text(e.money);
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