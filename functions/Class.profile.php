<?php
class Profile
{
    public $res = false;
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
        global $conn;
        $rs = mysqli_query($conn, "SELECT * FROM table_accounts WHERE id = $id");
        if (mysqli_num_rows($rs)) {
            $rs = mysqli_fetch_assoc($rs);
            $this->res = $rs;
        }
    }
    public function get_res(){
        return $this->res;
    }
    public function get_fullname(){
        $row = $this->res;
        return $row["first_name"]." ".$row["last_name"];
    }
    public function get_username()
    {
        $row = $this->res;
        return $row["username"];
    }
    public function get_email()
    {
        $row = $this->res;
        return $row["email"];
    }
    public function get_number_phone()
    {
        $row = $this->res;
        return $row["number_phone"];
    }
    public function get_role()
    {
        $row = $this->res;
        return $row["role"];
    }
    public function get_gender()
    {
        $row = $this->res;
        $gender = $row["gender"];
        if ($gender == 1) {
            return "Nam";
        } else {
            return "Nữ";
        }
    }
}
