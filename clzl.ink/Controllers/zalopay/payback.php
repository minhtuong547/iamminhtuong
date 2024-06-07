<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/head_request_admin.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Controllers/zalopay/zalopay.php');
$id = $soicoder->real_escape_string(check_string($_GET['id'])); // số điện thoại nhận
// check tt chưa/rồi
$check = $soicoder->num_rows("SELECT * FROM `history` WHERE `id` = '" . $id . "' AND `status` = 'done'");
if ($check == 0) {
    $data = $soicoder->fetch_assoc("SELECT * FROM `history` WHERE `id` = '" . $id . "'", 1);
    if (empty($data)) {
        echo "<script language='javascript'>alert('Không Tồn Tại Giao Dịch');window.location='/".config_admin."/history-error';</script>";
    }
    if ($data['result'] !== 'win') {
        echo "<script language='javascript'>alert('Win CC Đâu Mà Trả Tiền');window.location='/".config_admin."/history-error';</script>";
    }
    $account = $data['account'];
    $description = $data['description'];
    $phone = explode(' ', $description)[0];
    $amount = round($data['bonus']);
    $content = $data['msg_bonus'];
    $loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '" . $account . "' LIMIT 1 ", 1);
    $zalopay = new Zalopay($soicoder);
    $check_full = ($loadDATA['type_api'] == 'app') ? $zalopay->LoadData($loadDATA)->GET_TRANS_BY_TID($data['trans_id']) : $zalopay->LoadData($loadDATA)->GET_TRANS_BY_TID_WEB($data['trans_id']);
    $result = $check_full["data"]['transaction'];
    $code_orders = $result["template_info"]["custom_fields"][0]["value"];  // code_orders
    $send = ($loadDATA['type_api'] == 'app') ? $zalopay->LoadData($loadDATA)->ResendMoney($code_orders, $content, $amount) : $zalopay->LoadData($loadDATA)->ResendMoney_web($code_orders, $content, $amount);
    if ($send['status'] == 'success') {
        $trandID = $send['data']['zp_trans_id'];
        // up trạng thái
        $soicoder->update("history", array(
            'msg_bonus' => $content,
            'status_text' => 'Đã Thanh Toán Lại',
            'status' => 'done',
        ), " `id` = '" . $id . "'");
        // update số dư
        $get_balance = ($loadDATA['type_api'] == 'app') ? json_decode($zalopay->LoadData($loadDATA)->getBalance(), true) : json_decode($zalopay->LoadData($loadDATA)->getBalance_web(), true);
        $soicoder->update("zalopays", array(
            'total_day' => $loadDATA['total_day'] + 1,
            'balance' =>  $get_balance['data']['balance'],
        ), " `phone` = '" . $account . "' ");
        $return = "Chuyển Tiền Thành Công, MGD: " . $trandID . ", Số Dư: " . $get_balance['data']['balance'];
        echo "<script language='javascript'>alert('" . $return . "');window.location='/".config_admin."/history-error';</script>";
        die;
    } else {
        echo "<script language='javascript'>alert('" . $send['message'] . "');window.location='/".config_admin."/history-error';</script>";
        die;
    }
    echo $data['phone_nhan'];
} else {
    echo "<script language='javascript'>alert('Đơn Này Đã Được Trả Thưởng');window.location='/".config_admin."/history-error';</script>";
    die;
}