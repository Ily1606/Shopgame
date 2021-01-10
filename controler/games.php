<?php
session_start();
include_once("../_connect.php");
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        if ($action == "search") {
            $keyword = mysqli_real_escape_string($conn, $_GET["q"]);
            $count = explode(" ", $keyword);
            $build_sql = "";
            for ($i = 0; $i < count($count); $i++) {
                $char = $count[$i];
                if ($build_sql != "") $build_sql .= " UNION ALL ";
                $build_sql .= "SELECT * FROM table_games WHERE `name` LIKE '%$char%' OR `name` LIKE '%$char%'";
            }
            $build_sql = "SELECT COUNT(*) as count_result, result.* FROM (" . $build_sql . ") AS result GROUP BY result.id ORDER BY count_result DESC LIMIT 25";
            $query = mysqli_query($conn, $build_sql);
            $data = array();
            while ($row = mysqli_fetch_assoc($query)) {
                array_push($data, array("game_name" => $row["name"],"game_id"=>$row["id"]));
            }
            header("content-type: application/json; charset=utf-8");
            echo json_encode($data);
        } elseif ($action == "create") {
            $keyword = mysqli_real_escape_string($conn, htmlspecialchars($_GET["q"]));
            if (mysqli_query($conn, "INSERT INTO table_games (`name`,`user_create`) VALUES ('$keyword','$id')")) {
                $res = mysqli_query($conn, "SELECT * FROM table_games WHERE `name` = '$keyword' LIMIT 1");
                $row = mysqli_fetch_assoc($res);
                echo json_encode(array("status" => true, "message" => "Bạn đã tạo một danh mục mới, quản trị viên sẽ kiểm duyệt danh mục này của bạn", "id" => $row["id"]));
            } else {
                echo json_encode(array("status" => false, "message" => "Ôi không, có gì đó không ổn khi tạo danh mục!"));
            }
        }
    }
}
