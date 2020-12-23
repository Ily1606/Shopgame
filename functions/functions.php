<?php
function check_login(){
    if(isset($_SESSION["id"]))
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