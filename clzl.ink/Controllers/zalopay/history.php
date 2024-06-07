<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/head_request_admin.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Controllers/zalopay/zalopay.php');
$phone = check_string($_GET['phone']);


if (strlen($phone) !== 10) {
    echo "Số điện thoại không đúng định dạng";
    die;
}
$zalopay = new Zalopay($soicoder);
$loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '" . $phone . "' LIMIT 1 ", 1);




$orderCode = '2310150000177269';
$phone = '0702559818'; 
$msg = 'Test resend'; 
$amount = 1000;
header("Content-type:text/json");

// print_r($loadDATA);
// $info = $zalopay->LoadData($loadDATA)->getOrderInfo($orderCode);
// $get = $zalopay->LoadData($loadDATA)->Reward_web($info, $msg, $amount);

// echo json_encode($get, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
// die;





// code bank config
// $file_config_code = json_decode(file_get_contents('code_bank.json'), true);
// print_r($file_config_code); die;
// foreach ($file_config_code as $data) {
//     $soicoder->insert('code_bank' , array (
//         'bankcode' => $data['bankcode'],
//         'bcbankcode' => $data['bcbankcode'],
//         'name' => $data['name'],
//         'fullname' => $data['fullname']
//     ));
// }




header("Content-type:text/json");
// echo json_encode($loadDATA); die;
$config_bank = array(
    "bankcode" => "MB",
    "bcbankcode" => "ZPMB",
    "name" => "MBBank",
    "fullname" => "Ngân hàng TMCP Quân Đội"
);
$description = "Test 2";
$amount = 20000;
$stk = '89999999938';
$get = $zalopay->LoadData($loadDATA)->SendMoney_Bank_web($stk, $amount, $description, $config_bank);
echo json_encode($get, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
die;





// $list_card = array(
//     'MOBIFONE',
//     'VIETTEL',
//     'VINAFONE',
//     'VIETNAMOBILE'
// );
// $list_Price_mobi = array(
//     10000,
//     20000,
//     30000,
//     100000,
//     200000,
//     500000
// );

// $list_Price_vina = array(
//     10000,
//     20000,
//     30000,
//     100000,
//     200000,
//     500000
// );

// $list_Price_viettel = array(
//     10000,
//     20000,
//     30000,
//     100000,
//     200000,
//     300000,
//     500000
// );

// $list_Price_vietnamobile = array(
//     10000,
//     20000,
//     30000,
//     100000,
//     200000
// );


// $unitPrice = 10000;
// $cardCode = 'MOBIFONE';

// $result = $zalopay->LoadData($loadDATA)->MUATHE($cardCode, $unitPrice);
// print_r($result);








