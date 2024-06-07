<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/head_request_admin.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Controllers/zalopay/zalopay.php');
$account = $soicoder->real_escape_string(check_string($_POST['account'])); // tài khoản zalopay
$stk = $soicoder->real_escape_string(check_string($_POST['stk']));
$bank = $soicoder->real_escape_string(check_string($_POST['bank']));

if (isset($_POST['account'])) {
    $zalopay = new Zalopay($soicoder);
    $loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '" . $account . "' LIMIT 1 ", 1);
    if (isset($loadDATA['phone'])) {
        $data_config_bank = explode('-', $bank);
        if ($loadDATA['type_api'] == 'app') {
            $get_name_bank = $zalopay->LoadData($loadDATA)->get_name_bank($stk, $data_config_bank[0]);
        } else {
            $get_name_bank = $zalopay->LoadData($loadDATA)->get_name_bank_web($stk, $data_config_bank[0]);
        }
        // print_r($get_name_bank);
        if (empty($get_name_bank['data'])) {
            echo json_encode(array(
                'msg' => 'Số Tài Khoản Không Hợp Lệ',
            ));
        } else {
            echo json_encode(array(
                'msg' => empty($get_name_bank['data']['fullName']) ? $get_name_bank['data']['full_name'] : $get_name_bank['data']['fullName']
            ));
        }
    } else {
        echo json_encode(array(
            'msg' => 'Vui Lòng Chọn Số Zalopay Chuyển Khoản',
        ));
    }
} else {
    echo json_encode(array(
        'msg' => 'Vui Lòng Chọn Số Zalopay Chuyển Khoản',
    ));
}