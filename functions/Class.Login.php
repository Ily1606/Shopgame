<?php
class Login
{
    public $res;
    public $username;
    public $password;
    public $result;
    public function __construct($username, $password = NULL)
    {
        $this->username = $username;
        $this->password = $password;
    }
    public function check_exist_username($res)
    {
        if (mysqli_num_rows($res))
            return true;
        else
            return false;
    }
    public function check_password_wrong($res)
    {
        if (mysqli_num_rows($res))
            return true;
        else
            return false;
    }
    public function login($res){
        session_start();
        $row = mysqli_fetch_assoc($res);
        $_SESSION["username"] = $row["username"];
        $_SESSION["id"] = $row["id"];
    }
    public function get_result(){
        return $this->result;
    }
    public function process()
    {
        $result = [];
        include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
        $res = mysqli_query($conn, "SELECT * FROM table_accounts WHERE username = '$this->username'");
        if ($this->check_exist_username($res)) {
            $res = mysqli_query($conn, "SELECT * FROM table_accounts WHERE username = '$this->username' AND passwords = '$this->password'");
            if ($this->check_password_wrong($res)) {
                $this->login($res);
                $result["status"] = true;
                $result["msg"] = "Đăng nhập thành công!";
                return $this->get_result();
                
            } else {
                $result["status"] = false;
                $result["msg"] = "Sai mật khẩu!";
            }
        } else {
            $result["status"] = false;
            $result["msg"] = "Sai tên tài khoản!";
        }
        $this->result = $result;
    }
}
