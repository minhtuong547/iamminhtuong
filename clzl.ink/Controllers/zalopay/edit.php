<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/head_request_admin.php');
$type = $soicoder->real_escape_string(check_string($_POST['type']));
$id = $soicoder->real_escape_string(check_string($_POST['id']));
if ($type == 'edit') {
    $data = $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `id` = '" . $id . "'", 1);
    $reward = empty($_POST['reward']) ? $data['reward'] : check_string($_POST['reward']);
    $min = check_string($_POST['min']);
    $max = check_string($_POST['max']);
    $soicoder->update("zalopays", array(
        'reward' => $reward,
        'min' => $min,
        'max' => $max,
    ), "`id` = '$id' ");
    $return = array(
        'status' => 'success',
        'message' => "Chỉnh Sửa Thành Công"
    );
    die(json_encode($return));
} else if ($type == 'active') {
    $data = $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `id` = '" . $id . "'", 1);
    $soicoder->update("zalopays", array(
        'pay' => ($data['pay'] == 'on') ? "off" : "on",
        'time_login' => time()
    ), "`id` = '$id' ");
    $return = array(
        'status' => 'success',
        'message' => "Chỉnh Sửa Thành Công"
    );
    die(json_encode($return));
} else if ($type == 'auto') {
    $data = $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `id` = '" . $id . "'", 1);
    $soicoder->update("zalopays", array(
        'auto' => ($data['auto'] == 'on') ? "off" : "on"
    ), "`id` = '$id' ");
    $return = array(
        'status' => 'success',
        'message' => "Chỉnh Sửa Thành Công"
    );
    die(json_encode($return));
} else if ($type == 'delete') {
    $soicoder->remove("zalopays","`id` = '$id' ");
    $return = array(
        'status' => 'success',
        'message' => "Xóa Thành Công"
    );
    die(json_encode($return));
} else {
    $return = array(
        'status' => 'error',
        'message' => "Lỗi Yêu Cầu"
    );
    die(json_encode($return));
}

