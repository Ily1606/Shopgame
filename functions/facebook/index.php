<?php
session_start();
require("vendor/autoload.php");
$fb = new Facebook\Facebook([
    'app_id' => '2761732907476455', // Replace {app-id} with your app id
    'app_secret' => 'ed8d9933a214a7a33043ce40f4b00603',
    'default_graph_version' => 'v3.2',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email','user_gender']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/functions/facebook/proccess.php', $permissions);
header("Location: $loginUrl");
