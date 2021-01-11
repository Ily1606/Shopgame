<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/functions.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/Class.profile.php");
if (check_login()) {
    $id = $_SESSION["id"];
    $account = new Profile($id);
    if ($account->get_role() == "admin") {
        if ($_GET["action"] == "refund") {
            $payment_id = mysqli_real_escape_string($conn, $_GET["id"]);
            if (mysqli_query($conn, "UPDATE table_history_payemnt SET `status` = 5 WHERE id = '$payment_id'")) {
                echo json_encode(array("status" => true, "message" => "Thay đổi trạng thái hoàn tiền thành công!"));
            } else {
                echo json_encode(array("status" => false, "message" => "Có lỗi khi thay đổi trạng thái hoàn tiền!"));
            }
        }
    }
}
