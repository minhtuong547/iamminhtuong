<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/head_request_admin.php');
$type = $soicoder->real_escape_string(check_string($_POST['type']));
if ($type == 'delete') {
    $soicoder->remove("zalopays","`id` = '$id' ");
    $return = array(
        'status' => 'success',
        'message' => "Xóa Thành Công"
    );
    die(json_encode($return));
} else if ($type == 'block') {
    $phone = $soicoder->real_escape_string(check_string($_POST['phone']));
    $user_id = $soicoder->real_escape_string(check_string($_POST['user_id']));
    $check_block = $soicoder->num_rows("SELECT * FROM `block_list` WHERE `user_id` = '" . $user_id . "' ");
    if ($check_block == 0) {
        $soicoder->insert('block_list', array(
            'phone' => $phone,
            'user_id' => $user_id,
            'time' => time(),
        ));
        $return = array(
            'status' => 'success',
            'message' => "Thêm Vào Danh Sách Thành Công"
        );
    } else {
        $return = array(
            'status' => 'success',
            'message' => "User Đã Tồn Tại Trong Danh Sách"
        );
    }
    die(json_encode($return));
} else if ($type == 'edit') {
    $id = $soicoder->real_escape_string(check_string($_POST['id']));
    $description = $soicoder->real_escape_string(check_string($_POST['description']));
    $trans_amount = $soicoder->real_escape_string(check_string($_POST['trans_amount']));
    $bonus = $soicoder->real_escape_string(check_string($_POST['bonus']));
    $amount_game = $soicoder->real_escape_string(check_string($_POST['amount_game']));
    $phone_result = $soicoder->real_escape_string(check_string($_POST['phone_result']));
    $soicoder->update("history", array(
        'description' => $description,
        'trans_amount' => $trans_amount,
        'bonus' => $bonus,
        'amount_game' => $amount_game,
        'phone_result' => $phone_result
    ), "`id` = '$id' ");
    $return = array(
        'status' => 'success',
        'message' => "Chỉnh Sửa Thành Công"
    );
    die(json_encode($return));
} else {
    $return = array(
        'status' => 'error',
        'message' => "Lỗi Yêu Cầu"
    );
    die(json_encode($return));
}

