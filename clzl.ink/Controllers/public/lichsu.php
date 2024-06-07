<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
$trans_id = $soicoder->real_escape_string(check_string($_POST['trans_id']));
// check dữ liệu
if (!is_numeric($trans_id)) {
    $return = array(
        'status' => 'error',
        'msg' => "Mã Giao Dịch Không Hợp Lệ"
    );
    die(json_encode($return));
}
$check = $soicoder->xss_num_rows("SELECT * FROM `history` WHERE `trans_id` = ? LIMIT 1 ", array($trans_id));
if (empty($check) || $check == '' || $check == 0) {
    $return = array(
        'status' => 'error',
        'msg' => "Không Tồn Tại Mã Giao Dịch Này"
    );
    die(json_encode($return));
} else {
    $data = $soicoder->fetch_assoc("SELECT * FROM `history` WHERE `trans_id` = '".$trans_id."' LIMIT 1 ", 1);
    if ($data['result'] == 'win') {
        $return = array(
            'status' => 'success',
            'msg' => $data['status_text'],
            'data' => array(
                'account' => "******".substr($data['account'], -4),
                'phone' => "******".substr($data['phone'], -4),
                'phone_result' => "******".substr($data['phone_result'], -4),
                'trans_id' => $data['trans_id'],
                'trans_amount' => format_cash($data['trans_amount']),
                'game' => $data['game'],
                'description' => $data['description'],
                'bonus' => format_cash($data['bonus']),
                'status_text' => $data['status_text'],
                'msg_bonus' => $data['msg_bonus'],
                'result' => 'Thắng',
                'time' => date('H:i:s d/m/Y', $data['time'])
            )
        );
        die(json_encode($return));
    } else if ($data['status'] == 'wait' || $data['status'] == 'wait_tt') {
        $return = array(
            'status' => 'success',
            'msg' => "WIN | Lỗi Zalopay, Có Thể Admin Thanh Toán Tay Hoặc Tự Động Vào Ngày Mai"
        );
        die(json_encode($return));
    } else if ($data['status'] == 'waiting') {
        $return = array(
            'status' => 'error',
            'msg' => "Đang Xử Lý, Vui Lòng Đợi"
        );
        die(json_encode($return));
    } else if ($data['status'] == 'block') {
        $return = array(
            'status' => 'win',
            'msg' => "Spam Do Block Nên Không Được Trả Thưởng"
        );
        die(json_encode($return));
    } else if ($data['status'] == 'late') {
        $return = array(
            'status' => 'error',
            'msg' => "Số Đã Tắt, Không Được Trả Thưởng"
        );
        die(json_encode($return));
    } else if ($data['status'] == 'wrong') {
        $return = array(
            'status' => 'error',
            'msg' => $settings['wrong_result']
        );
        die(json_encode($return));
    } else if ($data['status'] == 'wrong_content') {
        $return = array(
            'status' => 'error',
            'msg' => $settings['wrong_content_result']
        );
        die(json_encode($return));
    } else {
        $return = array(
            'status' => 'lose',
            'msg' => "Thua, Chúc Bạn May Mắn Lần Sau",
            'data' => array(
                'account' => "******".substr($data['account'], -4),
                'phone' => "******".substr($data['phone'], -4),
                'phone_result' => "******".substr($data['phone_result'], -4),
                'trans_id' => $data['trans_id'],
                'trans_amount' => format_cash($data['trans_amount']),
                'game' => $data['game'],
                'description' => $data['description'],
                'bonus' => format_cash($data['bonus']),
                'status_text' => $data['status_text'],
                'msg_bonus' => $data['msg_bonus'],
                'result' => 'Thua, Chúc Bạn May Mắn Lần Sau',
                'time' => date('H:i:s d/m/Y', $data['time'])
            )
        );
        die(json_encode($return));
    }
}


