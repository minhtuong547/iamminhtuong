<?php
// Require các thư viện PHP
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/config.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/class.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/function.php');
// Kết nối database
$soicoder = new VIP();
$soicoder->connect();
$soicoder->set_char('utf8');
// Thông tin chung
$_DOMAIN = "https://" . $_SERVER["SERVER_NAME"] . "/";
$root = $_SERVER["DOCUMENT_ROOT"];
$useragent = $_SERVER['HTTP_USER_AGENT'];
$_SESSION['useragent'] = $useragent;
//Thời gian
date_default_timezone_set('Asia/Ho_Chi_Minh');
$date_current = '';
$date_current = date("Y-m-d H:i:sa");
$date_now = '';
$date_now = date("Y-m-d");
$time_now = time();
$day = date('d', time());
$month = date('m', time());
$year = date('Y', time());
$settings = $soicoder->fetch_assoc("SELECT * FROM `settings` WHERE `id` = '1' LIMIT 1", 1);
if (strtotime(TIME) < time()) {
    echo "Website Đã Hết Hạn Sử Dụng";
    die;
}