<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/Class.profile.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/functions.php");
if (!isset($_GET["id"])) {
    die;
}
$id_biller = $_GET["id"];
$check_login = check_login();
if ($check_login) {
    $id = $_SESSION["id"];
    $account = new Profile($id);
    $username = $account->get_username();
}
$res = mysqli_query($conn, "SELECT * FROM table_biller WHERE id = $id_biller");
if (mysqli_num_rows($res)) {
    $row_biller = mysqli_fetch_assoc($res);
} else {
    header("Location: /");
    die;
}
?>
<DOCTYPE html></DOCTYPE>
<html>

<head>
    <meta charset="utf-8">
    <title>Hóa đơn của bạn</title>
    <link rel="stylesheet" href="/css3/index.css">
    <?php include_once("../header.php"); ?>
    <link rel="stylesheet" href="/assets/css/main.css">
</head>

<body>
    <?php include_once("../header_main.php"); ?>
    <?php include_once("../nav.php") ?>
    <div class="container mt-4">
        <div class="card ">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-6 cover_page card-body">
                        <?php
                        $res = mysqli_query($conn, "SELECT table_biller.*, table_product.poster, table_product.name, table_product.user_id as user_ower FROM table_biller INNER JOIN table_product ON table_biller.id_product = table_product.id WHERE table_biller.id = $id_biller");
                        $row = mysqli_fetch_array($res);
                        $profile = new Profile($row["user_id"]);
                        ?>
                        <div class="card-title h6">Chi tiết đơn hàng</div>
                        <div class="part_border">
                            <div class="row">
                                <div class="col-6 font-weight-bold">Tên sản phẩm:</div>
                                <div class="col-6"><?php echo $row["name"] ?></div>
                                <div class="col-6 font-weight-bold">ID sản phẩm:</div>
                                <div class="col-6"><?php echo $row["id_product"] ?></div>
                            </div>
                        </div>
                        <div class="part_border">
                            <div class="row">
                                <div class="col-6 font-weight-bold">Số lượng sản phẩm:</div>
                                <div class="col-6"><?php echo $row["soluong"] ?></div>
                                <div class="col-6 font-weight-bold">Đơn giá:</div>
                                <div class="col-6"><?php echo number_format($row["single_money"]) ?> VND</div>
                                <div class="col-6 font-weight-bold">Thành tiền:</div>
                                <div class="col-6"><?php echo number_format($row["money"]) ?> VND</div>
                                <div class="col-6 font-weight-bold">Phí vận chuyển:</div>
                                <div class="col-6"><?php echo number_format($row["money_ship"]) ?> VND</div>
                                <div class="col-6 font-weight-bold">Tổng tiền:</div>
                                <div class="col-6"><?php echo number_format($row["total_money"]) ?> VND</div>
                            </div>
                        </div>
                        <div class="part_border">
                            <div class="h6 text-success">Thông tin thêm</div>
                            <div class="row">
                                <div class="col-6 font-weight-bold">Trạng thái đơn hàng:</div>
                                <div class="col-6 text-danger"><?php
                                                                if ($row["status"] == 0) echo "Đã hủy";
                                                                elseif ($row["status"] == 1) echo "Đang xử lý";
                                                                elseif ($row["status"] == 2) echo "Đang vận chuyển";
                                                                elseif ($row["status"] == 3) echo "Đã nhận hàng";
                                                                elseif ($row["status"] == 4) echo "Hàng lỗi - Đang đợi hoàn tiền";
                                                                elseif ($row["status"] == 5) echo "Hàng lỗi - Đã hoàn tiền"; ?></div>
                                <div class="col-6 font-weight-bold">Trạng thái thanh toán:</div>
                                <div class="col-6 text-success"><?php if ($row["payed"] == 0) echo "Chưa thanh toán";
                                                                elseif ($row["payed"] == 1) echo "Đã thanh toán"; ?></div>
                                <div class="col-6 font-weight-bold">Ngày đặt hàng:</div>
                                <div class="col-6"><?php echo $row["create_time"]; ?></div>
                                <div class="col-6 font-weight-bold">Địa chỉ nhận hàng:</div>
                                <div class="col-6"><?php echo $row["address"]; ?></div>
                                <div class="col-6 font-weight-bold">Số điện thoại liên hệ:</div>
                                <div class="col-6"><?php echo $row["number_phone"]; ?></div>
                                <div class="col-6 font-weight-bold">Email liên hệ:</div>
                                <div class="col-6"><?php echo $profile->get_email(); ?></div>
                            </div>
                        </div>
                        <div class="part_border">
                            <div class="h6 text-success">Thanh toán trực tuyến</div>
                            <div class="row">
                                <div class="col-6 font-weight-bold">Chuyển khoản momo (shopgame làm trung gian):</div>
                                <div class="col-6">Nội dung: Shopgame biller <?php echo $row["id"]; ?></div>
                                <div class="col-12">
                                    <p class="text-danger">
                                        <?php if ($row["user_ower"] == $id && $row["payed"] == 1) echo 'Người dùng này đã thanh toán trực tuyến sản phẩm, nếu kiện hàng của bạn thanh toán online, vui lòng gửi sản phẩm đến email của người dùng.';
                                        elseif ($row["user_ower"] != $id && $row["payed"] == 1) echo 'Bạn đã thanh toán trực tuyến sản phẩm, nếu kiện hàng của bạn thanh toán trực tuyến. Vui lòng đợi email từ chủ Shop. Nhấn <a href="#send_confirm_done" class="text-primary" id="send_confirm_done">vào đây</a> nếu bạn đã nhận kiện hàng.' ?>
                                    </p>
                                    <p class="text-success">
                                        Shopgame sẽ hoàn tiền cho người dùng, nếu chủ shop không gửi kiện hàng đến cho người dùng hoặc kiện hàng không hợp lệ.
                                    </p>
                                    <form action="/controler/biller/order.php?action=confirm_send" method="POST" class="send_action">
                                        <input type="hidden" name="biller_id" value="<?php echo $id_biller ?>">
                                        <?php if ($account->get_role() != "admin") { ?>
                                            <?php if ($row["user_ower"] == $id) { ?>
                                                <select name="status" class="form-control">
                                                    <?php if ($row["status"] == 1) { ?><option value="2">Đang vận chuyển</option>
                                                    <?php } elseif ($row["status"] == 2) { ?>
                                                        <option value="11">Đang xử lý</option>
                                                    <?php } ?>
                                                </select>
                                            <?php } else { ?>
                                                <select name="status" class="form-control">
                                                    <?php if ($row["status"] == 1) { ?><option value="0">Hủy đơn hàng</option> <?php } else if ($row["status"] == 2) { ?>
                                                        <option value="3">Đã nhận hàng</option>
                                                        <option value="4">Hàng lỗi - Đang đợi hoàn tiền</option>
                                                <?php }
                                                                                                                        } ?>
                                                </select>
                                            <?php } else { ?>
                                                <select name="status" class="form-control">
                                                    <option value="0">Hủy đơn hàng</option>
                                                    <option value="1">Đang xử lý</option>
                                                    <option value="2">Đang vận chuyển</option>
                                                    <option value="3">Đã nhận hàng</option>
                                                    <option value="4">Hàng lỗi - Đang đợi hoàn tiền</option>
                                                    <option value="5">Hàng lỗi - Đã hoàn tiền</option>
                                                </select>
                                            <?php } ?>
                                            <button class="btn btn-success">Lưu thay đổi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $(".send_action").submit(function() {
            $.ajax({
                url: $(this).attr("action"),
                method: $(this).attr("method"),
                data: $(this).serialize(),
                success: function(e) {
                    e = JSON.parse(e);
                    if (e.status) {
                        toastr.success(e.msg);
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    } else {
                        toastr.error(e.msg);
                    }
                },
                error: function(e) {
                    toastr.error("Có lỗi khi thực hiện hành động này!");
                }
            })
            return false;
        })
    });
</script>

</html>