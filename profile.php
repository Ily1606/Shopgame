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
<script src="/assets/selectize/js/standalone/selectize.js"></script>
<link rel="stylesheet" href="/assets/selectize/css/selectize.bootstrap2.css">
<link rel="stylesheet" href="/assets/selectize/css/selectize.css">
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
                <div class="card-body" style="min-height: unset">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-tab" data-toggle="tab" href="#add_product" role="tab" aria-controls="add_product" aria-selected="true">Thêm sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Danh sách sản phẩm</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="tab-content col-12">
                <div class="tab-pane fade show active" id="add_product" role="tabpanel" aria-labelledby="product-tab">
                    <div class="card cover_page">
                        <div class="card-body">
                            <div class="card-title h3 mb-2">Thêm sản phẩm mới</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form action="/controler/products/product.php?action=add" method="POST" class="form_submit">
                                            <div class="form-group">
                                                <label for="name">Tên sản phẩm</label>
                                                <input type="text" name="name" id="name" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="des">Mô tả</label>
                                                <textarea type="text" name="des" id="des" placeholder="Mô tả ngắn về sản phẩm..." rows="5" class="form-control" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="number">Số lượng</label>
                                                <input type="number" name="number" id="number" class="form-control" min="1" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="number">Giá tiền</label>
                                                <input type="number" name="money" id="money" class="form-control" min="1" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="list_game">Danh mục game</label>
                                                <select id="select-games" class="games" name="game_types" placeholder="Tìm game..." required></select>
                                            </div>
                                            <div class="form-group">
                                                <label for="list_game">Loại sản phẩm</label>
                                                <select id="select-types" class="types" name="type" placeholder="Tìm loại sản phẩm..." required></select>
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
                                            <input type="hidden" name="poster" value="[]" id="poster">
                                            <input type="hidden" name="banner" value="[]" id="banner">
                                            <div class="form-group">
                                                <button class="btn btn-success submit_form">Đăng lên</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-control poster m-auto">
                                            <label>Upload poster</label>
                                            <label class="file-upload-wrapper" for="input-file-poster">
                                                <input type="file" id="input-file-poster" class="file-upload d-none" attr_form="controler/media/upload_image.php?action=poster" for_id="poster" />
                                                <div class="image_preview"></div>
                                            </label>
                                            <small class="muted">Yêu cầu ảnh có kích thước dạng 3x4</small>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 0%"></div>
                                            </div>
                                        </div>
                                        <div class="form-control mt-2">
                                            <label>Upload banner</label>
                                            <label class="file-upload-wrapper" for="input-file-banner">
                                                <input type="file" id="input-file-banner" class="file-upload d-none" attr_form="controler/media/upload_image.php?action=banner" for_id="banner" />
                                                <div class="image_preview"></div>
                                            </label>
                                            <small class="muted">Yêu cầu ảnh có kích thước dạng 16x9</small>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 0%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card cover_page">
                        <div class="card-body">
                            <div class="card-title h3 mb-2">Sản phẩm của người dùng</div>
                            <div class="card-body">
                                <div id="product_list" class="row">

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
                        btn_target.html(html);
                        if (e.status) {
                            toastr.success(e.message);
                            window.location.reload();
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

            function render_list_product(item) {
                $("#product_list").append('<div class="col-lg-3 col-sm-6 mt-2"><div class="col-sm-12 product_item"><img src="' + item.poster[0] + '"><div class="info_item"><div class="name_item">' + item.name + '</div><div class="des_item"><div class="float-left">' + item.money + '</div><div class="float-right">Đã bán: ' + item.selled + '</div></div></div></div></div>');
            }
            $.ajax({
                url: "/controler/products/product.php?action=view",
                success: function(e) {
                    e = JSON.parse(e);
                    e = e.data;
                    for (i = 0; i < e.length; i++) {
                        render_list_product(e[i]);
                    }
                },
                error: function(e) {
                    toastr.error("Có lỗi khi tải sản phẩm của người dùng!");
                }
            })
            $("#input-file-poster, #input-file-banner").change(function() {
                var blob_file = URL.createObjectURL($(this)[0].files[0]);
                $(this).parent().find(".image_preview").html('<img src="' + blob_file + '" width="100%" height="100%">');
                $(this).parent().parent().find('.progress-bar').css({
                    "width": "80%"
                });
                $_this = $(this);
                var formData = new FormData();
                formData.append('file', $(this)[0].files[0]);
                $.ajax({
                    url: $(this).attr("attr_form"),
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(e) {
                        e = JSON.parse(e);
                        $_this.parent().parent().find('.progress-bar').css({
                            "width": "100%"
                        }).addClass("bg-success");
                        input_target = $("#" + $_this.attr("for_id"));
                        var data = JSON.parse(input_target.val());
                        data = data.concat(e)
                        input_target.val(JSON.stringify(data));
                        toastr.success("Upload ảnh thành công!");
                    },
                    error: function(e) {
                        toastr.error("Có lỗi khi upload ảnh!");
                    }
                });
            });
            $("#enable_sale").change(function() {
                if ($(this).is(":checked")) {
                    $(".moddle_sale").fadeIn()
                } else {
                    $(".moddle_sale").fadeOut()
                }
            });
            $('#select-games').selectize({
                theme: 'repositories',
                valueField: 'game_id',
                labelField: 'game_name',
                searchField: 'game_name',
                options: [],
                create: true,
                render: {
                    option: function(item, escape) {
                        return '<div>' +
                            '<span class="title">' +
                            '<span class="name">' + escape(item.game_name) + '</span>' +
                            '</div>';
                    }
                },
                create: function(input, callback) {
                    $.ajax({
                        url: '/controler/games.php?action=create',
                        type: 'GET',
                        data: {
                            q: input
                        },
                        error: function() {
                            toastr.error("Có lỗi khi kết nối với máy chủ, vui lòng thử lại.");
                        },
                        success: function(res) {
                            res = JSON.parse(res);
                            if (res["status"]) {
                                callback({
                                    value: res.id,
                                    text: input
                                });
                                toastr.success(res.message);
                            } else {
                                toastr.error(res.message);
                            }
                        }
                    })
                },
                load: function(query, callback) {
                    if (!query.length) return callback();
                    $.ajax({
                        url: '/controler/games.php?action=search&q=' + encodeURIComponent(query),
                        type: 'GET',
                        error: function() {
                            callback();
                        },
                        success: function(res) {
                            callback(res);
                        }
                    });
                }
            });
            $('#select-types').selectize({
                valueField: 'type_id',
                labelField: 'type_name',
                searchField: 'type_name',
                options: [],
                create: true,
                render: {
                    option: function(item, escape) {
                        return '<div>' +
                            '<span class="title">' +
                            '<span class="name">' + escape(item.type_name) + '</span>' +
                            '</div>';
                    }
                },
                create: function(input, callback) {
                    $.ajax({
                        url: '/controler/type.php?action=create',
                        type: 'GET',
                        data: {
                            q: input
                        },
                        error: function() {
                            toastr.error("Có lỗi khi kết nối với máy chủ, vui lòng thử lại.");
                        },
                        success: function(res) {
                            res = JSON.parse(res);
                            if (res["status"]) {
                                callback({
                                    value: res.id,
                                    text: input
                                });
                                toastr.success(res.message);
                            } else {
                                toastr.error(res.message);
                            }
                        }
                    })
                },
                load: function(query, callback) {
                    if (!query.length) return callback();
                    $.ajax({
                        url: '/controler/type.php?action=search&q=' + encodeURIComponent(query),
                        type: 'GET',
                        error: function() {
                            callback();
                        },
                        success: function(res) {
                            callback(res);
                        }
                    });
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

        .product_item {
            height: 350px;
            background: #eee;
            padding: 17px;
            border-radius: 10px;
        }

        .product_item>img {
            height: 250px;
            width: 100%;
        }

        .name_item {
            font-weight: bold;
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</body>

</html>