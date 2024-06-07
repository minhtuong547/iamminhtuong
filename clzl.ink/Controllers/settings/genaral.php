<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/head_request_admin.php');
// print_r($_POST); die;
foreach ($_POST as $key => $value) {
    $soicoder->update("settings", array(
        $key => $value
    ), "`id` = '1' ");
}
echo "<script language='javascript'>alert('Cập Nhật Thành Công');window.location='/".config_admin."/setting';</script>";