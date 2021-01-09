<?php
function check_login()
{
    if (isset($_SESSION["id"]))
        return true;
    else
        return false;
}
function upload_image($ten_anh, $dir, $name_file, $type)
{
    if (isset($_FILES[$ten_anh])) {
        $errors = array();
        $file_size = $_FILES[$ten_anh]['size'];
        $file_tmp = $_FILES[$ten_anh]['tmp_name'];
        $file_type = $_FILES[$ten_anh]['type'];

        $expensions = ['image/jpeg', 'image/png', 'image/jpg'];

        if (in_array($file_type, $expensions) === false) {
            $errors["status"] = false;
            $errors["msg"] = "Không chấp nhận định dạng ảnh có đuôi này, mời bạn chọn JPEG hoặc PNG.";
        }

        if ($file_size > 5242880) {
            $errors["status"] = false;
            $errors["msg"] = 'Kích cỡ file nên là 5 MB';
        }
        $sourceProperties = getimagesize($file_tmp);
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        if ($type == "avatar") {
            if ($sourceImageWidth > 600) {
                $resize_width = 600;
                $resize_height = ($sourceImageHeight * $resize_width) / $sourceImageWidth;
            } else {
                $resize_width = $sourceImageWidth;
                $resize_height = $sourceImageHeight;
            }
        } elseif ($type == "cover") {
            if ($sourceImageWidth > 1600) {
                $resize_width = 1600;
                $resize_height = ($sourceImageHeight * $resize_width) / $sourceImageWidth;
            } else {
                $resize_width = $sourceImageWidth;
                $resize_height = $sourceImageHeight;
            }
        } else {
            if ($sourceImageWidth > 900) {
                $resize_width = 900;
                $resize_height = ($sourceImageHeight * $resize_width) / $sourceImageWidth;
            } else {
                $resize_width = $sourceImageWidth;
                $resize_height = $sourceImageHeight;
            }
        }
        if (!file_exists($_SERVER["DOCUMENT_ROOT"] . $dir)) {
            mkdir($_SERVER["DOCUMENT_ROOT"] . $dir, 0777, true);
        }
        if (empty($errors) == true) {
            if ($file_type == "image/jpeg") {
                $file_type = ".jpeg";
                $resourceType = imagecreatefromjpeg($file_tmp);
                $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $resize_width, $resize_height);
                imagejpeg($imageLayer, $_SERVER["DOCUMENT_ROOT"] . $dir . $name_file . $file_type);
            } elseif ($file_type == "image/png") {
                $file_type = ".png";
                $resourceType = imagecreatefrompng($file_tmp);
                $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $resize_width, $resize_height);
                imagejpeg($imageLayer, $_SERVER["DOCUMENT_ROOT"] . $dir . $name_file . $file_type);
            } elseif ($file_type == "image/jpg") {
                $file_type = ".jpg";
                $resourceType = imagecreatefromjpeg($file_tmp);
                $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $resize_width, $resize_height);
                imagejpeg($imageLayer, $_SERVER["DOCUMENT_ROOT"] . $dir . $name_file . $file_type);
            }
            //move_uploaded_file($file_tmp, $_SERVER["DOCUMENT_ROOT"] . $dir . $name_file . $file_type);
            $errors["status"] = true;
            $errors["info"] = array("width" => $resize_width, "height" => $resize_height);
            $errors["url"] = $dir . $name_file . $file_type;
        }
        return $errors;
    }
}
function resizeImage($resourceType, $image_width, $image_height, $resizeWidth, $resizeHeight)
{
    $imageLayer = imagecreatetruecolor($resizeWidth, $resizeHeight);
    imagecopyresampled($imageLayer, $resourceType, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $image_width, $image_height);
    return $imageLayer;
}
function breadcrumb($row)
{
    global $conn;
    $id_game = $row["type_game"];
    $id_type = $row["type"];
    $res_game =  mysqli_query($conn, "SELECT * FROM table_games WHERE id = $id_game");
    $res_type = mysqli_query($conn, "SELECT * FROM table_types WHERE id =$id_type");
    $row_game = mysqli_fetch_assoc($res_game);
    $row_type = mysqli_fetch_assoc($res_type);
    $html = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
      <li class="breadcrumb-item"><a href="/games.php?id=' . $row_game["id"] . '">' . $row_game["name"] . '</a></li>
      <li class="breadcrumb-item"><a href="/types.php?id=' . $row_type["id"] . '">' . $row_type["name"] . '</a></li>
      <li class="breadcrumb-item active" aria-current="page">' . $row["name"] . '</li>
    </ol>
  </nav>';
    return $html;
}
function render_vote($vote)
{
    $html = '<div class="d-flex star_rate">';
    $array = array('<i class="far fa-star" for_stats="1"></i>', '<i class="far fa-star" for_stats="2"></i>', '<i class="far fa-star" for_stats="3"></i>', '<i class="far fa-star" for_stats="4"></i>', '<i class="far fa-star" for_stats="5"></i>');
    for ($i = 0; $i < $vote; $i += 1) {
        if ($i % 1 == 0) {
            if ($i <= $vote - 1) {
                $array[$i] = '<i class="fas fa-star" for_stats="'.$i.'"></i>';
            } else {
                $array[$i] = '<i class="fas fa-star-half-alt" for_stats="'.$i.'"></i>';
            }
        }
    }
    for ($i = 0; $i < count($array); $i++) {
        $html .= $array[$i];
    }
    $html .= '</div>';
    return $html;
}
function send_mail($to,$data)
{
    $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
    
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta name="x-apple-disable-message-reformatting">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="telephone=no" name="format-detection">
        <title></title>
        <!--[if (mso 16)]>
        <style type="text/css">
        a {text-decoration: none;}
        </style>
        <![endif]-->
        <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
        <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
        <o:AllowPNG></o:AllowPNG>
        <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    </head>
    
    <body>
        <div class="es-wrapper-color">
            <!--[if gte mso 9]>
                <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                    <v:fill type="tile" color="#eeeeee"></v:fill>
                </v:background>
            <![endif]-->
            <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td class="esd-email-paddings" valign="top">
                            <table cellpadding="0" cellspacing="0" class="es-content esd-header-popover" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" esd-custom-block-id="7954" align="center">
                                            <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure es-p15t es-p15b es-p10r es-p10l" align="left">
                                                            <!--[if mso]><table width="580" cellpadding="0" cellspacing="0"><tr><td width="282" valign="top"><![endif]-->
                                                            <!--[if mso]></td><td width="20"></td><td width="278" valign="top"><![endif]-->
                                                            <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="278" align="left">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="right" class="es-infoblock esd-block-text es-m-txt-c">
                                                                                            <p><a href="https://viewstripo.email" class="view" target="_blank" style="font-family: \'arial\', \'helvetica neue\', \'helvetica\', \'sans-serif\';">View in browser</a></p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!--[if mso]></td></tr></table><![endif]-->
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr></tr>
                                    <tr>
                                        <td class="esd-stripe" esd-custom-block-id="7681" align="center">
                                            <table class="es-header-body" style="background-color: #044767;" width="600" cellspacing="0" cellpadding="0" bgcolor="#044767" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure es-p35t es-p35b es-p35r es-p35l" align="left">
                                                            <!--[if mso]><table width="530" cellpadding="0" cellspacing="0"><tr><td width="340" valign="top"><![endif]-->
                                                            <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="es-m-p0r es-m-p20b esd-container-frame" width="340" valign="top" align="center">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-m-txt-c" align="left">
                                                                                            <h1 style="color: #ffffff; line-height: 100%;">Shopgame</h1>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!--[if mso]></td><td width="20"></td><td width="170" valign="top"><![endif]-->
                                                            <table cellspacing="0" cellpadding="0" align="right">
                                                                <tbody>
                                                                    <tr class="es-hidden">
                                                                        <td class="es-m-p20b esd-container-frame" esd-custom-block-id="7704" width="170" align="left">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-block-spacer es-p5b" align="center" style="font-size:0">
                                                                                            <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td style="border-bottom: 1px solid #044767; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <table cellspacing="0" cellpadding="0" align="right">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td class="esd-block-text" align="right">
                                                                                                                            <p><a target="_blank" style="font-size: 18px; line-height: 120%;" href="https://viewstripo.email">Shop</a></p>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                        <td class="esd-block-image es-p10l" valign="top" align="left" style="font-size:0"><a href="https://viewstripo.email" target="_blank"><img src="https://tlr.stripocdn.email/content/guids/CABINET_75694a6fc3c4633b3ee8e3c750851c02/images/77981522050090360.png" alt style="display: block;" width="27"></a></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!--[if mso]></td></tr></table><![endif]-->
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" align="center">
                                            <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure es-p40t es-p35r es-p35l" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="530" valign="top" align="center">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-block-image es-p25t es-p25b es-p35r es-p35l" align="center" style="font-size:0"><a target="_blank" href="https://viewstripo.email/"><img src="https://tlr.stripocdn.email/content/guids/CABINET_75694a6fc3c4633b3ee8e3c750851c02/images/67611522142640957.png" alt style="display: block;" width="120"></a></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-p10b" align="center">
                                                                                            <h2>Thanh toán thành công!</h2>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-p15t es-p20b" align="left">
                                                                                            <p style="font-size: 16px; color: #777777;">Bạn đã thanh toán thành công sản phẩm '.$data["name"].'</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" align="center">
                                            <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure es-p20t es-p35r es-p35l" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="530" valign="top" align="center">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-p10t es-p10b es-p10r es-p10l" bgcolor="#eeeeee" align="left">
                                                                                            <table style="width: 500px;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="left">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td width="80%">
                                                                                                            <h4>Thông tin đơn đặt hàng #</h4>
                                                                                                        </td>
                                                                                                        <td width="20%">
                                                                                                            <h4>'.$data["id"].'</h4>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="esd-structure es-p35r es-p35l" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="530" valign="top" align="center">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-p10t es-p10b es-p10r es-p10l" align="left">
                                                                                            <table style="width: 500px;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="left">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td style="padding: 5px 10px 5px 0" width="80%" align="left">
                                                                                                            <p>Đơn giá</p>
                                                                                                        </td>
                                                                                                        <td style="padding: 5px 0" width="20%" align="left">
                                                                                                            <p>'.number_format($data["single_money"]).' VND</p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="padding: 5px 10px 5px 0" width="80%" align="left">
                                                                                                            <p>Số lượng</p>
                                                                                                        </td>
                                                                                                        <td style="padding: 5px 0" width="20%" align="left">
                                                                                                            <p>'.$data["soluong"].'</p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="padding: 5px 10px 5px 0" width="80%" align="left">
                                                                                                            <p>Phí vận chuyển</p>
                                                                                                        </td>
                                                                                                        <td style="padding: 5px 0" width="20%" align="left">
                                                                                                            <p>'.number_format($data["money_ship"]).' VND</p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="esd-structure es-p10t es-p35r es-p35l" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="530" valign="top" align="center">
                                                                            <table style="border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;" width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-p15t es-p15b es-p10r es-p10l" align="left">
                                                                                            <table style="width: 500px;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="left">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td width="80%">
                                                                                                            <h4>Thành tiền</h4>
                                                                                                        </td>
                                                                                                        <td width="20%">
                                                                                                            <h4>'.$data["total_money"].'</h4>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="esd-structure es-p40t es-p40b es-p35r es-p35l" esd-custom-block-id="7796" align="left">
                                                            <!--[if mso]><table width="530" cellpadding="0" cellspacing="0"><tr><td width="255" valign="top"><![endif]-->
                                                            <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame es-m-p20b" width="255" align="left">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-p15b" align="left">
                                                                                            <h4>Địa chỉ nhận hàng</h4>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-p10b" align="left">
                                                                                          <p>'.$data["address"].'</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!--[if mso]></td><td width="20"></td><td width="255" valign="top"><![endif]-->
                                                            <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="255" align="left">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-p15b" align="left">
                                                                                            <h4>Số điện thoại liên hệ</h4>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="esd-block-text" align="left">
                                                                                        <p>'.$data["number_phone"].'</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!--[if mso]></td></tr></table><![endif]-->
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table cellpadding="0" cellspacing="0" class="es-footer" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" esd-custom-block-id="7684" align="center">
                                            <table class="es-footer-body" width="600" cellspacing="0" cellpadding="0" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure es-p35t es-p40b es-p35r es-p35l" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="530" valign="top" align="center">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-block-image es-p15b" align="center" style="font-size:0"><a target="_blank"><img src="https://tlr.stripocdn.email/content/guids/CABINET_75694a6fc3c4633b3ee8e3c750851c02/images/12331522050090454.png" alt="Beretun logo" style="display: block;" title="Beretun logo" width="37"></a></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-p35b" align="center">
                                                                                            <font color="#333333" style="font-size: 14px;"><b>15 - Nguyễn Đình Hiến - Phường Hòa Quý - Quận Ngũ Hành Sơn - Thành Phố Đà Nẵng</b></font>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td esdev-links-color="#777777" align="left" class="esd-block-text es-m-txt-c es-p5b">
                                                                                            <p style="color: #777777;">Nếu đơn hàng là gift code, chủ shop sẽ gửi gift code trong ít phút nữa. Vui lòng không trả lời lại email này.</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="esd-footer-popover es-content" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" align="center">
                                            <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure es-p30t es-p30b es-p20r es-p20l" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="560" valign="top" align="center">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" class="esd-empty-container" style="display: none;"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
    
    </html>';
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Create email headers
    $from = "khuonmatdangthuong45@gmail.com";
    $headers .= 'From: ' . $from . "\r\n" .
        'Reply-To: ' . $from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    mail($to, "Giao dịch thành công", $html,$headers);
}
