<?php
session_start();
if(isset($_SESSION["id"])){
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
                        <h5>Đăng nhập</h5>
                    </div>
                    <div class="body">
                        <form action="/moddle/user.php?action=login" method="POST" id="submit_form">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Tên đăng nhập" name="username">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                            </div>
                            <div class="checkbox">
                                <input id="remember_me" type="checkbox">
                                <label for="remember_me">Ghi nhớ</label>
                            </div>
                            <div id="result"></div>
                            <button class="btn btn-primary btn-block waves-effect waves-light">ĐĂNG NHẬP</button>
                        </form>
                    </div>
                    <div class="copyright text-center">
                        <a href="/regsister.php">Đăng ký</a>
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