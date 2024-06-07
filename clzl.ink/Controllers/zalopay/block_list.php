<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/head_request_admin.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Controllers/zalopay/zalopay.php');
$type = $soicoder->real_escape_string(check_string($_POST['type']));

if ($type == 'add') {
    $phone_block = $soicoder->real_escape_string(check_string($_POST['phone_block']));
    // kiểm tra tồn tại
    $check = $soicoder->num_rows("SELECT * FROM `block_list` WHERE `phone` = '" . $phone_block . "' LIMIT 1 ");
    if ($check != 0) {
        echo "<script language='javascript'>alert('Người Dùng Này Đã Được Thêm Trước Đó');window.location='/admin/player-block';</script>";
        die;
    }
    // kiểm tra user id
    if (preg_match('/^(\+84|0)[0-9]{9}$/', $phone_block)) {
        $loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `status` = 'success' ORDER BY RAND() LIMIT 1 ", 1);
        $zalopay = new Zalopay($soicoder);
        $check_info = $zalopay->LoadData($loadDATA)->get_info($phone_block);
        // print_r($check_info);
        $user_id = $check_info['userid'];
    } else {
        $user_id = $phone_block;
    }
    $soicoder->insert('block_list', array(
        'phone' => $phone_block,
        'user_id' => $user_id,
        'time' => time(),
    ));
    echo "<script language='javascript'>alert('Thêm Vào Danh Sách Chặn Thành CÔng');window.location='/admin/player-block';</script>";
    die;
} else if ($type == 'delete') {
    $id = $soicoder->real_escape_string(check_string($_POST['id']));
    $soicoder->remove("block_list","`id` = '$id' ");
    $return = array(
        'status' => 'success',
        'message' => "Xóa Thành Công"
    );
    die(json_encode($return));
} else {

}