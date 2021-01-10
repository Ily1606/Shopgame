<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/functions.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/Class.profile.php");
if (check_login()) {
    $id = $_SESSION["id"];
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        if ($action == "add") {
            if (isset($_POST["soluong"]) && isset($_POST["product_id"])) {
                $product_id = htmlspecialchars($_POST["product_id"]);
                $soluong = htmlspecialchars($_POST["soluong"]);
                if (isset($_SESSION["cart"])) {
                    $cart_data = $_SESSION["cart"];
                } else {
                    $cart_data = array();
                }
                $find = false;
                for ($i = 0; $i < count($cart_data); $i++) {
                    if ($cart_data[$i]["product_id"] == $product_id) {
                        $cart_data[$i]["soluong"] += $soluong;
                        $find = true;
                        break;
                    }
                }
                if ($find == false) {
                    array_push($cart_data, array("product_id" => $product_id, "soluong" => $soluong));
                }
                $_SESSION["cart"] = $cart_data;
                echo json_encode(array("status" => true, "message" => "Thêm vào giỏ hàng thành công!"));
            }
        } elseif ($action == "update") {
            if (isset($_POST["soluong"]) && isset($_POST["product_id"])) {
                $product_id = htmlspecialchars($_POST["product_id"]);
                $soluong = htmlspecialchars($_POST["soluong"]);
                $cart_data = $_SESSION["cart"];
                for ($i = 0; $i < count($cart_data); $i++) {
                    if ($cart_data[$i]["product_id"] == $product_id) {
                        $cart_data[$i]["soluong"] = $soluong;
                        break;
                    }
                }
                $_SESSION["cart"] = $cart_data;
                $res = mysqli_query($conn, "SELECT * FROM table_product WHERE id = $product_id");
                $row = mysqli_fetch_assoc($res);
                echo json_encode(array("status" => true, "money" => number_format($row["money"] * $soluong) . " VND"));
            }
        } elseif ($action == "delete") {
            if (isset($_POST["product_id"])) {
                $product_id = htmlspecialchars($_POST["product_id"]);
                $cart_data = $_SESSION["cart"];
                for ($i = 0; $i < count($cart_data); $i++) {
                    if ($cart_data[$i]["product_id"] == $product_id) {
                        unset($cart_data[$i]);
                        break;
                    }
                }
                $_SESSION["cart"] = $cart_data;
                echo json_encode(array("status" => true, "message" => "Xoá sản phẩm thành công"));
            }
        }
    }
}
