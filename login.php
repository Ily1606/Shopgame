<?php
session_start();
if(isset($_SESSION["id"])){
    header("Location: /");
    die;
}
else{
    //Do something....
}
