<?php
session_start();
include("_connect.php");
include("functions/Class.profile.php");
include("functions/functions.php");
$check_login = check_login();
if (isset($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    $account = new Profile($id);
    if ($account->get_res() == false) {
        header("HTTP/1.0 404 Not Found");
        die;
    }
} else {
    header("HTTP/1.0 404 Not Found");
    die;
} ?>
<html>
<?php include_once("header.php"); ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="card cover_page mt-2" style="height: 400px;">
                <div class="row m-2">
                    <div class="col-lg-4">
                        <p class="h3 mb-2">Thông tin tài khoản</p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <div class="avatar">
                                    <img src="/assets/img/avatar.jpg" class="rounded-circle" width="100px" height="100px">
                                    <div class="upload"><i class="fas fa-cloud-upload-alt"></i></div>
                                </div>
                            </li>
                            <li class="list-inline-item align-middle">
                                <button class="btn btn-success d-block">Cập nhật thông tin</button>
                                <button class="btn btn-danger d-block">Xóa tài khoản</button>
                            </li>
                        </ul>
                        <ul class="list-inline">
                            <li class="list-inline-item up-case"><?php echo $account->get_username() ?></li>
                        </ul>
                        <ul class="list-inline">
                            <li class="list-inline-item"><i class="far fa-edit"></i></li>
                            <li class="list-inline-item"><?php echo $account->get_fullname() ?></li>
                        </ul>
                        <ul class="list-inline">
                            <li class="list-inline-item"><i class="far fa-envelope"></i></li>
                            <li class="list-inline-item"><?php echo $account->get_email() ?></li>
                        </ul>
                        <ul class="list-inline">
                            <li class="list-inline-item"><i class="fas fa-phone"></i></li>
                            <li class="list-inline-item"><?php echo $account->get_number_phone() ?></li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <p class="h3 mb-2">Các thành tựu</p>
                    </div>
                    <div class="col-lg-4">

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card cover_page">
                <div class="card-body">
                    <div class="card-title h3 mb-2">Thêm sản phẩm mới</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Tên sản phẩm</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="des">Mô tả</label>
                                    <textarea type="text" name="des" id="des" placeholder="Mô tả ngắn về sản phẩm..." rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="number">Số lượng</label>
                                    <input type="number" name="number" id="number" class="form-control" min="1">
                                </div>
                                <div class="form-group">
                                    <label for="list_game">Danh mục game</label>
                                    <select name="list_game" id="list_game" class="form-control">
                                        <option value="1">Liên minh huyền thoại</option>
                                        <option value="2">Liên minh tốc chiến</option>
                                        <option value="3">PUBG - PlayerUnknown's Battlegrounds</option>
                                        <option value="4">Apex Lengends</option>
                                        <option value="5">Free fire</option>
                                        <option value="6">Liên Quân Mobile</option>
                                        <option value="7">MineCraft</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox inlineblock m-r-20">
                                        <input type="checkbox" name="enable_sale" id="enable_sale" class="with-gap" value="1" checked>
                                        <label for="enable_sale">Áp dụng chương trình sale</label>
                                    </div>
                                </div>
                                <div class="moddle_sale">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="from_sale">Áp dụng từ</label>
                                                <input type="date" name="from_sale" class="form-control" id="from_sale">
                                            </div>
                                            <div class="col-6">
                                                <label for="end_sale">Hết hạn vào</label>
                                                <input type="date" name="end_sale" class="form-control" id="end_sale">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="money_sale">Giảm</label>
                                        <input type="number" name="money_sale" id="money_sale" class="form-control" min="0" max="100">%
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success">Đăng lên</button>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-control poster m-auto">
                                    <label>Upload poster</label>
                                    <label class="file-upload-wrapper" for="input-file-poster">
                                        <input type="file" id="input-file-poster" class="file-upload d-none" />
                                        <div class="image_preview"></div>
                                    </label>
                                    <small class="muted">Yêu cầu ảnh có kích thước dạng 3x4</small>
                                </div>
                                <div class="form-control mt-2">
                                    <label>Upload banner</label>
                                    <label class="file-upload-wrapper" for="input-file-banner">
                                        <input type="file" id="input-file-banner" class="file-upload d-none" />
                                        <div class="image_preview"></div>
                                    </label>
                                    <small class="muted">Yêu cầu ảnh có kích thước dạng 16x9</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#input-file-poster, #input-file-banner").change(function() {
                var blob_file = URL.createObjectURL($(this)[0].files[0]);
                $(this).parent().find(".image_preview").html('<img src="' + blob_file + '" width="100%" height="100%">')
            });
            $("#enable_sale").change(function() {
                if ($(this).is(":checked")) {
                    $(".moddle_sale").fadeIn()
                } else {
                    $(".moddle_sale").fadeOut()
                }
            })
        })
    </script>
    <style>
        body {
            background-color: #f0f0f0;
        }

        .cover_page {
            width: 100%;
            background: #FFFFFF;
            border-radius: 10px;
        }

        .up-case {
            font-weight: bold;
            text-transform: uppercase;
        }

        .avatar {
            position: relative;
        }

        .upload {
            position: absolute;
            bottom: 5px;
            right: 50%;
            font-size: 20px;
            transform: translateX(50%);
            opacity: 0;
            transition: all 0.5s;
        }

        .avatar:hover>.upload {
            opacity: 1;
        }

        .file-upload-wrapper {
            width: 100%;
            height: 300px;
            border: 2px dashed #BDBDBD;
            position: relative;
        }

        .poster {
            width: 50%;
        }

        .poster>.file-upload-wrapper {
            height: 250px;
        }

        .file-upload-wrapper::after {
            content: 'Chọn file';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</body>

</html>