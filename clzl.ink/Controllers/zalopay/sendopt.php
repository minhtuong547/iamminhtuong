<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/head_request_admin.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Controllers/zalopay/zalopay.php');
$phone = empty($_GET['phone']) ? $soicoder->real_escape_string(check_string($_POST['phone'])) : $soicoder->real_escape_string(check_string($_GET['phone']));
if (strlen($phone) == 10) {
    $zalopay = new Zalopay($soicoder);
    $select = $soicoder->num_rows("SELECT * FROM `zalopays` WHERE `phone` = '".$phone."' LIMIT 1 ");
    if ($select >= 1) {
        $soicoder->query("UPDATE `zalopays` SET
            `SECUREID` = 'underfined',
            `token` = 'underfined'
            WHERE `phone` = '$phone'
        ");
    } else {
        $zalopay = new Zalopay($soicoder);
        $data = $zalopay->getData();
        $soicoder->insert('zalopays' , array (
            'phone' => $phone,
            'SECUREID' => $data['SECUREID'],
            'deviceid' => $data['deviceid'],
            'type_api' => 'web',
            'status' => 'pending',
        ));
    }
    $loadDATA = $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '".$phone."' LIMIT 1 " , 1) ;
    $get_otp_token = $zalopay->LoadData($loadDATA)->get_otp_token();
    echo ($get_otp_token);
    $result = json_decode($get_otp_token, true);
    if (!empty($result['data']['send_otp_token'])) {
        $display_name = $result['data']['display_name'];
        $avatar = $result['data']['avatar'];
        $send_otp_token = $result['data']['send_otp_token'];
        $send_otp = $zalopay->get_otp($send_otp_token);
        // print_r($send_otp);
        if (isset($send_otp['data'])) {
            $salt = json_decode($zalopay->get_salt(), true)['data']['salt'];
            $result = json_decode($zalopay->get_public_key(), true);
            // print_r($result);
            $public_key = $result['data']['public_key'];
            $soicoder->update("zalopays", array(
                'name' => $display_name,
                "avatar" => $avatar,
                "salt" => $salt,
                "public_key" => $public_key,
                'status' => 'wait_login',
                'errorDesc' => 'Đang chờ đăng nhập',
            ), "`phone` = '$phone' ");
            $return = array(
                'status' => 'success',
                'veryotp' => 'soicoder',
                'message' => 'Gửi Otp Thành Công'
            );
            die(json_encode($return));
        } else {
            $return = array(
                'status' => 'error',
                'message' => $send_otp['error']['details']['localized_message']['message']
            );
            die(json_encode($return));
        }
    } else {
        $display_name = $result['data']['display_name'];
        $avatar = $result['data']['avatar'];
        $soicoder->update("zalopays", array(
            'name' => $display_name,
            "avatar" => $avatar,
            // "salt" => $salt,
            // "public_key" => $public_key,
            'status' => 'wait_no_otp',
            'errorDesc' => 'Đang chờ đăng nhập',
        ), "`phone` = '$phone' ");
        $return = array(
            'status' => 'success',
            'message' => 'Đăng Nhập Không Cần Otp'
        );
        die(json_encode($return));
    }
} else {
    $return = array(
        'status' => 'error',
        'message' => 'Vui Lòng Nhập Số Điện Thoại'
    );
    die(json_encode($return));
}