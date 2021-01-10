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
                            <h2><strong>Danh sách sản phẩm</strong></h2>
                        </div>
                        <div class="body">
                            <div id="product_list" class="row">
                                <?php
                                $res = mysqli_query($conn, "SELECT * FROM table_product ORDER BY create_time DESC");
                                if (mysqli_num_rows($res)) {
                                    while ($row = mysqli_fetch_array($res)) {
                                        $money = number_format($row["money"]) . " VND";
                                        $selled = $row["selled"];
                                        $data_poster = json_decode($row["poster"], true);
                                        $data_poster = $data_poster[0];
                                        $poster = mysqli_query($conn, "SELECT * FROM table_medias WHERE id = $data_poster");
                                        $poster = mysqli_fetch_assoc($poster);
                                ?>
                                        <div class="col-lg-3 col-sm-6 mt-2">
                                            <a class="product_item d-block" href="/item.php?id=<?php echo $row["id"]; ?>">
                                                <img src="<?php echo $poster["url_file"] ?>">
                                                <div class="info_item">
                                                    <div class="name_item"><?php echo $row["name"]; ?></div>
                                                    <div class="des_item">
                                                        <div class="float-left"><?php echo $money; ?></div>
                                                        <div class="float-right">Đã bán: <?php echo $selled; ?></div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="d-block">
                                                <?php if ($row["status"] == 1) { ?>
                                                    <button class="btn btn-danger banner_product" attr_id="<?php echo $row["id"]; ?>">Banned</button>
                                                <?php } else { ?>
                                                    <button class="btn btn-success banner_product" attr_id="<?php echo $row["id"]; ?>">Unbanned</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php }
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
    <script>
        $(document).ready(function() {
            $(".banner_product").click(function() {
                var btn_target = $(this);
                html = btn_target.text();
                btn_target.html('<i class="fa-spinner fa fa-spin"></i> Đang kiểm tra...').attr('disabled', true);
                $.ajax({
                    url: "/admin/product/action.php?action=banner&id=" + $(this).attr("attr_id"),
                    success: function(e) {
                        btn_target.html(html).attr('disabled', false);
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
            });
        });
    </script>
</body>

</html>