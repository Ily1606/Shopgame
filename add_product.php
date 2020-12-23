<?php
session_start();
include_once("_connect.php");
include_once("functions/Class.profile.php");
include_once("functions/functions.php");
$check_login = check_login();
if ($check_login) {
    $id = $_SESSION["id"];
    $account = new Profile($id);
    $username = $account->get_username();
}
?>
<DOCTYPE html></DOCTYPE>
<html>

<head>
    <meta charset="utf-8">
    <title>Shopgame</title>
    <link rel="stylesheet" href="/css3/index.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css" />
</head>

<body>
    <?php include_once("header_main.php"); ?>
    <?php include_once("nav.php") ?>
    <div style="width:1224px; margin:auto">
        <div class="container bg-light">
            <div class="border-0 pt-2 pb-2 mt-3">
                <div class="row">
                    <div class="col-6">
                        <input type="checkbox">
                        <p class="d-inline  ml-3">Sản phẩm</p>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">Đơn giá</div>
                            <div class="col-3">Số lượng</div>
                            <div class="col-3">Số tiền</div>
                            <div class="col-3">Thao tác</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container bg-light mt-3">
        <div class="border-0 pt-2 pb-2">
        <input type="checkbox">
        <p class="d-inline  ml-3">Nhà cung cấp <i class="fas fa-comment"></i></p>
        <div class="border mt-4">
            <div class="bg-primary text-white p-2">
                <p class="d-inline pl-5">Mua kèm sale đặc quyền</p>
                <p class="d-inline ml-5">Thêm></p>
            </div>
            <div class="ml-5 mt-3 d-flex">
            <div class="row" style="width:100%">
                <div class="col-2">
            <input type="checkbox" class="ml-2">
            <img src="/assets/img/avatar.jpg" width="100px" heigh="50px">
            </div>
            <div class="col-2">
            <p>Mua kèm sale đặc quyền</p>   
            </div>
            <div class="col-2">
                <p>Phân loại hàng<i class="fas fa-angle-down"></i></p>
                <p>Đỏ, XXL</p>
                <p>80kg</p>
            </div>
            <div class="col-2 d-flex pt-4">
                <div style="font-size:0.75em;text-decoration-line:line-through" class="d-inline mb-2">đ</div>
                <div class="d-inline" style="text-decoration-line:line-through">200.000</div>
              
                <div style="font-size:0.75em" class="d-inline ml-2">đ</div>
                <div class="d-inline">100.000</div> 
            </div>
            <div class="col-2 pt-4 text-center">
                <input type="button" value="-" style="width:25px">
                <input type="button" value="1" style="width:25px">
                <input type="button" value="+" style="width:25px">
            </div>
            <div class="col-2 text-center" style="color:red">
               <p>Xoá</p>
                <p>Tìm sản phẩm</p>
                <p>Tương tự <i class="fas fa-angle-down"></i></p>

            </div>
        
            </div>
            </div>
        </div>
            <hr>  
        <div class="text-success">
        <i class="fab fa-codepen d-inline"></i>
        <p class="d-inline ml-2">Nhập mã giảm giá hoặc đơn vị mua bán</p>
        </div>
        </div>

        </div>
        <div class="container bg-light mt-3">
             <div class="row  pt-2">
                 <div class="col-6"></div>
                 <div class="col-4 text-success"><i class="fab fa-codepen d-inline"></i>Voucher</div>
                 <div class="col-2">Chọn hoặc nhập mã</div>
             </div>
             <hr> 
             <div class="row ">
                 <div class="col-6"></div>
                 <div class="col-2 text-success"><i class="fab fa-codepen d-inline"></i>Shopgame Sale</div>
                 <div class="col-3">Không thể sử dụng mã</div>
                 <div class="col-1">-0đ</div>
             </div>
             <hr> 
        <div class="row">
            <div class="col-2">
                <input type="checkbox">
                <p class="d-inline ml-2">Chọn tất cả (2)</p>
            </div>
            <div class="col-1">
                <p>Xóa</p>
            </div>
            <div class="3">
                <p style="color:red">Lưu vào mục đã thực hiện</p>
            </div>
            <div class="col-4 text-center">
                <span>Tổng tiền mua hàng(0 sản phẩm): <span style="font-size:20px; color:red"></span>đ</span>
                <span style="font-size:30px; color:red">0</span>
                <div class="text-warning">Nhận thêm 0 xu</div>
            </div>
         
            <div class="col-2 mt-2">
              <input type="button" value="Mua ngay" class="w-100 h-50 text-white border-0" style="background-color:red; outline:none;" > 
            </div>
        </div> 
             
        </div>
    </div>
</body>

</html>