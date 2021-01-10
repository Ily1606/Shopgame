<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/functions.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/Class.profile.php");
if (check_login()) {
    $id = $_SESSION["id"];
    $account = new Profile($id);
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        if ($action == "confirm_send") {
            if (isset($_POST["status"]) && isset($_POST["biller_id"])) {
                $status = mysqli_real_escape_string($conn, htmlspecialchars($_POST["status"]));
                $biller_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST["biller_id"]));
                $res_biller = mysqli_query($conn, "SELECT table_biller.*, table_product.poster, table_product.name, table_product.user_id as user_ower FROM table_biller INNER JOIN table_product ON table_biller.id_product = table_product.id WHERE table_biller.id = $biller_id");
                if (mysqli_num_rows($res_biller)) {
                    $row_biller = mysqli_fetch_assoc($res_biller);
                    if ($status == 0) {
                        if ($account->get_role() == "admin" || ($row_biller["status"] == 1 && $row_biller["user_ower"] != $row_biller["user_id"])) {
                            if (mysqli_query($conn, "UPDATE table_biller SET `status` = 0 WHERE id = $biller_id")) {
                                echo json_encode(array("status" => true, "msg" => "Thay đổi trạng thái đơn hàng thành công!"));
                            } else {
                                echo json_encode(array("status" => false, "msg" => "Có lỗi khi thay đổi trạng thái đơn hàng!"));
                            }
                        }
                    } elseif ($status == 1) {
                        if ($account->get_role() == "admin" || ($row_biller["status"] == 2 && $row_biller["user_ower"] == $row_biller["user_id"])) {
                            if (mysqli_query($conn, "UPDATE table_biller SET `status` = 1 WHERE id = $biller_id")) {
                                echo json_encode(array("status" => true, "msg" => "Thay đổi trạng thái đơn hàng thành công!"));
                            } else {
                                echo json_encode(array("status" => false, "msg" => "Có lỗi khi thay đổi trạng thái đơn hàng!"));
                            }
                        }
                    } elseif ($status == 2) {
                        if ($account->get_role() == "admin" || ($row_biller["status"] == 1 && $row_biller["user_ower"] == $row_biller["user_id"])) {
                            if (mysqli_query($conn, "UPDATE table_biller SET `status` = 2 WHERE id = $biller_id")) {
                                echo json_encode(array("status" => true, "msg" => "Thay đổi trạng thái đơn hàng thành công!"));
                            } else {
                                echo json_encode(array("status" => false, "msg" => "Có lỗi khi thay đổi trạng thái đơn hàng!"));
                            }
                        }
                    } elseif ($status == 3) {
                        if ($account->get_role() == "admin" || ($row_biller["status"] == 2 && $row_biller["user_ower"] != $row_biller["user_id"])) {
                            if (mysqli_query($conn, "UPDATE table_biller SET `status` = 3 WHERE id = $biller_id")) {
                                echo json_encode(array("status" => true, "msg" => "Thay đổi trạng thái đơn hàng thành công!"));
                            } else {
                                echo json_encode(array("status" => false, "msg" => "Có lỗi khi thay đổi trạng thái đơn hàng!"));
                            }
                        }
                    } elseif ($status == 4) {
                        if ($account->get_role() == "admin" || ($row_biller["status"] == 2 && $row_biller["user_ower"] != $row_biller["user_id"])) {
                            if (mysqli_query($conn, "UPDATE table_biller SET `status` = 4 WHERE id = $biller_id")) {
                                echo json_encode(array("status" => true, "msg" => "Thay đổi trạng thái đơn hàng thành công!"));
                            } else {
                                echo json_encode(array("status" => false, "msg" => "Có lỗi khi thay đổi trạng thái đơn hàng!"));
                            }
                        }
                    } elseif ($status == 5) {
                        if ($account->get_role() == "admin") {
                            if (mysqli_query($conn, "UPDATE table_biller SET `status` = 5 WHERE id = $biller_id")) {
                                echo json_encode(array("status" => true, "msg" => "Thay đổi trạng thái đơn hàng thành công!"));
                            } else {
                                echo json_encode(array("status" => false, "msg" => "Có lỗi khi thay đổi trạng thái đơn hàng!"));
                            }
                        }
                    }
                } else {
                    echo json_encode(array("status" => false, "msg" => "Đơn hàng không tồn tại!"));
                }
            }
        }
    }
}
