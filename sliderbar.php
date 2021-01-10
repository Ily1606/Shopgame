<?php
include_once("_connect.php");
?>
<div class="body-left">
    <div class="main-left">
        <div class="all-flie"><i class="fas fa-bowling-ball"></i>
            <div class="word-all-information">Tất cả các danh mục</div>
        </div>
        <div class="tbody-left-border"></div>
        <div class="left-general-information">
            <div class="general-1"> <i class="fas fa-play"></i>Thể loại game</div>
        </div>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM table_games ORDER BY create_time ASC LIMIT 0,10");
        while ($row = mysqli_fetch_array($res)) {
        ?>
            <a href="/games.php?id=<?php echo $row["id"] ?>" class="general-2"><?php echo $row["name"] ?></a>
        <?php } ?>
        <div class="left-general-information">
            <div class="general-1"> <i class="fas fa-play"></i>Loại sản phẩm</div>
        </div>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM table_types ORDER BY create_time ASC LIMIT 0,10");
        while ($row = mysqli_fetch_array($res)) {
        ?>
            <a href="/types.php?id=<?php echo $row["id"] ?>" class="general-2"><?php echo $row["name"] ?></a>
        <?php } ?>
        <!--
        <div class="table-3">
            <div class="word-size">Khoảng giá</div>
            <div class="price-input">
                <input type="text" placeholder="Từ" class="input-1">
                <p class="space-price-input">đến</p>
                <input type="text" placeholder="Đến" class="input-1 space-price-input">
            </div>
            <div class="click-input">Áp Dụng</div>
        </div>
        <div class="tbody-left-border"></div>


        <div class="table-4">
            <div class="word-size">Tình trạng sản phẩm</div>
            <div class="general-3"><input type="radio" name="button-3" class="button-1" id="label-11"></input><label for="label-11">Sản phẩm mới</label></label></div>
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
        -->
    </div>

</div>