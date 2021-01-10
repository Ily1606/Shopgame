<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/functions.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/Class.profile.php");
if (check_login()) {
    $id = $_SESSION["id"];
    $account = new Profile($id);
    if ($account->get_role() == "admin") {
        if ($_GET["action"] == "maintance") {
            $value = mysqli_real_escape_string($conn, $_GET["value"]);
            $res = mysqli_query($conn, "SELECT * FROM table_config WHERE id = $value");
            $row = mysqli_fetch_assoc($res);
            if (mysqli_query($conn, "UPDATE table_config SET `maintance` = $value")) {
                if($value == 0)
                echo json_encode(array("status" => true, "message" => "Đã tắt bảo trì hệ thống thành công!"));
                else
                echo json_encode(array("status" => true, "message" => "Đã bật bảo trì hệ thống thành công!"));
            } else {
                if($value == 0)
                echo json_encode(array("status" => false, "message" => "Có lỗi khi tắt bảo trì hệ thống!"));
                else
                echo json_encode(array("status" => false, "message" => "Có lỗi khi bật bảo trì hệ thống!"));
            }
        }
    }
}
