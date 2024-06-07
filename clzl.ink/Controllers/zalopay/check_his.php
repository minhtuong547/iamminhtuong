<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/head_request_admin.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Controllers/zalopay/zalopay.php');
$account = $soicoder->real_escape_string(check_string($_POST['account'])); // tài khoản momo 
$limit = $soicoder->real_escape_string(check_string($_POST['limit'])); // mã giao dịch
if (isset($_POST['account'])) {
    $zalopay = new Zalopay($soicoder);
    $loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '" . $account . "' LIMIT 1 ", 1);
    if (isset($loadDATA['phone'])) {
        $check_full = $zalopay->LoadData($loadDATA)->History_full_web($limit);
        // print_r($check_full);
        if (isset($check_full['error'])) {
            echo "<script language='javascript'>alert('Mã Giao Dịch Không Xác Định');window.location='/".config_admin."/check_history';</script>";
            die;
        } else {
            $_SESSION['check_history'] = $check_full;
            echo "<script language='javascript'>window.location='/".config_admin."/check_history';</script>";
            die;
        }
    } else {
        echo "<script language='javascript'>alert('SĐT Không Tồn Tại Trên Hệ Thống');window.location='/".config_admin."/check_history';</script>";
        die;
    }
} else {
    echo "<script language='javascript'>alert('Vui Lòng Nhập SĐT');window.location='/".config_admin."/check_history';</script>";
    die;
}
?>