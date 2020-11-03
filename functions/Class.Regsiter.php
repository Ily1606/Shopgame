<?php
class Regsiter
{
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
    public function check_username_exist($username)
    {
        include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
        $res = mysqli_query($conn, "SELECT id FROM table_accounts WHERE username = '$username'");
        if (mysqli_num_rows($res))
            return true;
        else
            return false;
    }
    public function check_email_exist($email)
    {
        include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
        $res = mysqli_query($conn, "SELECT id FROM table_accounts WHERE email = '$email'");
        if (mysqli_num_rows($res))
            return true;
        else
            return false;
    }
    public function check_gender($gender)
    {
        if ($gender == 1 || $gender == 2)
            return true;
        else
            return false;
    }
    public function main()
    {
        $data = [];
        include_once($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
        $username = $this->username;
        $email = $this->email;
        $password = $this->password;
        $re_password = $this->re_password;
        $gender = $this->gender;
        if ($this->check_username_exist($username)) {

            if ($this->check_email_exist($email)) {
                if ($this->password == $re_password) {
                    if ($this->check_gender($gender)) {
                        if (mysqli_query($conn, "INSERT INTO table_accounts (`username`,`passwords`,`email`,`gender`) VALUES ('$username','$password','$email','$gender'")) {
                            $data["status"] = true;
                            $data["msg"] = "Đăng ký tài khoản thành công!";
                        } else {
                            $data["status"] = false;
                            $data["msg"] = "Có lỗi khi đăng ký tài khoản, vui lòng thử lại sau!";
                        }
                    } else {
                        $data["status"] = false;
                        $data["msg"] = "Giới tính không hợp lệ!";
                    }
                } else {
                    $data["status"] = false;
                    $data["msg"] = "Mật khẩu không khớp!";
                }
            } else {
                $data["status"] = false;
                $data["msg"] = "Email đã tồn tại!";
            }
        } else {
            $data["status"] = false;
            $data["msg"] = "Username đã tồn tại!";
        }
    }
}
