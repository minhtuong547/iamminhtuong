<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$render = [];
$list = $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `pay` = 'on' AND `status` = 'success' ", 0);
foreach ($list as $data) {
    $info_phone = $soicoder->fetch_assoc("SELECT SUM(`trans_amount`) FROM `history` WHERE `date` = '" . date('d/m/Y') . "' AND `account` =  '" . $data['phone'] . "'", 1);
    $info_chyen = $soicoder->fetch_assoc("SELECT SUM(`bonus`),COUNT(*) FROM `history` WHERE `bonus` > 0 AND `date` = '" . date('d/m/Y') . "' AND `account` =  '" . $data['phone'] . "'", 1);
    $info_chuyentien = $soicoder->fetch_assoc("SELECT SUM(`amount`),COUNT(*) FROM `chuyen_tien` WHERE `date_time` = '" . date('d/m/Y') . "' AND `ownerNumber` =  '" . ($data['phone']) . "'", 1);
    // print_r($info_chuyentien)
    $level = $info_phone['SUM(`trans_amount`)']; // tổng số tiền nhận trong ngày
    $sum_gd = $info_chyen['COUNT(*)'] + $info_chuyentien['COUNT(*)']; // tổng số giao dịch chuyển trong ngày
    $sum_chuyentien = $info_chuyentien['SUM(`amount`)'] + $info_chyen['SUM(`bonus`)']; // tổng số tiền chuyển trong ngày

    if ($sum_chuyentien > $settings['limit_monney_day']) {
        continue;
    }
    // if ($sum_gd > $settings['limit_gd']) {
    //     continue;
    // }
    // if ($sum_gd > $settings['limit_gd'] - 20) {
    //     $color = "red";
    //     $status = "text-warning";
    //     $msg = '<span class="badge badge-warning">Sắp Bảo trì</span>';
    // } else {
        $color = "green";
        $status = "text-success";
        $msg = '<span class="badge badge-success">Hoạt động</span>';
    // }
    $value = array(
        "phone" => $data['phone'],
        "user_id" => $data['user_id'],
        "color" => $color,
        "sum_chuyentien" => format_cash($sum_chuyentien),
        "sum_gd" => $sum_gd,
        "min" => format_cash($data['min']),
        "max" => format_cash($data['max'])
    );
    array_push($render, $value);
}
header("Content-type:text/javascript");
echo json_encode($render, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);