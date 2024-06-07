<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Controllers/zalopay/zalopay.php');

// check bảo trì
if ($settings['status'] == 'off') {
    die('Web Đang Bảo Trì');
}
// check bật auto
$list = $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `status` = 'success' AND `pay` = 'on' LIMIT 1000", 0);
if (count($list) == 0) {
    echo "Không Có Zalopay Nào Được Bật";
    die;
}
if ($settings['type_reward'] == 'rand') {
    echo "Loại Trả Thưởng Không Hỗ Trợ";
    die;
}

foreach ($list as $loadDATA) {
    $phone = $loadDATA['phone'];
    $reward = $loadDATA['reward'];
    if ($phone == $reward) {
        echo "[".$phone.",Số Cần Bơm Giống Số Chính]";
        continue;
    } 
    // else if ($loadDATA['reward'] > )
    $zalopay = new Zalopay($soicoder);

}