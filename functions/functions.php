<?php
function check_login(){
    if(isset($_SESSION["id"]))
    return true;
    else
    return false;
}
