<?php
session_start();
include_once("vendor/autoload.php");
$client = new Google_Client();
$client->setClientId("360044825051-mhbagr9m2i2043tsg934n6bd3bu9hqib.apps.googleusercontent.com");
$client->setClientSecret("iSlwH-LKitcpezzBJj0RePJt");
$client->setRedirectUri("http://localhost/functions/google/proccess.php");
$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
$client->setAccessToken($token['access_token']);

// get profile info
$google_oauth = new Google_Service_Oauth2($client);
$data = $google_oauth->userinfo->get();
if (isset($data["email"])) {
    include_once("../../_connect.php");
    include_once("../Class.Regsiter.php");
    $email = $data->email;
    $first_name = $data->familyName;
    $last_name = $data->givenName;
    $res = mysqli_query($conn, "SELECT * FROM table_accounts WHERE email = '$email'");
    if (mysqli_num_rows($res)) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION["username"] = $row["username"];
        $_SESSION["id"] = $row["id"];
        header("Location: /");
        die;
    } else {
        $password = "Login_with_socical";
        if (mysqli_query($conn, "INSERT INTO table_accounts (`username`,`passwords`,`email`,`first_name`,`last_name`) VALUES ('$email','$password','$email','$first_name','$last_name')")) {
            $res = mysqli_query($conn, "SELECT * FROM table_accounts WHERE email = '$email'");
            $row = mysqli_fetch_assoc($res);
            $_SESSION["username"] = $row["username"];
            $_SESSION["id"] = $row["id"];
            header("Location: /");
        }
    }
}
