<?php
session_start();
include_once("../_connect.php");
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        if ($action == "update_info") {
            foreach ($_POST as $key => $value) {
                $$key = htmlspecialchars(mysqli_real_escape_string($conn, $value));
            }
            if (mysqli_query($conn, "UPDATE table_accounts SET `email` = '$email',`first_name` = '$firts_name',`last_name` = '$last_name', `number_phone` = '$number_phone',`gender` = '$gender' WHERE id = $id")) {
                echo json_encode(array("status" => true, "message" => "Cập nhật trang cá nhân thành công!"));
            } else {
                echo json_encode(array("status" => false, "message" => "Ôi không, có gì đó không ổn khi cập nhật trang cá nhân!"));
            }
        } elseif ($action == "update_password") {
            foreach ($_POST as $key => $value) {
                $$key = htmlspecialchars(mysqli_real_escape_string($conn, $value));
            }
            if ($new_password == $renew_password) {
                if ($old_password == "") {
                    $old_password = "Login_with_socical";
                } else {
                    $old_password = md5($old_password);
                }
                $res = mysqli_query($conn, "SELECT * FROM table_accounts WHERE id = '$id' AND passwords = '$old_password'");
                if (mysqli_num_rows($res)) {
                    if (mysqli_query($conn, "UPDATE table_accounts SET `passwords` = '$new_password' WHERE id = $id")) {
                        echo json_encode(array("status" => true, "message" => "Cập nhật trang cá nhân thành công!"));
                    } else {
                        echo json_encode(array("status" => false, "message" => "Ôi không, có gì đó không ổn khi cập nhật trang cá nhân!"));
                    }
                } else {
                    echo json_encode(array("status" => false, "message" => "Mật khẩu cũ không khớp!"));
                }
            } else {
                echo json_encode(array("status" => false, "message" => "Mật khẩu không khớp!"));
            }
        }
    }
}
