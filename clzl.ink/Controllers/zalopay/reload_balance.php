<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/head_request_admin.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Controllers/zalopay/zalopay.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$list = $soicoder->fetch_assoc("SELECT * FROM `zalopays` ORDER BY id desc LIMIT 1000", 0);
foreach ($list as $loadDATA) {
    $phone = $loadDATA['phone'];
    $zalopay = new Zalopay($soicoder);
    $get_balance = ($loadDATA['type_api'] == 'app') ? json_decode($zalopay->LoadData($loadDATA)->getBalance(), true) : json_decode($zalopay->LoadData($loadDATA)->getBalance_web(), true);
    if (empty($get_balance['error'])) {
        $month = date('m');
        $year = date('Y');
        $get_revenue = ($loadDATA['type_api'] == 'app') ? $zalopay->LoadData($loadDATA)->income_outcome($month, $year) : $zalopay->LoadData($loadDATA)->income_outcome_web($month, $year);
        $soicoder->update("zalopays", array(
            'receive_mon' => $get_revenue['data']['income_outcome'][0]['income_amount'],
            'ex_mon' => $get_revenue['data']['income_outcome'][0]['outcome_amount'],
            'balance' => $get_balance['data']['balance'],
        ), "`phone` = '$phone' ");
    } else {
        $soicoder->update("zalopays", array(
            'balance' => "0",
            'status' => 'out',
            'errorDesc' => 'Hết Thời Gian Truy Cập Do Đổi Thiết Bị',
        ), "`phone` = '$phone' ");
    }
}
echo "<script language='javascript'>alert('Cập Nhật Số Dư Thành Công');window.location='/".config_admin."/zalopay';</script>";
die;
