<?php
session_start();
include("../_connect.php");
include("../functions/Class.profile.php");
include("../functions/functions.php");
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
<?php include_once("../header.php"); ?>
</head>

<body class="theme-blush">
    <!-- Right Icon menu Sidebar -->
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
                        <li><a href="list_edit.php">Sửa danh mục</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle"><i class="fab fa-product-hunt"></i><span>Sản phẩm</span></a>
                    <ul class="ml-menu">
                        <li><a href="list_add.php">Danh sách sản phẩm</a></li>
                        <li><a href="list_add.php">Thêm sản phẩm</a></li>
                        <li><a href="list_edit.php">Sửa sản phẩm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle"><i class="fas fa-users"></i>  <span>Thành viên</span></a>
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
                <div class="col-lg-4 col-md-6 col-sm-12">
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
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Thông báo</strong></h2>
                        </div>
                        <div class="body">
                            <!--<div class="alert alert-success"> [2 tháng trước] -Mở buff like v2 ổn định chạy cho id post page . vip like avt ổn định</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $("body").on("click", ".ghym", function() {
                $.ajax({
                    url: "/modun/shoutbox.php?action=ghym",
                    method: "POST",
                    data: "id=" + $(this).attr("id_for"),
                    method: "POST",
                    success: function() {
                        window.location.reload();
                    }
                })
            });
            $("body").on("click", ".del", function() {
                $.ajax({
                    url: "/modun/shoutbox.php?action=delete",
                    method: "POST",
                    data: "id=" + $(this).attr("id_for"),
                    method: "POST",
                    success: function() {
                        window.location.reload();
                    }
                })
            });
            $("body").on("click", ".del_comment", function() {
                $.ajax({
                    url: "/modun/shoutbox.php?action=delete_comment",
                    method: "POST",
                    data: "id=" + $(this).attr("id_for"),
                    method: "POST",
                    success: function() {
                        window.location.reload();
                    }
                })
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("body").on("click", ".reply", function() {
                id = $(this).attr("id_for");
                if ($(this).hasClass("toogle_reply")) {
                    $("#reply_" + id).hide();
                    $(this).removeClass("toogle_reply");
                } else {
                    $(this).addClass("toogle_reply");
                    $("#reply_" + id).show();
                }
            });
            $("body").on("click", ".send_reply", function() {
                val = $(this).parents(".reply_for").find("textarea").val();
                if (val == "")
                    alert("Vui lòng không để trống!");
                else {
                    $.ajax({
                        url: "/modun/shoutbox.php?action=send_comment",
                        method: "POST",
                        data: "text_message=" + val + "&id_post=" + $(this).attr("for_id"),
                        success: function() {
                            window.location.reload();
                        }
                    })
                }
            })
            $("body").on("click", "#send_", function() {
                if ($("#value_message").value == "")
                    alert("Vui lòng không để trống!");
                else {
                    $(this).html('<i class="fa-spinner fa fa-spin"></i> Đang kiểm tra...').attr("disabled", true);
                    $.ajax({
                        url: "/modun/shoutbox.php?action=post",
                        method: "POST",
                        data: "text=" + $("#value_message").val(),
                        success: function() {
                            window.location.reload();
                        }
                    });
                }
            });
            var pageOffset = 1;
            $("#load_more").click(function() {
                $(this).html('<i class="fa-spinner fa fa-spin"></i> Đang tải...').attr("disabled", true);
                $(".bar").show();
                $.ajax({
                    url: "/modun/shoutbox.php?action=load_more",
                    method: "POST",
                    data: "page=" + pageOffset,
                    success: function(e) {
                        $(".bar").hide();
                        e = JSON.parse(e);
                        if (e.status) {
                            $(".body_content").append(e.html);
                            if (e.canScroll) {
                                pageOffset++;
                                $("#load_more").html('Xem thêm 10 bình luận').attr('disabled', false);
                            } else {
                                $("#load_more").html('Xem thêm 10 bình luận').attr('disabled', false).hide();
                            }
                        } else {
                            alert(e.msg);
                        }
                    }
                })
            });
            $("body").on("click", ".like", function() {
                $.ajax({
                    url: "/modun/shoutbox.php?action=reaction_post",
                    method: "POST",
                    data: "type=like&id=" + $(this).attr("id_for"),
                    success: function(e) {
                        window.location.reload();
                    }
                })
            });
            $("body").on("click", ".unlike", function() {
                $.ajax({
                    url: "/modun/shoutbox.php?action=reaction_post",
                    method: "POST",
                    data: "type=unlike&id=" + $(this).attr("id_for"),
                    success: function(e) {
                        window.location.reload();
                    }
                })
            });
        });
    </script>
</body>

</html>