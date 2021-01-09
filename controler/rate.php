<?php
session_start();
include("../_connect.php");
include("../functions/Class.profile.php");
include("../functions/functions.php");
$check_login = check_login();
if ($check_login) {
    if (isset($_POST["product_id"]) && isset($_POST["rate"])) {
        $rate = mysqli_real_escape_string($conn, $_POST["rate"]);
        $product_id = mysqli_real_escape_string($conn, $_POST["product_id"]);
        $data = mysqli_query($conn, "SELECT * FROM table_product WHERE id =$product_id");
        $data = mysqli_fetch_assoc($data);
        $last_count = $data["count_voted"] + 1;
        $avg = ($data["stats"] * $data["count_voted"] + $rate) / $last_count;
        mysqli_query($conn, "UPDATE table_product SET stats = '$avg', count_voted = '$last_count' WHERE id = $product_id");
        echo json_encode(array("status" => true, "msg" => "Cảm ơn bạn đã đánh giá!"));
    }
} else {
    echo json_encode(array("status" => false, "msg" => "Bạn chưa đăng nhập!"));
}
