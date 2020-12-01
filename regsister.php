<?php
session_start();
if (isset($_SESSION["id"])) {
    header("Location: /");
    die;
}
?>

<!DOCTYPE html>
<html>
<?php include_once("header.php") ?>
</head>
<script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "7000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>

<body class="theme-blush">

    <div class="authentication">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">

                    <div class="header">
                        <img class="logo" src="../assets/images/favicon.png" alt="">
                        <h5>Đăng ký</h5>
                    </div>
                    <div class="body">
                        <form action="/moddle/user.php?action=regsister" method="POST" id="submit_form">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email của bạn" name="email">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Tên đăng nhập" name="username">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Số điện thoại" name="number_phone">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" placeholder="Họ" name="first_name">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" placeholder="Tên đệm" name="last_name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="radio inlineblock m-r-20">
                                    <input type="radio" name="gender" id="male" class="with-gap" value="1">
                                    <label for="male">Nam</label>
                                </div>
                                <div class="radio inlineblock m-r-20">
                                    <input type="radio" name="gender" id="female" class="with-gap" value="2">
                                    <label for="female">Nữ</label>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="re_password">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                            </div>
                            <div id="result"></div>
                            <button class="btn btn-primary btn-block waves-effect waves-light">ĐĂNG KÝ</button>
                        </form>
                    </div>
                    <div class="copyright text-center">
                        <a href="/login.php">Đăng nhập</a>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <img src="/assets/img/signin.svg" alt="Sign In" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script type="text/javascript">
        $(document).ready(function() {
            $("#submit_form").submit(function() {
                console.info("OK");
                $.ajax({
                    url: $(this).attr("action"),
                    method: $(this).attr("method"),
                    data: $(this).serialize(),
                    success: function(e) {
                        e = JSON.parse(e);
                        if (e.status) {
                            toastr.success(e.msg);
                            window.location.href = "/";
                        } else {
                            toastr.error(e.msg);
                        }
                    },
                    error: function(e) {
                        toastr.error("Có lỗi khi kết nối với máy chủ!");
                        console.error(e);
                    }
                });
                return false;
            });
        });
    </script>
</body>

</html>

</body>

</html>