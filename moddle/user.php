<?php
session_start();
include_once("../_connect.php");
foreach ($_POST as $key => $value) {
    $$key = mysqli_real_escape_string($conn, $value);
}
$data = array();
if (isset($_GET["action"])) {
    $action = $_GET["action"];
    if ($action == "login") {
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            include_once("../functions/Class.Login.php");
            include_once("../functions/Class.Login.php");
            $login = new Login($username, $password);
            $rs = $login->process();
            $data = $login->get_result();
        } else {
            $data["status"] = false;
            $data["msg"] = "Vui lòng điền thông tin";
        }
    } else if ($action == "regsister") {
         include_once("../functions/Class.Regsiter.php");
        if (isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["number_phone"]) && isset($_POST["gender"]) && isset($_POST["password"]) && isset($_POST["re_password"])) {
            $regsister = new Regsiter($username,$password,$re_password,$gender,$email,$number_phone);
            $rs = $regsister->process();
            $data =$regsister->get_result();
        } else {
            $data["status"] = false;
            $data["msg"] = "Vui lòng điền thông tin";
        }
    } else {
        $data["status"] = false;
        $data["msg"] = "Hành động không hợp lệ!";
    }
}
echo json_encode($data);
