<?php

// check cookie
if ($_SERVER['SERVER_NAME'] !== URL) {
    setcookie('username', null, -1, '/');
    setcookie('token', null, -1, '/');
    echo '<script type="text/javascript">alert("Server Không Hợp Lệ Vui Lòng Thử Lại");setTimeout(function(){ location.href = "/login" },1000);</script>';
    die;
} else if (empty($_COOKIE['username']) && empty($_COOKIE['token'])) {
    setcookie('username', null, -1, '/');
    setcookie('token', null, -1, '/');
    echo "<script language='javascript'>window.location='/login';</script>";
    die;
} else {
    $username = $_COOKIE['username'];
    $check_user = $soicoder->num_rows("SELECT * FROM `users` WHERE `username` = '$username'");
    if ($check_user == 1) {
        $data_user = $soicoder->fetch_assoc("SELECT * FROM `users` WHERE `username` = '$username'", 1);
        if ($data_user['token'] !== $_COOKIE['token']) {
            echo '<script type="text/javascript">alert("Vui Lòng Đăng Nhập Lại");setTimeout(function(){ location.href = "/login" },1000);</script>';
            die;
        }
    } else {
        setcookie('username', null, -1, '/');
        setcookie('token', null, -1, '/');
        echo '<script type="text/javascript">alert("Tài Khoản Của Bạn Đã Bị Vô Hiệu Hóa");setTimeout(function(){ location.href = "/login" },1000);</script>';
        die;
    }
}