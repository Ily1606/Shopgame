<?php
foreach ($_POST as $key => $value) {
    $$key = mysqli_real_escape_string($conn, htmlspecialchars($value));
}
$data_required = array("name", "des", "money", "soluong", "game_types", "type", "from_sale", "end_sale", "money_sale", "poster", "banner", "product_id");
foreach ($data_required as $value) {
    if (!isset($_POST[$value])) {
        echo json_encode(array("status" => false, "message" => "Vui lòng điền đầy đủ thông tin!"));
        die;
    }
}
if (!isset($_POST["enable_sale"])) {
    $enable_sale = 0;
}
if ($enable_sale == 1) {
    $from_sale = new DateTime($from_sale);
    $from_sale = $from_sale->format('U');
    $end_sale = new DateTime($end_sale);
    $end_sale = $end_sale->format('U');
    if ($from_sale >= $enable_sale) {
        echo json_encode(array("status" => false, "message" => "Thời gian bắt đầu sale phải bắt đầu trước thời gian kết thúc sale!"));
        die;
    }
    if (is_numeric($money_sale)) {
        if ($money_sale < 0 || $money_sale > 100) {
            echo json_encode(array("status" => false, "message" => "Giảm giá được tính theo phần trăm, vui lòng kiểm tra lại!"));
            die;
        }
    } else {
        echo json_encode(array("status" => false, "message" => "Thời gian bắt đầu sale phải bắt đầu trước thời gian kết thúc sale!"));
        die;
    }
}
if (mysqli_query($conn, "UPDATE table_product SET `name` = '$name',`descryption` = '$des',`money` = '$money',`soluong` = '$soluong',`type_game` = '$game_types',`from_sale` = '$from_sale',`end_sale` = '$end_sale',`money_sale` = '$money_sale',`enable_sale` = '$enable_sale',`type` = '$type' WHERE id = $product_id AND user_id = $id")) {
    $poster = json_decode($poster);
    $banner = json_decode($banner);
    if(count($poster) > 0){
        $poster = json_encode($poster);
        mysqli_query($conn, "UPDATE table_product SET `poster` = '$poster' WHERE id = $product_id AND user_id = $id");
    }
    if(count($banner) > 0){
        $banner = json_encode($banner);
        mysqli_query($conn, "UPDATE table_product SET `banner` = '$banner' WHERE id = $product_id AND user_id = $id");
    }
    echo json_encode(array("status" => true, "message" => "Chỉnh sửa sản phẩm thành công!"));
    die;
} else {
    echo json_encode(array("status" => false, "message" => "Có lỗi khi thêm sản phẩm!"));
    die;
}
