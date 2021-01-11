<?php
include($_SERVER["DOCUMENT_ROOT"] . "/_connect.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/functions/functions.php");
$username = 'khuonmatdangthuong45@gmail.com'; //Your email
$password = '01253848156aA'; //Your password

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
        $emailData = imap_search($connection, 'FROM "no-reply@momo.vn" SINCE "' . $date . '"');
        $handle = fopen("logs.txt", "r");
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
                    if (strpos($decoded, '<html lang="en">')) {
                        $money =  explode('<td class="" style="padding-top: 5px; font-size: 28px; font-family: Helvetica Neue, Arial, sans-serif; color: #3C4043; text-align: center; line-height: 1.2em; font-weight: 500;">', $decoded);
                        $money = explode('</td>', $money[1]);
                        $money = trim($money[0]);

                        $code =  explode('<div style="color:#3C4043;margin:0px;font-size:12px;line-height:22px; font-weight: normal; font-size: 15px;">', $decoded);
                        $code = explode('</div>', $code[6]);
                        $code = trim($code[0]);

                        $phone =  explode('<div style="color:#3C4043;margin:0px;font-size:12px;line-height:22px; font-weight: normal; font-size: 15px;">', $decoded);
                        $phone = explode('</div>', $phone[3]);
                        $phone = trim($phone[0]);

                        $name =  explode('<div style="color:#3C4043;margin:0px;font-size:12px;line-height:22px; font-weight: normal; font-size: 15px;">', $decoded);
                        $name = explode('</div>', $name[2]);
                        $name =  trim($name[0]);

                        $content =  explode('<div style="color:#3C4043;margin:0px;font-size:12px;line-height:22px; font-weight: normal; font-size: 15px;">', $decoded);
                        $content = explode('</div>', $content[5]);
                        $content = trim($content[0]);

                        $time =  explode('<div style="color:#3C4043;margin:0px;font-size:12px;line-height:22px; font-weight: normal; font-size: 15px;">', $decoded);
                        $time = explode('</div>', $time[4]);
                        $time = trim($time[0]);
                    } else {
                        $money =  explode('<td style="text-align: right;"><span style="color:#4d4d4d; font-size:13px">', $decoded);
                        $money = explode('</span>', $money[1]);
                        $money = trim($money[0]);


                        $code =  explode('<td style="text-align: right;"><span style="color:#4d4d4d; font-size:13px">', $decoded);
                        $code = explode('</span>', $code[2]);
                        $code = trim($code[0]);


                        $phone =  explode('<td style="text-align: right;"><span style="font-size:13px;color:#4d4d4d;">', $decoded);
                        $phone = explode('</span>', $phone[2]);
                        $phone = trim($phone[0]);


                        $name =  explode('<td style="text-align: right;"><span style="font-size:13px;color:#4d4d4d;">', $decoded);
                        $name = explode('</span>', $name[1]);
                        $name =  trim($name[0]);


                        $content =  explode('<td style="text-align: right;"><span style="font-size:13px;color:#4d4d4d;">', $decoded);
                        $content = explode('</span>', $content[3]);
                        $content = trim($content[0]);
                    }
                    if ($handle) {
                        $check = false;
                        while (($line = fgets($handle)) !== false) {
                            $data_line = explode('|', $line);
                            if ($data_line[0] == $code) {
                                $check = true;
                                break;
                            }
                        }
                        if ($check == false) {
                            $money = str_replace('.', '', $money);
                            $money = str_replace(',', '.', $money);
                            $id = explode('Shopgame biller ', $content)[1];
                            $data = $code . '|' . $money . '|' . $phone . '|' . $name . '|' . $content . '|' . $time;
                            file_put_contents('logs.txt', $data . PHP_EOL, FILE_APPEND | LOCK_EX);

                            $table_biller = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM table_biller WHERE `id` = '" . $id . "'"));
                            if ($money >= $table_biller["total_money"]) {
                                mysqli_query($conn, "UPDATE table_biller SET `payed` = 1 WHERE `id` = '$id'");
                                $product_id = $table_biller["id_product"];
                                $soluong = $table_biller["soluong"];
                                $user_id = $table_biller["user_id"];
                                $account = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM table_accounts WHERE `id` = '$user_id'"));
                                $message = $account['first_name'] . " " . $account["last_name"] . " (" . $account["email"] . ") đã thanh toán thành công đơn hàng #" . $id . " với số tiền: " . number_format($money)." VND";
                                mysqli_query($conn, "INSERT INTO table_history_payemnt (`vnd`,`from_biller`,`from_user`,`message`) VALUES ($money,$id," . $account["id"] . ",'$message')");
                                mysqli_query($conn, "UPDATE table_product SET `selled` = `selled` + $soluong WHERE `id` = '$product_id'");
                                send_mail($account["email"], $table_biller);
                            }
                        }
                    } else {
                        // error opening the file.
                    }
                ?>
                <?php
                } // End foreach
                fclose($handle);
                ?>
        <?php
        } // end if
        else echo "Không tìm thấy mail";
        imap_close($connection);
    }
        ?>