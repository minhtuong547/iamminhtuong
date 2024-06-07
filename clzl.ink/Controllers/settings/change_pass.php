<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/head_request.php');
$oldpass = $soicoder->real_escape_string(check_string($_POST['oldpass']));
$password = $soicoder->real_escape_string(check_string($_POST['password']));
$newpassword = $soicoder->real_escape_string(check_string($_POST['newpassword']));
$username = $_COOKIE['username'];
$check_user = $soicoder->num_rows("SELECT * FROM `users` WHERE `username` = '$username'");
if (empty($oldpass) || empty($password) || empty($newpassword)) {
    alert('Vui Lòng Nhập Đầy Đủ Thông Tin', '/'.config_admin.'/list-account', 1500);
    die;
} else if ($password !== $newpassword) {
    echo '<script type="text/javascript">alert("Nhập Lại Mật Khẩu Không Đúng");setTimeout(function(){ location.href = "/'.config_admin.'/list-account" },1500);</script>';
    die;
} else if ($oldpass == $password) {
    echo '<script type="text/javascript">alert("Mật Khẩu Mới Không Được Trùng Với Mật Khẩu Cũ");setTimeout(function(){ location.href = "/'.config_admin.'/list-account" },1500);</script>';
    die;
} else {
    $data_user = $soicoder->fetch_assoc("SELECT * FROM `users` WHERE `username` = '$username'", 1);
    if ($oldpass !== decrypt($data_user['password'], LICENSE, ENCRYT)) {
        echo '<script type="text/javascript">alert("Mật Khẩu Cũ Không Chính Xác");setTimeout(function(){ location.href = "/'.config_admin.'/list-account" },1500);</script>';
        die;
    } else {
        $passenc = encrypt($password, LICENSE, ENCRYT);
        $soicoder->update("users", array(
            'password' => $passenc,
            'token' => createToken(),
            'time' => date('H:i:s d/m/Y')
        ), "`username` = '" . $username . "' ");
        reset_cookie();
        echo '<script type="text/javascript">alert("Đổi Mật Khẩu Thành Công, Vui Lòng Đăng Nhập Lại");setTimeout(function(){ location.href = "/'.config_admin.'" },1000);</script>';
        die;
    }
}