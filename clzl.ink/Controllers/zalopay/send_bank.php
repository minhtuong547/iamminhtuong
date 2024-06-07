<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/head_request_admin.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Controllers/zalopay/zalopay.php');
$account = $soicoder->real_escape_string(check_string($_POST['account'])); // số zalopay chuyển
$stk = $soicoder->real_escape_string(check_string($_POST['stk'])); // sđt nhận
$bank = $soicoder->real_escape_string(check_string($_POST['bank'])); // ngân hàng
$name = $soicoder->real_escape_string(check_string($_POST['name']));
$amount = $soicoder->real_escape_string(check_string($_POST['amount'])); // số tiền
$comment = $soicoder->real_escape_string(check_string($_POST['comment'])); // nội dung
$password = $soicoder->real_escape_string(check_string($_POST['password'])); // password
// check dữ liệu
if (empty($amount) || empty($stk) || empty($account)) {
    echo "<script language='javascript'>alert('Ôi Không, Thiếu Gì Đó Rồi Kìa');window.location='/".config_admin."/bank_transfer';</script>";
    die;
}
$loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '" . $account . "' LIMIT 1 ", 1);
if (empty($loadDATA['id'])) {
    echo "<script language='javascript'>alert('Ôi Không, Lỗi Dữ Liệu Zalopay Rồi');window.location='/".config_admin."/bank_transfer';</script>";
    die;
}
// check pass
if ($loadDATA['password'] !== $password) {
    echo "<script language='javascript'>alert('Mật Khẩu Sai, Vui Lòng Thử Lại');window.location='/".config_admin."/transfer';</script>";
    die;
}
// chuyển tiền
$zalopay = new Zalopay($soicoder);
$data_bank  = explode('-', $bank);
$config_bank = array(
    "bankcode" => $data_bank[1],
    "bcbankcode" => $data_bank[0],
    "name" => $data_bank[3],
    "fullname" => $data_bank[2]
);
if ($loadDATA['type_api'] == 'app') {
    $send = $zalopay->LoadData($loadDATA)->SendMoney_Bank($stk, $amount, $comment, $config_bank);
} else {
    $send = $zalopay->LoadData($loadDATA)->SendMoney_Bank_web($stk, $amount, $comment, $config_bank);
}
if ($send['status'] == 'error') {
    echo "<script language='javascript'>alert('".$send['message']."');window.location='/".config_admin."/bank_transfer';</script>";
    die;
} else {
    $get_balance = ($loadDATA['type_api'] == 'app') ? json_decode($zalopay->LoadData($loadDATA)->getBalance(), true) : json_decode($zalopay->LoadData($loadDATA)->getBalance_web(), true);
    $soicoder->update("zalopays", array(
        'total_day' => $loadDATA['total_day'] + 1,
        'balance' =>  $get_balance['data']['balance'],
    ), " `phone` = '" . $account . "' ");
    $soicoder->insert('chuyen_tien', array(
        'type_gd' => 'sendbank',
        'tranId' => $send['data']['zp_trans_id'],
        'partnerId' => $stk,
        'partnerName' => $name,
        'amount' => $amount,
        'comment' => $comment,
        'time' => time(),
        'date_time' => date('d/m/Y'),
        'status' => 'success',
        'message' => 'Chuyển Tiền Thành Công',
        'balance' => $get_balance['data']['balance'],
        'ownerNumber' => $account,
        'ownerName' => $loadDATA['name'],
        'data' => json_encode($send['data']),
        'type' => 'zalopay'
    ));
    echo "<script language='javascript'>alert('Chuyển Tiền Thành Công, MGD: " . $send['data']['zp_trans_id'] . ", Số Dư: " . $get_balance['data']['balance'] . "');window.location='/".config_admin."/bank_transfer';</script>";
    die;
}
