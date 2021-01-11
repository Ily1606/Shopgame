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
    </div>

</div>