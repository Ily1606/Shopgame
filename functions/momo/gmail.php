<?php

$username = 'khuonmatdangthuong45@gmail.com'; //Your email
$password = '01253848156aA'; //Your password

?>































<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial;
        }

        .list-form-container {
            background: #F0F0F0;
            border: #e0dfdf 1px solid;
            padding: 20px;
            border-radius: 2px;
        }

        .column {
            float: left;
            padding: 10px 0px;
        }

        table {
            width: 100%;
            background: #FFF;
        }

        td,
        th {
            border-bottom: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            width: auto;
        }

        .content-div {
            position: relative;
        }

        .content-div span.column {
            width: 90%;
        }

        .date {
            position: absolute;
            right: 8px;
            padding: 10px 0px;
        }
    </style>
    <title>Get momo transfer history</title>
</head>

<body>
    <h1>Get momo transfer history</h1>
    <?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $d = date('d', strtotime("-2 days"));
    $m = date('m', strtotime("-2 days"));
    $y = date('Y', strtotime("-2 days"));
    $m = date('F', mktime(0, 0, 0, $m, 10));
    $date = $d . ' ' . $m . ' ' . $y;
    ?>

    <?php
    if (!function_exists('imap_open')) {
        echo "IMAP is not configured.";
        exit();
    } else {
    ?>
        <div id="listData" class="list-form-container">
            <?php
            $connection = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());
            $emailData = imap_search($connection, 'FROM "no-reply@momo.vn" SINCE "'.$date.'"');

            if (!empty($emailData)) {
            ?>
                <table>
                    <?php
                    foreach ($emailData as $emailIdent) {
                        $overview = imap_fetch_overview($connection, $emailIdent, 0);
                        if (preg_match("/Giao dịch thành công/", imap_utf8($overview[0]->subject))) continue;
                        if (!preg_match("/Bạn vừa nhận được tiền từ/", imap_utf8($overview[0]->subject))) continue;
                        $message = ((imap_fetchbody($connection, $emailIdent, 1)));
                        $decoded = quoted_printable_decode($message);
                        $decoded = preg_replace("/\s+/", " ", $decoded);
                        //echo $decoded;
                        //die;
                        if (strpos($decoded, '<html lang="en">')) {
                            $money =  explode('<td class="" style="padding-top: 5px; font-size: 28px; font-family: Helvetica Neue, Arial, sans-serif; color: #3C4043; text-align: center; line-height: 1.2em; font-weight: 500;">', $decoded);
                            $money = explode('</td>', $money[1]);
                            $money = $money[0];

                            $code =  explode('<div style="color:#3C4043;margin:0px;font-size:12px;line-height:22px; font-weight: normal; font-size: 15px;">', $decoded);
                            $code = explode('</div>', $code[6]);
                            $code = $code[0];
                            
                            $phone =  explode('<div style="color:#3C4043;margin:0px;font-size:12px;line-height:22px; font-weight: normal; font-size: 15px;">', $decoded);
                            $phone = explode('</div>', $phone[3]);
                            $phone = $phone[0];
                            
                            $name =  explode('<div style="color:#3C4043;margin:0px;font-size:12px;line-height:22px; font-weight: normal; font-size: 15px;">', $decoded);
                            $name = explode('</div>', $name[2]);
                            $name =  $name[0];
                            
                            $content =  explode('<div style="color:#3C4043;margin:0px;font-size:12px;line-height:22px; font-weight: normal; font-size: 15px;">', $decoded);
                            $content = explode('</div>', $content[5]);
                            $content = $content[0];
                        } else {
                            $money =  explode('<td style="text-align: right;"><span style="color:#4d4d4d; font-size:13px">', $decoded);
                            $money = explode('</span>', $money[1]);
                            $money = $money[0];


                            $code =  explode('<td style="text-align: right;"><span style="color:#4d4d4d; font-size:13px">', $decoded);
                            $code = explode('</span>', $code[2]);
                            $code = $code[0];


                            $phone =  explode('<td style="text-align: right;"><span style="font-size:13px;color:#4d4d4d;">', $decoded);
                            $phone = explode('</span>', $phone[2]);
                            $phone = $phone[0];


                            $name =  explode('<td style="text-align: right;"><span style="font-size:13px;color:#4d4d4d;">', $decoded);
                            $name = explode('</span>', $name[1]);
                            $name =  $name[0];


                            $content =  explode('<td style="text-align: right;"><span style="font-size:13px;color:#4d4d4d;">', $decoded);
                            $content = explode('</span>', $content[3]);
                            $content = $content[0];
                        }

                        $date = date("d F, Y", strtotime($overview[0]->date));
                    ?>
                        <tr>
                            <td style="width:15%;">
                                <span class="column"><?php echo $overview[0]->from; ?></span>
                            </td>
                            <td class="content-div">
                                <span class="column"><?php echo imap_utf8($overview[0]->subject); ?> :
                                    <br> [Money] = <?php echo $money; ?>
                                    <br> [Code] = <?php echo $code; ?>
                                    <br> [Name] = <?php echo $name; ?>
                                    <br> [Phone] = <?php echo $phone; ?>
                                    <br> [Content] = <?php echo $content; ?>
                                </span>
                                <span class="date"><?php echo $date; ?></span>
                            </td>
                        </tr>
                    <?php
                    } // End foreach
                    ?>
                </table>
        <?php
            } // end if
            else echo "Không tìm thấy mail";
            imap_close($connection);
        }
        ?>
        </div>
</body>

</html>