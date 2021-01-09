<?php
foreach ($_POST as $key => $value) {
    $$key = mysqli_real_escape_string($conn, htmlspecialchars($value));
}
$data_required = array("id_product", "soluong");
foreach ($data_required as $value) {
    if (!isset($_POST[$value])) {
        echo json_encode(array("status" => false, "message" => "Vui lòng điền đầy đủ thông tin!"));
        die;
    }
}
$product = mysqli_query($conn, "SELECT * FROM table_product WHERE id = $id_product AND `status` = 1");
if (mysqli_num_rows($product)) {
    $row_product = mysqli_fetch_assoc($product);
} else {
    echo json_encode(array("status" => false, "message" => "Sản phẩm không tồn tại!"));
    die;
}
$single_money = $row_product["money"];
$money = $soluong * $single_money;
if ($row_product["enable_ship"] == 1) {
    $total_money = $money + $row_product["money_ship"];
    $money_ship = $row_product["money_ship"];
    if (isset($_POST["address"]) && isset($_POST["number_phone"])) {
        $address = mysqli_real_escape_string($conn, htmlspecialchars($_POST["address"]));
        $number_phone = mysqli_real_escape_string($conn, htmlspecialchars($_POST["number_phone"]));
    } else {
        $html = '<div class="modal fade" id="order_address" for_id="' . $id_product . '" for_soluong="' . $soluong . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Vui lòng điền thông tin nhận hàng</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="address">Địa chỉ nhận hàng</label>
                <input class="form-control" id="address"/>
              </div><div class="form-group">
                <label for="address">Số điện thoại liên lạc</label>
                <input class="form-control" id="number_phone"/>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
              <button type="button" class="btn btn-primary" id="save">Đặt hàng</button>
            </div>
          </div>
        </div>
      </div>
      <script>
        $(function(){
            $("#order_address").modal("show");
            $("#order_address").on("hidden.bs.modal", function (e) {
                $(this).remove();
              });
        });
      </script>
      ';
        echo json_encode(array("status" => false, "html" => $html));
        die;
    }
} else {
    $total_money = $money;
    $money_ship = 0;
    $address = "IN_GAME";
    $number_phone = "IN_GAME";
}
if (mysqli_query($conn, "INSERT INTO table_biller (`id_product`,`user_id`,`money`,`soluong`,`money_ship`,`total_money`,`single_money`,`address`,`number_phone`) VALUES ('$id_product','$id','$money','$soluong','$money_ship','$total_money','$single_money','$address','$number_phone')")) {
    $cart_data = $_SESSION["cart"];
    for ($i = 0; $i < count($cart_data); $i++) {
        if ($cart_data[$i]["product_id"] == $id_product) {
            unset($cart_data[$i]);
            break;
        }
    }
    $_SESSION["cart"] = $cart_data;
    echo json_encode(array("status" => true, "message" => "Tạo mã thanh toán thành công!", "id_biller" => mysqli_insert_id($conn)));
    die;
} else {
    echo json_encode(array("status" => false, "message" => "Có lỗi khi tạo mã thanh toán!"));
    die;
}
