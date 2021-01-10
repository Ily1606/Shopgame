<?php
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else
    $page = 0;
$start = $page * 10;
$res = mysqli_query($conn, "SELECT * FROM table_product WHERE user_id = $id ORDER BY create_time DESC LIMIT $start,10");
$data = array();
$data["data"] = array();
while ($row = mysqli_fetch_array($res)) {
    $data_min = array();
    $data_min["id"] = $row["id"];
    $data_min["name"] = $row["name"];
    $data_min["descryption"] = $row["descryption"];
    $data_min["user_id"] = $row["user_id"];
    $data_min["money"] = number_format($row["money"])." VND";
    $data_min["type_game"] = $row["type_game"];
    $data_min["enable_sale"] = $row["enable_sale"];
    $data_min["selled"] = $row["selled"];
    $data_min["poster"] = array();
    $data_min["banner"] = array();
    $data_poster = json_decode($row["poster"], true);
    $data_banner = json_decode($row["banner"], true);
    for ($i = 0; $i < count($data_poster); $i++) {
        $poster_id = $data_poster[$i];
        $poster = mysqli_query($conn, "SELECT * FROM table_medias WHERE id = $poster_id");
        $row_poster = mysqli_fetch_assoc($poster);
        array_push($data_min["poster"], $row_poster["url_file"]);
    }
    for ($i = 0; $i < count($data_banner); $i++) {
        $banner_id = $data_banner[$i];
        $banner = mysqli_query($conn, "SELECT * FROM table_medias WHERE id = $banner_id");
        $row_banner = mysqli_fetch_assoc($banner);
        array_push($data_min["banner"], $row_banner["url_file"]);
    }
    array_push($data["data"],$data_min);
}
echo json_encode($data);
