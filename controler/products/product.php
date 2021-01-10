<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/functions.php");
if (check_login()) {
    $id = $_SESSION["id"];
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        if ($action == "add") {
            include_once("add.php");
        } elseif ($action == "view") {
            if (isset($_GET["user"])) {
                $id = mysqli_real_escape_string($conn, $_GET["user"]);
            }
            include_once("view.php");
        }
        elseif($action == "edit"){
            include_once("edit.php");
        }
    }
}
