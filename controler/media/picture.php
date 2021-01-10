<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/_connect.php");
if(isset($_GET["id"])){
    $id = mysqli_real_escape_string($conn,$_GET["id"]);
    $res = mysqli_query($conn,"SELECT * FROM table_medias WHERE id = $id");
    $row = mysqli_fetch_assoc($res);
    $image = $row["url_file"];
    header("Location: $image");
    die;
}
