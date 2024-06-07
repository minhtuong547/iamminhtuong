<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/head_request_admin.php');

$soicoder->update("top_up", array(
    'top1' => $soicoder->real_escape_string(check_string($_POST['sdt1'])),
    'top2' => $soicoder->real_escape_string(check_string($_POST['sdt2'])),
    'top3' => $soicoder->real_escape_string(check_string($_POST['sdt3'])),
    'top4' => $soicoder->real_escape_string(check_string($_POST['sdt4'])),
    'top5' => $soicoder->real_escape_string(check_string($_POST['sdt5']))
), "`id` = '2' ");
$soicoder->update("top_up", array(
    'top1' => $soicoder->real_escape_string(check_string($_POST['top1'])),
    'top2' => $soicoder->real_escape_string(check_string($_POST['top2'])),
    'top3' => $soicoder->real_escape_string(check_string($_POST['top3'])),
    'top4' => $soicoder->real_escape_string(check_string($_POST['top4'])),
    'top5' => $soicoder->real_escape_string(check_string($_POST['top5']))
), "`id` = '3' ");

echo "<script language='javascript'>alert('Cập Nhật Thành Công');window.location='/".config_admin."/top';</script>";