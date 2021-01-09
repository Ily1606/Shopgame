<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/functions.php");
include_once("functions/Class.profile.php");
if (check_login()) {
    $id = $_SESSION["id"];
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        if ($action == "confirm_send") {
            if (isset($_POST["status"]) && isset($_POST["biller_id"])) {
                $status = mysqli_real_escape_string($conn, htmlspecialchars($_POST["status"]));
                $biller_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST["biller_id"]));
                $res_biller = mysqli_query($conn, "SELECT * FROM table_biller WHERE id =$biller_id");
                $row_biller = mysqli_fetch_assoc($res_biller);
                if ($status == 2) {
                    $product_id = $row_biller["id_product"];
                    $res_product = mysqli_query($conn, "SELECT * FROM table_product WHERE id = $product_id");
                    $row_product = mysqli_fetch_assoc($res_product);
                    if ($row_product["user_id"] == $id) {
                        if (mysqli_query($conn, "UPDATE table_biller SET `status` = 2 WHERE id = $biller_id")) {
                            echo json_encode(array("status" => true, "msg" => "Thay đổi trạng thái đơn hàng thành công!"));
                        } else {
                            echo json_encode(array("status" => false, "msg" => "Có lỗi khi thay đổi trạng thái đơn hàng!"));
                        }
                    }
                } elseif ($status == 3) {
                    if ($row_biller["user_id"] == $id) {
                        if (mysqli_query($conn, "UPDATE table_biller SET `status` = 3 WHERE id = $biller_id")) {
                            echo json_encode(array("status" => true, "msg" => "Thay đổi trạng thái đơn hàng thành công!"));
                        } else {
                            echo json_encode(array("status" => false, "msg" => "Có lỗi khi thay đổi trạng thái đơn hàng!"));
                        }
                    }
                } elseif ($status == 4) {
                    if ($row_biller["user_id"] == $id) {
                        if (mysqli_query($conn, "UPDATE table_biller SET `status` = 4 WHERE id = $biller_id")) {
                            echo json_encode(array("status" => true, "msg" => "Thay đổi trạng thái đơn hàng thành công!"));
                        } else {
                            echo json_encode(array("status" => false, "msg" => "Có lỗi khi thay đổi trạng thái đơn hàng!"));
                        }
                    }
                }
            }
        }
    }
}
