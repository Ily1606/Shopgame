<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/functions.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/Class.profile.php");
$check_login = check_login();
if ($check_login) {
    $id = $_SESSION["id"];
    $account = new Profile($id);
    if ($account->get_role() != "admin") {
        header("HTTP/1.0 404 Not Found");
        die;
    }
    $username = $account->get_username();
} else {
    header("HTTP/1.0 404 Not Found");
    die;
}
?>
<html>
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/header.php"); ?>
<link rel="stylesheet" href="/assets/css/main.css">
</head>

<body class="theme-blush">
    <!-- Right Icon menu Sidebar -->
    <?php include_once("../slidebar.php") ?>
    <!-- Main Content -->
    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Trang quản trị viên</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon">
                        <div class="body">
                            <h6>Số thành viên</h6>
                            <h2><?php $row = mysqli_query($conn, "SELECT COUNT(*) As count FROM `table_accounts`");
                                $row = mysqli_fetch_assoc($row);
                                echo $row["count"];
                                ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon">
                        <div class="body">
                            <h6>Số sản phẩm</h6>
                            <h2><?php $row = mysqli_query($conn, "SELECT COUNT(*) As count FROM `table_product`");
                                $row = mysqli_fetch_assoc($row);
                                echo $row["count"];
                                ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon">
                        <div class="body">
                            <h6>Số game</h6>
                            <h2><?php $row = mysqli_query($conn, "SELECT COUNT(*) As count FROM `table_games`");
                                $row = mysqli_fetch_assoc($row);
                                echo $row["count"];
                                ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon">
                        <div class="body">
                            <h6>Số loại sản phẩm</h6>
                            <h2><?php $row = mysqli_query($conn, "SELECT COUNT(*) As count FROM `table_types`");
                                $row = mysqli_fetch_assoc($row);
                                echo $row["count"];
                                ?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Lịch sử thanh toán tự động</strong></h2>
                        </div>
                        <div class="body">
                            <div id="product_list">
                                <?php
                                $res = mysqli_query($conn, "SELECT * FROM table_history_payemnt ORDER BY create_time DESC");
                                if (mysqli_num_rows($res)) {
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($res)) {
                                        $money = number_format($row["vnd"]) . " VND";
                                ?>
                                        <div class="d-block">
                                            <div class="dropdown float-right">
                                                <div id="more_action" class="btn border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Thao tác
                                                </div>
                                                <div class="dropdown-menu" aria-labelledby="more_action">
                                                    <a class="dropdown-item text-success" href="/biller/biller.php?id=<?php echo $row["from_biller"] ?>">Xem đơn hàng</a>
                                                    <a class="dropdown-item text-primary" href="#" onclick="refund(<?php echo $row['id']; ?>)">Đánh dấu hoàn tiền</a>
                                                </div>
                                            </div>
                                            <div class="d-inline-block align-middle mr-2">
                                                <div class="border_no">
                                                    <?php echo $i; ?>
                                                </div>
                                            </div>
                                            <div class="d-inline-block align-middle">
                                                <?php
                                                $account_user = new Profile($row["from_user"]);
                                                ?>
                                                <h5 class="mb-1"><a href="/profile/profile.php?id=<?php echo $account_user->get_id() ?>"><?php echo $account_user->get_fullname() ?></a></h5>
                                                <div class="mb-2"><?php echo $row["message"]; ?></div>
                                                <div><small class="text-muted">Trạng thái hoàn tiền:
                                                        <?php if ($row["status"] == 1) {
                                                            echo '<b class="text-success">Không hoàn tiền</b>';
                                                        } else {
                                                            echo '<b class="text-danger">Đã hoàn tiền</b>';
                                                        }; ?></small>
                                                    <span class="mr-2 ml-2">|</span>
                                                    <small class="text-muted">Ngày thanh toán:
                                                        <?php echo $row["create_time"]; ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        $i++;
                                    }
                                } else { ?>
                                    <div class="h6">Không có kết quả tìm kiếm</div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="/assets/js/mainscripts.bundle.js"></script>
    <style>
        .border_no {
            padding: 10px 20px;
            background-color: #28a745;
            font-size: 20px;
            font-weight: bold;
            border-radius: 50%;
            color: #FFFFFF;
        }
    </style>
    <script>
        function refund(id) {
            $.ajax({
                url: "/admin/history/action.php?action=refund&id=" + id,
                success: function(e) {
                    e = JSON.parse(e);
                    if (e.status) {
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000)
                        toastr.success(e.message);
                    } else {
                        toastr.error(e.message);
                    }
                }
            })
        }
    </script>
</body>

</html>