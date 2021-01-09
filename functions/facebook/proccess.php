<?php
session_start();
require("vendor/autoload.php");
$fb = new Facebook\Facebook([
    'app_id' => '2761732907476455', // Replace {app-id} with your app id
    'app_secret' => 'ed8d9933a214a7a33043ce40f4b00603',
    'default_graph_version' => 'v3.2',
]);
$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
$accessToken = $accessToken->getValue();
//echo $accessToken;
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://graph.facebook.com/v3.2/me?fields=id,gender,email,first_name,last_name&access_token=$accessToken",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET"
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
$data = json_decode($response, true);
if (isset($data["email"])) {
    include_once("../../_connect.php");
    include_once("../Class.Regsiter.php");
    $email = $data["email"];
    $gender = $data["gender"];
    $first_name = $data["first_name"];
    $last_name = $data["last_name"];
    $res = mysqli_query($conn, "SELECT * FROM table_accounts WHERE email = '$email'");
    if (mysqli_num_rows($res)) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION["username"] = $row["username"];
        $_SESSION["id"] = $row["id"];
        header("Location: /");
        die;
    } else {
        $password = "Login_with_socical";
        if ($gender == "male")
            $gender = 1;
        else
            $gender = 2;
        if (mysqli_query($conn, "INSERT INTO table_accounts (`username`,`passwords`,`email`,`gender`,`first_name`,`last_name`) VALUES ('$email','$password','$email','$gender','$first_name','$last_name')")) {
            $res = mysqli_query($conn, "SELECT * FROM table_accounts WHERE email = '$email'");
            $row = mysqli_fetch_assoc($res);
            $_SESSION["username"] = $row["username"];
            $_SESSION["id"] = $row["id"];
            header("Location: /");
        }
    }
}
