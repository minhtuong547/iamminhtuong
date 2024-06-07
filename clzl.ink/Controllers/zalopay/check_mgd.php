<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/head_request_admin.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Controllers/zalopay/zalopay.php');
$account = $soicoder->real_escape_string(check_string($_POST['account'])); // tài khoản zalopay
$trans_id = $soicoder->real_escape_string(check_string($_POST['tranId'])); // mã giao dịch
if (isset($_POST['account'])) {
    $zalopay = new Zalopay($soicoder);
    $loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '" . $account . "' LIMIT 1 ", 1);
    if (isset($loadDATA['phone'])) {

        $check_full = ($loadDATA['type_api'] == 'app') ? $zalopay->LoadData($loadDATA)->GET_TRANS_BY_TID($trans_id) : $zalopay->LoadData($loadDATA)->GET_TRANS_BY_TID_WEB($trans_id);
        if (isset($check_full['error'])) {
            echo "<script language='javascript'>alert('Mã Giao Dịch Không Xác Định');window.location='/".config_admin."/check_mgd';</script>";
            die;
        } else {
            $result = $check_full["data"]['transaction'];
            $partnerId = $result["template_info"]["custom_fields"][2]["value"];  // số zalopay
            $comment = (!empty($result["description"])) ? $result["description"] : ""; // nội dung
            $status = $result["sign"];
            $type = ($status == -1) ? "Chuyển Tiền" : "Nhận Tiền";
            $partnerName = $result["template_info"]["custom_fields"][1]["value"];  // tên
            $trans_amount = empty($result["trans_amount"]) ? 0 : $result["trans_amount"];  // số tiền
            $app_trans_id = empty($result["app_trans_id"]) ? "" : $result["app_trans_id"];
            $millisecond = $result['trans_time']; // time
            $check = $soicoder->num_rows("SELECT * FROM `history` WHERE `trans_id` = '" . $trans_id . "' LIMIT 1 ");
            if ($check != 0) {
                $data = $soicoder->fetch_assoc("SELECT * FROM `history` WHERE `trans_id` = '" . $trans_id . "' LIMIT 1 ", 1);
                $list_status_text = array(
                    'success' => 'Đã Kiểm Tra',
                    'undefined' => 'Chưa Kiểm Tra Xong Hoặc Thua',
                    'Chuyển Tiền Thành Công' => 'Chuyển Tiền Thành Công'
                );
                $list_status = array(
                    'wait' => 'Đang Xử Lý',
                    'undefined' => 'Thua Hoặc Lỗi',
                    'done' => 'Đã Thanh Toán Thành Công',
                    'wrong' => 'Sai Min/Max',
                    'wrong_content' => 'Sai Nội Dung',
                    'late' => 'Số Đã Tắt, Không Được Trả Thưởng'
                );
                $status = $list_status_text[$data['status_text']] . ' | ' . $list_status[$data['status']];
            } else {
                $status = 'Not Found Database';
            }
            $_SESSION['check_mgd'] = array(
                "id" => $app_trans_id,
                "trans_id" => $trans_id,
                "partnerId" => $partnerId,
                "type" => $type,
                "comment" => $comment,
                "status" => $status,
                "partnerName" => $partnerName,
                "trans_amount" => $trans_amount,
                "time" => strtotime($millisecond)
            );
            echo "<script language='javascript'>window.location='/".config_admin."/check_mgd';</script>";
            die;
        }
    } else {
        echo "<script language='javascript'>alert('SĐT Không Tồn Tại Trên Hệ Thống');window.location='/".config_admin."/check_mgd';</script>";
        die;
    }
} else {
    echo "<script language='javascript'>alert('Vui Lòng Nhập SĐT');window.location='/".config_admin."/check_mgd';</script>";
    die;
}
?>