<?php
session_start();
include("../_connect.php");
include("../functions/Class.profile.php");
include("../functions/functions.php");
$check_login = check_login();
if ($check_login) {
    $id = $_SESSION["id"];
    $account = new Profile($id);
    if ($account->get_res() == false) {
        header("Location: /404.php");
        die;
    }
} else {
    header("Location: /404.php");
    die;
}
?>
<html>
<?php include_once("../header.php"); ?>
<script src="/assets/selectize/js/standalone/selectize.js"></script>
<link rel="stylesheet" href="/assets/selectize/css/selectize.bootstrap2.css">
<link rel="stylesheet" href="/assets/selectize/css/selectize.css">
<link rel="stylesheet" href="/assets/css/main.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="card cover_page mt-2">
                <div class="card-body">
                    <p class="h3 mb-2">Cập nhật thông tin tài khoản</p>
                    <div class="row">
                        <div class="col-md-6">
                            <form class="form_submit" method="POST" action="/controler/profile.php?action=update_info">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" name="email" type="email" id="email" value="<?php echo $account->get_email(); ?>">
                                </div>
                                <div class="form-group">
                                    <div class="d-inline-block">
                                        <label for="firstname">Họ</label>
                                        <input class="form-control" name="firts_name" id="firstname" type="text" value="<?php echo $account->get_fỉrstname(); ?>">
                                    </div>
                                    <div class="d-inline-block">
                                        <label for="lastname">Tên</label>
                                        <input class="form-control" name="last_name" type="text" id="lastname" value="<?php echo $account->get_lastname(); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Số điện thoại</label>
                                    <input class="form-control" name="number_phone" type="text" value="<?php echo $account->get_number_phone(); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Giới tính</label>
                                    <select name="gender" class="form-control" id="gender">
                                        <option value="1">Nam</option>
                                        <option value="2">Nữ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success submit_form">
                                        Lưu thông tin
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form class="form_submit" action="/controler/profile.php?action=update_password" method="POST">
                                <div class="form-group">
                                    <label for="old_password">Mật khẩu cũ</label>
                                    <input type="password" name="old_password" id="old_password" class="form-control">
                                    <small>Để trống nếu bạn đăng nhập bằng tài khoản mạng xã hội</small>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Mật khẩu mới</label>
                                    <input type="password" name="new_password" id="new_password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="renew_password">Nhập lại mật khẩu</label>
                                    <input type="password" name="renew_password" id="renew_password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary submit_form">Đổi mật khẩu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $(".form_submit").submit(function() {
            var btn_target = $(this).find(".submit_form");
            html = btn_target.text();
            btn_target.html('<i class="fa-spinner fa fa-spin"></i> Đang kiểm tra...').attr('disabled', true);
            $.ajax({
                url: $(this).attr("action"),
                method: $(this).attr("method"),
                data: $(this).serialize(),
                success: function(e) {
                    e = JSON.parse(e);
                    btn_target.html(html).attr("disabled", false);
                    if (e.status) {
                        toastr.success(e.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    } else {
                        toastr.error(e.message);
                    }
                },
                error: function(e) {
                    toastr.error("Có lỗi khi kết nối với máy chủ");
                }
            });
            return false;
        })
    });
</script>

</html>