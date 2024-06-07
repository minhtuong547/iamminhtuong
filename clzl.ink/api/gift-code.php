<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Controllers/zalopay/zalopay.php');
$jsonData = json_decode(file_get_contents("php://input"), true);
$phone = $soicoder->real_escape_string(check_string($jsonData['phone']));
$code = $soicoder->real_escape_string(check_string($jsonData['code']));
$check_code = $soicoder->num_rows("SELECT * FROM `code` WHERE `code` = '".$code."' LIMIT 1", 1);
if ($check_code == 0) {
    $return = array(
        'status' => 'error',
        'message' => "Mã Code Không Tồn Tại"
    );
    die(json_encode($return));
}
$his = $soicoder->num_rows("SELECT * FROM `code_his` WHERE `code` = '".$code."' AND `phone` =  '".$phone."' LIMIT 1");
if ($his == 0) {
    $data = $soicoder->fetch_assoc("SELECT * FROM `code` WHERE `code` = '".$code."' LIMIT 1", 1);
    // print_r($data); die;
    if ($data['status'] == 'off') {
        $return = array(
            'status' => 'error',
            'message' => "Mã Code Đã Bị Khóa"
        );
        die(json_encode($return));
    } else if ($data['zalopay_reward'] == 'NULL') {
        $return = array(
            'status' => 'error',
            'message' => "Lỗi Do Zalopay Trả Thưởng Không Tồn Tại"
        );
        die(json_encode($return));
    } else if ($data['entered'] >= $data['limit_import']) {
        $return = array(
            'status' => 'error',
            'message' => "Đã Hết Lượt Nhập Code"
        );
        die(json_encode($return));
    } else {
        $account = $data['zalopay_reward'];
        // echo "SELECT * FROM `zalopays` WHERE `phone` = '".$account."' LIMIT 1 ";
        $select = $soicoder->num_rows("SELECT * FROM `zalopays` WHERE `phone` = '".$account."' LIMIT 1 ");
        if ($select == 0) {
            $return = array(
                'status' => 'error',
                'message' => "Số Zalopay Không Tồn Tại Trên Hệ Thống"
            );
            die(json_encode($return));
        } else {
            $zalopay = new Zalopay($soicoder);
            $content = "Thưởng Nhập Code | ".$code;
            $loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '".$account."' LIMIT 1 " , 1);
            $send = $zalopay->LoadData($loadDATA)->SendMoney($phone, $content, $data['money']);
            if ($send['status'] == 'success') {
                $soicoder->insert('code_his' , array (
                    'code' => $code,
                    'phone' => $phone,
                    'zalopay_reward' => $account,
                    'day' => ''.date('d/m/Y').'',
                    'money' => $data['money'],
                    'time' => time()
                ));
                $soicoder->update("code", array(
                    'entered' => $data['entered'] + 1,
                ), "`code` = '".$code."'");
                $return = array(
                    'status' => 'success',
                    'message' => "Nhận Tiền Thành Công"
                );
                die(json_encode($return));
            } else {
                $return = array(
                    'status' => 'error',
                    'message' => "Lỗi Zalopay, Vui Lòng Liên Hệ Admin"
                );
                die(json_encode($return));
            }
        }
    }
} else {
    $return = array(
        'status' => 'error',
        'message' => "Bạn Đã Nhận Thưởng Từ Code Này"
    );
    die(json_encode($return));
}