<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/functions.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/Class.profile.php");
if (check_login()) {
    $id = $_SESSION["id"];
    $account = new Profile($id);
    if ($account->get_role() == "admin") {
        if ($_GET["action"] == "banner") {
            $user_id = mysqli_real_escape_string($conn, $_GET["id"]);
            $target_account = new Profile($user_id);
            if ($target_account->get_status() == 0) {
                if (mysqli_query($conn, "UPDATE table_accounts SET status = 1 WHERE id = $user_id")) {
                    echo json_encode(array("status" => true, "message" => "Đã gỡ lệnh banned thành công!"));
                } else {
                    echo json_encode(array("status" => false, "message" => "Có lỗi khi gỡ lệnh banned!"));
                }
            } else {
                if (mysqli_query($conn, "UPDATE table_accounts SET status = 0 WHERE id = $user_id")) {
                    echo json_encode(array("status" => true, "message" => "Đã banned thành công!"));
                } else {
                    echo json_encode(array("status" => false, "message" => "Có lỗi khi banned!"));
                }
            }
        }
    }
}
