<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
$path = $soicoder->real_escape_string(check_string($_POST['path']));
$username = $soicoder->real_escape_string(check_string($_POST['username']));
$password = $soicoder->real_escape_string(check_string($_POST['password']));
$check_user = $soicoder->xss_num_rows("SELECT * FROM `users` WHERE `username` = ? ", array($username));
if (empty($username) || empty($password)) {
    alert('Vui Lòng Nhập Đầy Đủ Thông Tin', '/'.config_admin.'/login', 1500);
    die;
} else if($check_user == 0) {
    alert('Tài Khoản Không Tồn Tại', '/'.config_admin.'/login', 1500);
    die;
} else if (empty($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], '/'.config_admin.'/') == false || strpos($_SERVER['HTTP_REFERER'], $path) == false) {
    alert('Hệ Thống Lỗi, Vui Lòng Thử Lại Sau', '/'.config_admin.'/login', 1500);
    die;
} else {
    $data_user = $soicoder->fetch_assoc("SELECT * FROM `users` WHERE `username` = '$username'", 1);
    if(encrypt($password, LICENSE, ENCRYT) === $data_user['password']) {
        $_SESSION['password'] = $password;
        $_SESSION['username'] = $username;
        $access_token = createToken();
        // get ip
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // update token
        $soicoder->update("users", array(
            'token' => $access_token,
            'time' => date('H:i:s d/m/Y')
        ), "`username` = '".$username."' ");
        // lưu log
        $soicoder->insert('log_admin' , array (
            'path' => $path,
            'ip' => $ip,
            'time' => time()
        ));
        // set cookie
        setcookie("username", $username, time() + 600000, "/"); // set cookie username
        setcookie("token", $access_token, time() + 600000, "/"); // set cookie token
        alert('Đăng Nhập Thành Công', '/'.config_admin.'/home', 1000);
        die;
    } else {
        alert('Mật Khẩu Không Chính Xác', '/'.config_admin.'/login', 1500);
        die;
    }
}
