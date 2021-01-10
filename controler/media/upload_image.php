<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/functions.php");
if (check_login()) {
    $id = $_SESSION["id"];
    $array_file_photos = [];
    foreach ($_FILES as $key => $value) {
        if ($value["error"] == 0) {
            $file_type = $_FILES[$key]['type'];
            $expensions = ['image/jpeg', 'image/png', 'image/jpg'];
            if (in_array($file_type, $expensions) === true) {
                if ($_GET["action"] == "poster") {
                    $res_upload = upload_image($key, "/storage/images/", $id . "_" . getdate()[0] * random_int(1, 1000000), "avatar");
                } else {
                    $res_upload = upload_image($key, "/storage/images/", $id . "_" . getdate()[0] * random_int(1, 1000000), "cover");
                }
                array_push($array_file_photos, array("url" => $res_upload["url"], "info" => $res_upload["info"]));
            }
            $id_photos = [];
            foreach ($array_file_photos as $photos) {
                $url = $photos["url"];
                if (mysqli_query($conn, "INSERT INTO table_medias (`type`,`user_upload`,`url_file`) VALUES ('images',$id,'$url')")) {
                    array_push($id_photos, mysqli_insert_id($conn));
                }
                echo json_encode($id_photos);
            }
        }
    }
}
