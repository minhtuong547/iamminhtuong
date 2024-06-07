<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/head_request_admin.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Controllers/zalopay/zalopay.php');
$receiver = $soicoder->real_escape_string(check_string($_POST['receiver'])); // sđt nhận
$account = $soicoder->real_escape_string(check_string($_POST['account'])); // số zalopay chuyển
$amount = $soicoder->real_escape_string(check_string($_POST['amount'])); // số tiền
$comment = $soicoder->real_escape_string(check_string($_POST['comment'])); // nội dung
$password = $soicoder->real_escape_string(check_string($_POST['password'])); // password
// check dữ liệu
if (empty($amount) || empty($receiver) || empty($account) || empty($password)) {
    echo "<script language='javascript'>alert('Ôi Không, Thiếu Gì Đó Rồi Kìa');window.location='/".config_admin."/transfer';</script>";
    die;
}
$loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '" . $account . "' LIMIT 1 ", 1);
if (empty($loadDATA['id'])) {
    echo "<script language='javascript'>alert('Ôi Không, Lỗi Dữ Liệu Zalopay Rồi');window.location='/".config_admin."/transfer';</script>";
    die;
}
// check pass
if ($loadDATA['password'] !== $password) {
    echo "<script language='javascript'>alert('Mật Khẩu Sai, Vui Lòng Thử Lại');window.location='/".config_admin."/transfer';</script>";
    die;
}
// chuyển tiền
$zalopay = new Zalopay($soicoder);
if ($loadDATA['type_api'] == 'app') {
    $send = $zalopay->LoadData($loadDATA)->SendMoney($receiver, $comment, $amount);
} else {
    $send = $zalopay->LoadData($loadDATA)->SendMoney_web($receiver, $comment, $amount);
}
// print_r($send);
if ($send['status'] == 'error') {
    echo "<script language='javascript'>alert('".$send['message']."');window.location='/".config_admin."/transfer';</script>";
    die;
} else {
    $get_balance = ($loadDATA['type_api'] == 'app') ? json_decode($zalopay->LoadData($loadDATA)->getBalance(), true) : json_decode($zalopay->LoadData($loadDATA)->getBalance_web(), true);
    $soicoder->update("zalopays", array(
        'total_day' => $loadDATA['total_day'] + 1,
        'balance' =>  $get_balance['data']['balance'],
    ), " `phone` = '" . $account . "' ");
    $soicoder->insert('chuyen_tien', array(
        'type_gd' => 'sendmoney',
        'tranId' => $send['data']['trans_id'],
        'partnerId' => $send['data']['partner_id'],
        'partnerName' => $send['data']['partner_name'],
        'amount' => $amount,
        'comment' => $comment,
        'time' => time(),
        'date_time' => date('d/m/Y'),
        'status' => 'success',
        'message' => 'Chuyển Tiền Thành Công',
        'balance' => $get_balance['data']['balance'],
        'ownerNumber' => $send['data']['owner_phone'],
        'ownerName' => $send['data']['owner_name'],
        'data' => json_encode($send['data']),
        'type' => 'zalopay'
    ));
    // print_r($send);
    // die;
    echo "<script language='javascript'>alert('Chuyển Tiền Thành Công, MGD: " . $send['data']['zp_trans_id'] . ", Số Dư: " . $get_balance['data']['balance'] . "');window.location='/".config_admin."/transfer';</script>";
    die;
}
