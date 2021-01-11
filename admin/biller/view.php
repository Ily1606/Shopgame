<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/functions.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/Class.profile.php");
if (check_login()) {
    $id = $_SESSION["id"];
    $account = new Profile($id);
    if ($account->get_role() == "admin") {
    } else {
        header("Location: /404.php");
        die;
    }
} else {
    header("Location: /404.php");
    die;
}
$res = mysqli_query($conn, "SELECT table_biller.*, table_product.poster, table_product.name FROM table_biller INNER JOIN table_product ON table_biller.id_product = table_product.id ORDER BY `status` DESC, create_time DESC");
?>
<html>
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/header.php"); ?>
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
                    <p class="h3 mb-2">Tất cả các đơn đặt hàng</p>
                    <div class="row">
                        <?php
                        if (mysqli_num_rows($res)) {
                            while ($row = mysqli_fetch_array($res)) {
                                $poster_id = json_decode($row["poster"]);
                                $poster_id = $poster_id[0];
                                $poster = mysqli_query($conn, "SELECT * FROM table_medias WHERE id = $poster_id");
                                $poster = mysqli_fetch_array($poster);
                        ?>
                                <div class="col-lg-3 col-sm-6 mt-2"><a class="col-sm-12 product_item d-block" href="/biller/biller.php?id=<?php echo $row["id"] ?>">
                                        <div class="ribbon" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; max-width: 150px;">
                                            <div>
                                                <?php if ($row["status"] == 0) echo "Đã hủy";
                                                elseif ($row["status"] == 1) echo "Đang xử lý";
                                                elseif ($row["status"] == 2) echo "Đang vận chuyển";
                                                elseif ($row["status"] == 3) echo "Đã nhận hàng";
                                                elseif ($row["status"] == 4) echo "Hàng lỗi - Đang đợi hoàn tiền";
                                                elseif ($row["status"] == 5) echo "Hàng lỗi - Đã hoàn tiền"; ?>
                                            </div>
                                        </div>
                                        <img src="<?php echo $poster["url_file"]; ?>">
                                        <div class="info_item">
                                            <div class="name_item"><?php echo $row["name"]; ?></div>
                                            <div class="des_item">
                                                <div class="float-left"><?php echo $row["money"] ?></div>
                                                <div class="float-right">Số lượng: <?php echo $row["soluong"] ?></div>
                                            </div>
                                        </div>
                                    </a></div>
                            <?php   }
                        } else { ?>
                            <div class="col-12">
                                Không có đơn đặt hàng nào
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>