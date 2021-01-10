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
                            <h2><strong>Quản lý hệ thống</strong></h2>
                        </div>
                        <div class="body">
                            <?php $config = mysqli_query($conn, "SELECT * FROM table_config");
                            $config = mysqli_fetch_assoc($config); ?>
                            <div class="form-group">
                                <label>Bảo trì website</label>
                                <select id="maintance" class="form-control">
                                    <option value="1" <?php if ($config["maintance"] == 1) {
                                                            echo "selected";
                                                        } ?>>Bật</option>
                                    <option value="0" <?php if ($config["maintance"] == 0) {
                                                            echo "selected";
                                                        } ?>>Tắt</option>
                                </select>
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
            $("#maintance").change(function() {
                $.ajax({
                    url: "/admin/system/action.php?action=maintance&value=" + $(this).val(),
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
            });
        });
    </script>
</body>

</html>