<?php
error_reporting(0);
@ini_set('display_errors', 0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopgame";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$config = mysqli_query($conn,"SELECT * FROM table_config");
$config = mysqli_fetch_assoc($config);
if($config["maintance"] == 1){
    session_start();
    if(isset($_SESSION["id"])){
        include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/Class.profile.php");
        $account = new Profile($_SESSION["id"]);
        if($account->get_role() != "admin"){
    header("Location: /banned.php");
    die;
        }
    }
    else{
        header("Location: /banned.php");
        die;
    }
}
