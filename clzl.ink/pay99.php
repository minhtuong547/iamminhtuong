<?php session_start();
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Models/connect.php');

// ngày
$time_today = strtotime('today');
$his_today = $soicoder->fetch_assoc("SELECT SUM(`trans_amount`),SUM(`bonus`) FROM `history` WHERE (time >= '$time_today' AND `status` <> 'wrong' AND `status` <> 'wrong_content') ", 1);
$send_today = $soicoder->fetch_assoc("SELECT SUM(`amount`) FROM `chuyen_tien` WHERE (time >= '$time_today') ", 1);
$win_today = $soicoder->fetch_assoc("SELECT COUNT(*) FROM `history` WHERE (time >= '$time_today' AND `result` = 'win') ", 1);
$loss_today = $soicoder->fetch_assoc("SELECT COUNT(*) FROM `history` WHERE (time >= '$time_today' AND `result` <> 'win' AND `status` <> 'wrong' AND `status` <> 'wrong_content') ", 1);
$list_user_day = $soicoder->fetch_assoc("SELECT DISTINCT `phone` FROM `history` WHERE time >= '$time_today' ", 0);

// tháng
$date = date_create(date('Y-m-01'));
$date->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
$time_month = $date->format('U');
$his_month = $soicoder->fetch_assoc("SELECT SUM(`trans_amount`),SUM(`bonus`) FROM `history` WHERE (time >= '$time_month' AND `status` <> 'wrong' AND `status` <> 'wrong_content') ", 1);
$send_month = $soicoder->fetch_assoc("SELECT SUM(`amount`) FROM `chuyen_tien` WHERE (time >= '$time_month') ", 1);
$win_month = $soicoder->fetch_assoc("SELECT COUNT(*) FROM `history` WHERE (time >= '$time_month' AND `result` = 'win') ", 1);
$loss_month = $soicoder->fetch_assoc("SELECT COUNT(*) FROM `history` WHERE (time >= '$time_month' AND `result` <> 'win' AND `status` <> 'wrong' AND `status` <> 'wrong_content') ", 1);

// all
$win_all = $soicoder->fetch_assoc("SELECT COUNT(*) FROM `history` WHERE `result` = 'win' ", 1);
$loss_all = $soicoder->fetch_assoc("SELECT COUNT(*) FROM `history` WHERE (`result` <> 'win' AND `status` <> 'wrong' AND `status` <> 'wrong_content') ", 1);


$list_user = $soicoder->fetch_assoc("SELECT DISTINCT `phone` FROM `history` ", 0);

$result = array(
    "Today" => array(
        array(
            "Name" => "Tổng nhận",
            "value" => format_cash($his_today['SUM(`trans_amount`)'])
        ),
        array(
            "Name" => "Tổng trả thưởng",
            "value" => format_cash($his_today['SUM(`bonus`)'])
        ),
        array(
            "Name" => "Doanh Thu",
            "value" => format_cash($his_today['SUM(`trans_amount`)'] - $his_today['SUM(`bonus`)'])
        ),
        array(
            "Name" => "Tổng thắng",
            "value" => $win_today['COUNT(*)']
        ),
        array(
            "Name" => "Tổng thua",
            "value" => $loss_today['COUNT(*)']
        ),
        array(
            "Name" => "Số người chơi mới",
            "value" => count($list_user_day)
        ),
    ),
    "This_month" => array(
        array(
            "Name" => "Tổng nhận",
            "value" => format_cash($his_month['SUM(`trans_amount`)'])
        ),
        array(
            "Name" => "Tổng trả thưởng",
            "value" => format_cash($his_month['SUM(`bonus`)'])
        ),
        array(
            "Name" => "Doanh Thu",
            "value" => format_cash(($his_month['SUM(`trans_amount`)']) - ($his_month['SUM(`bonus`)']))
        ),
        array(
            "Name" => "Tổng thắng",
            "value" => $win_month['COUNT(*)']
        ),
        array(
            "Name" => "Tổng thua",
            "value" => $loss_month['COUNT(*)']
        ),
        array(
            "Name" => "Số người chơi mới",
            "value" => count($list_user)
        ),
    )
);



header("Content-type:text/json");
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);


?>