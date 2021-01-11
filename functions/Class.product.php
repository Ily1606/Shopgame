<?php
class Product
{
    public $data = null;
    public $num = 0;
    public $conn;
    public function __construct($id = null, $res = null)
    {
        global $conn;
        $this->conn = $conn;
        if ($res == null) {
            $res = mysqli_query($conn, "SELECT * FROM table_product WHERE id = '$id' AND `status` = 1");
            $num = mysqli_num_rows($res);
            $this->num = $num;
            if ($num > 0) {
                $this->data = mysqli_fetch_array($res);
            }
        } else {
            $this->data = $res;
        }
    }
    function get_name()
    {
        $data = $this->data;
        return $data["name"];
    }
    function get_descryption()
    {
        $data = $this->data;
        return $data["descryption"];
    }
    function get_money()
    {
        $data = $this->data;
        return $data["money"];
    }
    function get_ower()
    {
        $data = $this->data;
        return $data["user_id"];
    }
    function get_soluong()
    {
        $data = $this->data;
        return $data["soluong"];
    }
    function get_type_game()
    {
        $data = $this->data;
        return $data["type_game"];
    }
    function get_poster()
    {
        $data = $this->data;
        $data_poster = json_decode($data["poster"], true);
        if (count($data_poster) > 0) {
            $data_poster = $data_poster[0];
            $poster = mysqli_query($this->conn, "SELECT * FROM table_medias WHERE id = $data_poster");
            $poster = mysqli_fetch_assoc($poster);
            $poster = $poster["url_file"];
        } else {
            $poster = "/assets/img/no_thumb.png";
        }
        return $poster;
    }
    function get_list_poster()
    {
        $data = $this->data;
        $data_poster = json_decode($data["poster"], true);
        $list_poster = array();
        if (count($data_poster) > 0) {
            for ($i = 0; $i < count($data_poster); $i++) {
                $id_poster = $data_poster[$i];
                $poster = mysqli_query($this->conn, "SELECT * FROM table_medias WHERE id = $id_poster");
                $poster = mysqli_fetch_assoc($poster);
                $poster = $poster["url_file"];
                array_push($list_poster,$poster);
            }
        } else {
            $list_poster = array("/assets/img/no_thumb.png");
        }
        return $list_poster;
    }
    function get_banner()
    {
        $data = $this->data;
        $data_banner = json_decode($data["banner"], true);
        if (count($data_banner) > 0) {
            $data_banner = $data_banner[0];
            $banner = mysqli_query($this->conn, "SELECT * FROM table_medias WHERE id = $data_banner");
            $banner = mysqli_fetch_assoc($banner);
            $banner = $banner["url_file"];
        } else {
            $banner = "/assets/img/no-thumbnail.jpg";
        }
        return $banner;
    }
    function get_from_sale()
    {
        $data = $this->data;
        return $data["from_sale"];
    }
    function get_end_sale()
    {
        $data = $this->data;
        return $data["end_sale"];
    }
    function get_from_sale_formated()
    {
        $data = $this->data;
        return date("d/m/Y H:i:s", $data["from_sale"]);
    }
    function get_end_sale_formated()
    {
        $data = $this->data;
        return date("d/m/Y H:i:s", $data["end_sale"]);
    }
    function get_money_sale()
    {
        $data = $this->data;
        return $data["money_sale"];
    }
    function get_enable_sale()
    {
        $data = $this->data;
        return $data["enable_sale"];
    }
    function get_type()
    {
        $data = $this->data;
        return $data["type"];
    }
    function get_selled()
    {
        $data = $this->data;
        return $data["selled"];
    }
    function get_stats()
    {
        $data = $this->data;
        return $data["stats"];
    }
    function get_count_voted()
    {
        $data = $this->data;
        return $data["count_voted"];
    }
    function get_status()
    {
        $data = $this->data;
        return $data["status"];
    }
    function get_enable_ship()
    {
        $data = $this->data;
        return $data["enable_ship"];
    }
    function get_money_ship()
    {
        $data = $this->data;
        return $data["money_ship"];
    }
    function get_create_time()
    {
        $data = $this->data;
        return $data["money_ship"];
    }
    function get_current_money()
    {
        if ($this->get_enable_sale()) {
            if (getdate()[0] <= $this->get_end_sale()) {
                return $this->get_money() * $this->get_money_sale() / 100;
            }
        } else {
            return $this->get_money();
        }
    }
    function get_countdown_endsale()
    {
        $remain = ceil(($this->get_end_sale() - time()) / 86400);
        if ($remain > 0) {
            return 'Còn ' . $remain . ' ngày';
        } else {
            return 'Hết hạn';
        }
    }
    function get_res()
    {
        return $this->data;
    }
}
