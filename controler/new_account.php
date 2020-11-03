<?php
$data = array();
session_start();
include_once("../_connect.php");
if (isset($_GET["action"])) {
    if ($_GET["action"] == "regsister") {
        $required_data = ["username", "password", "re_password", "captcha", "gender", "email"];
        foreach ($required_data as $value) {
            if (!isset($_POST[$value])) {
                $data["status"] = false;
                $data["msg"] = "Thiếu dữ liệu đầu vào!";
                break;
            } else $$value = mysqli_real_escape_string($conn, $_POST[$value]);
        }
        if ($captcha == $_SESSION["captcha"]) {
            $regsister = new Regsiter($username, $password, $re_password, $gender, $email);
            $data = $regsister->process();
        } else {
            $data["status"] = false;
            $data["msg"] = "Captcha không đúng!";
        }
    } elseif ($_GET["action"] == "login") {
        $required_data = ["username", "password", "captcha"];
        foreach ($required_data as $value) {
            if (!isset($_POST[$value])) {
                $data["status"] = false;
                $data["msg"] = "Thiếu dữ liệu đầu vào!";
                break;
            } else $$value = mysqli_real_escape_string($conn, $_POST[$value]);
        }
        if ($captcha == $_SESSION["captcha"]) {
            $login = new Login($username, $password);
            $data = $login->process();
        } else {
            $data["status"] = false;
            $data["msg"] = "Captcha không đúng!";
        }
    } else {
        $data["status"] = false;
        $data["msg"] = "Không tồn tại hành động này!";
    }
} else {
    $data["status"] = false;
    $data["msg"] = "Không tồn tại hành động này";
}
