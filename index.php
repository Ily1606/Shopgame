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
</head>

<body>
        <?php include_once("header_main.php"); ?>
        <?php include_once("nav.php") ?>
        <div class="image">
            <div class="main-img">
                <div class="img-left">
                    <div class="img-flex">
                        <div class="back" onclick="myBack()"><i class="fas fa-arrow-left"></i></div>
                        <div class="box-img"><img src="css3/image/games1.jpg" width="700px" height="400px"> </div>
                        <div class="next" onclick="myNext()"><i class="fas fa-arrow-right"></i></div>
                        <div class="li-flex">
                            <div class="border-li-1 border-li"></div>
                            <div class="border-li-2 border-li"></div>
                            <div class="border-li-3 border-li"></div>
                            <div class="border-li-4 border-li"></div>
                            <div class="border-li-5 border-li"></div>
                        </div>
                    </div>
                </div>
                <div class="img-right">
                    <img src="css3/image/games6.jpg" width="470px" ; height="200px">
                    <img src="css3/image/games7.jpg" width="470px;" height="195px" style="margin-top:5px;">

                </div>


            </div>
        </div>
        <div class="tbody">
            <div class="main-nav">
                <div class="nav-left"></div>
                <div class="nav-right">
                    <input type="button" value="<" id="back" style="padding: 8px; background-color:green; color:white; outline:none; border: none">
                    <div class="nav-flex">
                        <div class="nav-2" id="next-1">Bán Chạy</div>
                        <div class="nav-2" id="next-2">Mới Nhất</div>
                        <div class="nav-2" id="next-3">Phổ Biến</div>
                        <div class="nav-2" id="next-4">Trending</div>
                        <div class="nav-2" id="next-5">Sale ShopGame</div>
                        <div class="nav-2" id="next-6">Nhập Gifcode</div>
                        <div class="nav-2 hideen" id="next-7">Mới Nhất</div>
                        <div class="nav-2 hideen" id="next-8">Trending</div>
                        <div class="nav-2 hideen" id="next-9">Trending</div>
                        <div class="nav-2 hideen" id="next-10">Trending</div>
                    </div>
                    <input type="button" value=">" id="next" style="padding: 8px; background-color:green; color:white;margin-left: 30px; outline:none; border: none" onclick="Mynext()">
                </div>

            </div>
        </div>
        <div class="body-main">
            <div class="body-left">
                <div class="main-left">
                    <div class="all-flie"><i class="fas fa-bowling-ball"></i>
                        <div class="word-all-information">Tất cả các danh mục</div>
                    </div>
                    <div class="tbody-left-border"></div>
                    <div class="left-general-information">
                        <div class="general-1"> <i class="fas fa-play"></i>Thể loại game</div>
                    </div>

                    <div class="general-2-0">CS Go</div>
                    <div class="general-2">Liên minh huyền thoại</div>
                    <div class="general-2">Liên minh tốc chiến</div>
                    <div class="general-2">PUBG</div>
                    <div class="general-2">Free Fire</div>
                    <div class="general-2">Liên quân mobile</div>
                    <div class="general-2">Apex Lengends</div>
                    <div class="general-2">Thêm <i class="fas fa-angle-down"></i></div>



                    <div class="search-fortune">
                        <div class="tbody-left-border"></div>
                        <div class="general-1"> <i class="fab fa-phoenix-squadron"></i>Bộ Lọc Tìm Kiếm</div>
                    </div>

                    <div class="table-1">
                        <div class="word-size">Nơi Bán</div>
                        <div class="general-3"><input type="radio" name="button" class="button-1" id="label-1"></input><label for="label-1">Đà Nẵng</label></div> <!-- checkbox nơi bán -->
                        <div class="general-3"><input type="radio" name="button" class="button-1" id="label-2"></input><label for="label-2">Hồ Chí Minh</label></div> <!-- checkbox nơi bán -->
                        <div class="general-3"><input type="radio" name="button" class="button-1" id="label-3"></input><label for="label-3">Hà Nội</label></div> <!-- checkbox nơi bán -->
                        <div class="general-3"><input type="radio" name="button" class="button-1" id="label-4"></input><label for="label-4">Quảng Trị</label></div> <!-- checkbox nơi bán -->
                        <div class="general-3 inset"><input type="radio" name="button" class="button-1" id="label-5"></input><label for="label-5">Thêm</label> <i class="fas fa-angle-down"></i></div> <!-- checkbox nơi bán -->
                        <div class="tbody-left-border">
                               <div class="hidden"><input type="radio" name="button" class="button-1" id="label-100"></input><label for="label-100">Gia Lai</div>
                               <div class="hidden"><input type="radio" name="button" class="button-1" id="label-101"></input><label for="label-101">An Giang</div>
                               <div class="hidden"><input type="radio" name="button" class="button-1" id="label-102"></input><label for="label-102">Bắc Ninh</div>
                        </div>
                    </div>

                    <div class="table-2">
                        <div class="word-size">Đơn vị vận chuyển</div>
                        <div class="general-3"><input type="radio" name="button-1" class="button-1" id="label-6"></input><label for="label-6">Shopgame</label></div> <!-- checkbox nơi bán -->
                        <div class="general-3"><input type="radio" name="button-1" class="button-1" id="label-7"></input><label for="label-7">Giao hàng tiết kiệm</label></div> <!-- checkbox nơi bán -->
                        <div class="general-3"><input type="radio" name="button-1" class="button-1" id="label-8"></input><label for="label-8">Giao hàng nhanh</label></label></div> <!-- checkbox nơi bán -->
                        <div class="general-3"><input type="radio" name="button-1" class="button-1" id="label-10"></input><label for="label-10">Thêm</label><i class="fas fa-angle-down"></i></div> <!-- checkbox nơi bán -->
                        <div class="tbody-left-border"></div>
                    </div>

                    <div class="table-3">
                        <div class="word-size">Khoảng giá</div>
                        <div class="price-input">
                            <input type="text" placeholder="Từ" class="input-1">
                            <p class="space-price-input">-></p>
                            <input type="text" placeholder="Đến" class="input-1 space-price-input">
                        </div>
                        <div class="click-input">Áp Dụng</div>
                    </div>
                    <div class="tbody-left-border"></div>


                    <div class="table-4">
                        <div class="word-size">Tình trạng sản phẩm</div>
                        <div class="general-3"><input type="radio" name="button-3" class="button-1" id="label-11"></input><label for="label-11">Sản phẩm mới</label></label></div> <!-- checkbox nơi bán -->
                        <div class="general-3"><input type="radio" name="button-3" class="button-1" id="label-12"></input><label for="label-12">Sản phẩm cũ</label></div>
                    </div>
                    <div class="tbody-left-border"></div>


                    <div class="table-5">
                        <div class="word-size">Đánh giá</div>
                        <div class="star_group">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star fa-star-1"></i>
                            <i class="fas fa-star fa-star-1"></i>
                            <i class="fas fa-star fa-star-1"></i>
                            <i class="fas fa-star fa-star-1"></i>
                            <div class="star-full">Đầy Đủ</div>
                        </div>

                        <div class="star_group">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star fa-star-1"></i>
                            <i class="fas fa-star fa-star-1"></i>
                            <i class="fas fa-star fa-star-1"></i>
                            <i class="far fa-star far-star-2"></i>
                            <div class="star-full">4 sao</div>
                        </div>

                        <div class="star_group">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star fa-star-1"></i>
                            <i class="fas fa-star fa-star-1"></i>
                            <i class="far fa-star far-star-2"></i>
                            <i class="far fa-star far-star-2"></i>
                            <div class="star-full">3 sao</div>
                        </div>

                        <div class="star_group">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star fa-star-1"></i>
                            <i class="far fa-star far-star-2"></i>
                            <i class="far fa-star far-star-2"></i>
                            <i class="far fa-star far-star-2"></i>
                            <div class="star-full">2 sao</div>
                        </div>

                        <div class="star_group">
                            <i class="fas fa-star"></i>
                            <i class="far fa-star far-star-2"></i>
                            <i class="far fa-star far-star-2"></i>
                            <i class="far fa-star far-star-2"></i>
                            <i class="far fa-star far-star-2"></i>
                            <div class="star-full">1 sao</div>
                        </div>

                    </div>
                    <div class="tbody-left-border"></div>
                    <div class="click-input">Mua Ngay</div>
                </div>

            </div>
            <div class="body-right">
                <div class="sort">
                    <div class="sort-div">Sắp xếp theo</div>
                    <div class="sort-padding-top">
                        <input type="text" placeholder="Phổ Biến" class="body-right-border body-right-border-3" disabled="disabled">
                        <input type="text" placeholder="Mới Nhất" class="body-right-border" disabled="disabled">
                        <input type="text" placeholder="Bán Chạy" class="body-right-border" disabled="disabled">
                        <input type="text" placeholder="Trending" class="body-right-border" disabled="disabled">
                        <input type="text" placeholder="Giá" class="body-right-border-2"><i class="fas fa-arrow-circle-down"></i>
                        <div class="click-sort">Áp Dụng</div>
                    </div>
                </div>
                <div class="flex-img">
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>
                    <div class="border-img-0"><img src="css3/image/Ban-Hang.jpg" class="grenal-img">
                        <div class="informatiton">
                            <p class="word-information">Mã sản phẩm</p>
                        </div>
                        <div class="word-information d-flex">
                            <div class="progress">
                                <div class="progress_bar"></div>
                                <div class="text_progess">40%</div>
                            </div>
                        </div>
                        <div class="d-flex star_rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class=" d-flex">
                            <div class="col-left">
                                <div class="price">
                                    <div class="font-size-p">150.000 VND</div>
                                </div>
                            </div>
                            <div class="col-right">
                                Đà Nẵng
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="footer">
        <div class="border-footer"></div>
        <div class="main-footer">
            <div class="footer-1-flex">
                <div class="footer-1">
                    <i class="fas fa-undo-alt"></i>
                    <div class="footer-1-word">
                        <p>7 ngày miễn phí trả hàng</p>
                        <p>Trả hàng miễn phí trong 7 ngày</p>
                    </div>
                </div>

                <div class="footer-2 footer-2-1">
                    <i class="fas fa-user-shield"></i>
                    <div class="footer-1-word">Hàng chính hãng 100% &nbsp; &nbsp;&nbsp; &nbsp; Đảm bảo hàng chính hãng hoặc hoàn tiền gấp đôi</div>
                </div>

                <div class="footer-3">
                    <i class="fas fa-truck-moving"></i>
                    <div class="footer-1-word">Miễn phí vận chuyển &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; Giao hàng miễn phí toàn quốc</div>
                </div>
            </div>

            <div class="border-footer-1"></div>
            <div><img src="css3/image/demo.png" style="width:100%"></div>
            <div class="border-footer-1"></div>
            <div style="text-align:center; padding: 10px 0px;">Địa chỉ: Tầng 28, Tòa nhà trung tâm Lotte Hà Nội, 54 Liễu Giai, phường Cống Vị, Quận Ba Đình, Hà Nội. Tổng đài hỗ trợ: 19001221 - Email: cskh@hotro.shopgame.vn</div>
            <div style="text-align:center;">Mã số doanh nghiệp: 0106773786 do Sở Kế hoạch & Đầu tư TP Hà Nội cấp lần đầu ngày 10/02/2015</div>
            <div style="text-align:center; padding: 10px 0px;">© 2015 - Bản quyền thuộc về Công ty TNHH Shopgame</div>

        </div>



    </div>
</body>
<script type="text/javascript">
    function myFunction() {
        var khoi = document.querySelectorAll(".fixed");
        khoi[0].classList.add("move");
        var khoi = document.querySelectorAll(".fixed-1");
        khoi[0].classList.add("move_1");
    }

    function myShow() {
        var show = document.querySelectorAll(".fixed-1");
        show[0].classList.remove("move_1");
        var show = document.querySelectorAll(".fixed");
        show[0].classList.remove("move");
    }


    var slider_poster = document.querySelectorAll('.box-img');
    slider_poster = slider_poster[0];
    var image = ['games1', 'games2', 'games3', 'games4', 'games5']
    var i = image.length;
    var start = true;

    function myNext() {
        if (start == true) {
            i = 2;
            start = false;
        } else {
            if (i < image.length) {
                i = i + 1;
            } else {
                i = 1;
            }
        }
        slider_poster.innerHTML = '<img src="/css3/image/' + image[i - 1] + '.jpg" width="700px" height="400px"/>';
        slider_poster[0].classList.add("img_animation_1");
    }

    function myBack() {
        if (i == 1)
            i = image.length;
        else
            i--;
        slider_poster.innerHTML = '<img src="/css3/image/' + image[i - 1] + '.jpg"  width="700px" height="400px"/>';
    }


</script>

</html>