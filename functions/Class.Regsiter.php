<?php
class Regsiter{
    public $username;
    public $password;
    public $re_password;
    public $gender;
    public $email;
    public $result;
    public function __construct($username, $password, $re_password, $gender, $email)
    {
        $this->username = $username;
        $this->password = $password;
        $this->re_password = $re_password;
        $this->gender = $gender;
        $this->email = $email;
    }
    public function check_username_exist($username){
        include_once($_SERVER["DOCUMENT_ROOT"]."/_connect.php");
        $res = mysqli_query($conn,"SELECT id FROM table_accounts WHERE username = '$username'");
        if(mysqli_num_rows($res))
            return true;
        else
            return false;
    }
}

?>