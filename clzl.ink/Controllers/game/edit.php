<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/head_request_admin.php');
$type = $soicoder->real_escape_string(check_string($_POST['type']));
if ($type == 'edit') {
    $id = $soicoder->real_escape_string(check_string($_POST['id']));
    $content = $soicoder->real_escape_string(check_string($_POST['content']));
    $content2 = $soicoder->real_escape_string(check_string($_POST['content2']));
    $result = $soicoder->real_escape_string(check_string($_POST['result']));
    $ratio = $soicoder->real_escape_string(check_string($_POST['ratio'])); 
    $description = $soicoder->real_escape_string(($_POST['description']));
    $soicoder->update("game", array(
        'content' => $content,
        'content2' => $content2,
        'result' => $result,
        'ratio' => $ratio,
        'description' => base64_encode($description)
    ), "`id` = '$id' ");
    $return = array(
        'status' => 'success',
        'message' => "Chỉnh Sửa Game Thành Công"
    );
    die(json_encode($return));
} else if ($type == 'active') {
    $id = $soicoder->real_escape_string(check_string($_POST['id']));
    $data = $soicoder->fetch_assoc("SELECT * FROM `game` WHERE `id` = '" . $id . "'", 1);
    $soicoder->update("game", array(
        'status' => ($data['status'] == 'on') ? "off" : "on",
    ), "`id` = '$id' ");
    $return = array(
        'status' => 'success',
        'message' => "Chỉnh Sửa Game Thành Công"
    );
    die(json_encode($return));
} else {
    $return = array(
        'status' => 'error',
        'message' => "Yêu Cầu Không Hợp Lệ"
    );
    die(json_encode($return));
}
