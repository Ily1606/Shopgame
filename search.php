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
    <?php include_once("header.php"); ?>
    <link rel="stylesheet" href="/assets/css/main.css">
</head>

<body>
    <?php include_once("header_main.php"); ?>
    <?php include_once("nav.php") ?>
    <div class="container mt-4">
        <div class="card cover_page">
            <div class="card-body">
                <div class="card-title h3 mb-2">Kết quả tìm kiếm của <?php echo htmlspecialchars($_GET["q"]); ?></div>
                <div class="card-body">
                    <div id="product_list" class="row">
                        <?php
                        $keyword = mysqli_real_escape_string($conn, htmlspecialchars($_GET["q"]));
                        $count = explode(" ", $keyword);
                        $build_sql = "";
                        for ($i = 0; $i < count($count); $i++) {
                            $char = $count[$i];
                            if ($build_sql != "") $build_sql .= " UNION ALL ";
                            $build_sql .= "SELECT * FROM table_product WHERE (`name` LIKE '%$char%' OR `name` LIKE '%$char%') AND `status` = 1";
                        }
                        $build_sql = "SELECT COUNT(*) as count_result, result.* FROM (" . $build_sql . ") AS result GROUP BY result.id ORDER BY count_result DESC LIMIT 30";
                        $res = mysqli_query($conn, $build_sql);
                        if (mysqli_num_rows($res)) {
                            while ($row = mysqli_fetch_array($res)) {
                                $money = number_format($row["money"]) . " VND";
                                $selled = $row["selled"];
                                $data_poster = json_decode($row["poster"], true);
                                $data_poster = $data_poster[0];
                                $poster = mysqli_query($conn, "SELECT * FROM table_medias WHERE id = $data_poster");
                                $poster = mysqli_fetch_assoc($poster);
                        ?>
                                <div class="col-lg-3 col-sm-6 mt-2">
                                    <a class="col-sm-12 product_item d-block" href="/item.php?id=<?php echo $row["id"]; ?>">
                                        <img src="<?php echo $poster["url_file"] ?>">
                                        <div class="info_item">
                                            <div class="name_item"><?php echo $row["name"]; ?></div>
                                            <div class="des_item">
                                                <div class="float-left"><?php echo $money; ?></div>
                                                <div class="float-right">Đã bán: <?php echo $selled; ?></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php }
                        } else { ?>
                            <div class="h6">Không có kết quả tìm kiếm</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>