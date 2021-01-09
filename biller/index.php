<?php
session_start();
include("../_connect.php");
include("../functions/Class.profile.php");
include("../functions/functions.php");
$check_login = check_login();
if ($check_login) {
    $id = $_SESSION["id"];
    $account = new Profile($id);
    if ($account->get_res() == false) {
        header("Location: /404.php");
        die;
    }
} else {
    header("Location: /404.php");
    die;
}
$res = mysqli_query($conn, "SELECT table_biller.*, table_product.poster, table_product.name FROM table_biller INNER JOIN table_product ON table_biller.id_product = table_product.id WHERE table_biller.user_id = $id ORDER BY table_biller.create_time DESC");
?>
<html>
<?php include_once("../header.php"); ?>
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
                    <p class="h3 mb-2">Các đơn đặt hàng của bạn</p>
                    <div class="row">
                        <?php
                        if (mysqli_num_rows($res)) {
                            while ($row = mysqli_fetch_array($res)) {
                                $poster_id = json_decode($row["poster"]);
                                $poster_id = $poster_id[0];
                                $poster = mysqli_query($conn, "SELECT * FROM table_medias WHERE id = $poster_id");
                                $poster = mysqli_fetch_array($poster);
                        ?>
                                <div class="col-lg-3 col-sm-6 mt-2"><a class="col-sm-12 product_item d-block" href="/biller/biller.php?id=<?php echo $row["id"] ?>"><img src="<?php echo $poster["url_file"]; ?>">
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