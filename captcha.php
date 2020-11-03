<?php
session_start();
$string = md5(time());
$nt1 = mt_rand(1,10);
$nt2 = mt_rand(1,10);
$nt_sub = "$nt1 + $nt2";

$_SESSION['captcha'] = $nt1 + $nt2;

$img = imagecreate(150,50);
$background = imagecolorallocate($img, 0,0,0);
$text_color = imagecolorallocate($img, 255,255,255);
imagestring($img, 4,40,15, $nt_sub, $text_color);

header("Content-type: image/png");
imagepng($img);
imagedestroy($img);
