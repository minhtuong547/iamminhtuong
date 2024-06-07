<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/head_request_admin.php');

$type = $soicoder->real_escape_string(check_string($_POST['type']));

if ($type == 'add') {
    $zalopay_reward = check_string($_POST['zalopay_reward']);
    $code = check_string($_POST['code']);
    $money = check_string($_POST['money']);
    $limit_import = check_string($_POST['limit_import']);
    $soicoder->insert('code', array(
        'zalopay_reward' => $zalopay_reward,
        'code' => $code,
        'money' => $money,
        'limit_import' => $limit_import,
        'entered' => '0',
        'status' => 'on',
        'time' => time(),
    ));
    echo "<script language='javascript'>alert('Thêm Gifcode Thành CÔng');window.location='/".config_admin."/gifcode';</script>";
    die;
} else if ($type == 'delete') {
    $id = check_string($_POST['id']);
    $soicoder->remove("code","`id` = '$id' ");
    $return = array(
        'status' => 'success',
        'message' => "Xóa Thành Công"
    );
    die(json_encode($return));
} else {

}