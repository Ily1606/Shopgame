<?php
session_start();
include_once("vendor/autoload.php");
$client = new Google_Client();
$client->setClientId("360044825051-mhbagr9m2i2043tsg934n6bd3bu9hqib.apps.googleusercontent.com");
$client->setClientSecret("iSlwH-LKitcpezzBJj0RePJt");
$client->setRedirectUri("http://localhost/functions/google/proccess.php");
$client->addScope("email");
$client->addScope("profile");
$url_auth = $client->createAuthUrl();
header("Location: $url_auth");
