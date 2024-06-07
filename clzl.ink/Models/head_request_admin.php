<?php
// check web ảo
if ($_SERVER['SERVER_NAME'] !== URL) {
    setcookie('username', null, -1, '/');
    setcookie('token', null, -1, '/');
    echo json_encode(array(
        'status' => 'error',
        'message' => 'Server Không Hợp Lệ Vui Lòng Thử Lại'
    ));
    die;
} else if (empty($_COOKIE['username']) && empty($_COOKIE['token'])) {
    setcookie('username', null, -1, '/');
    setcookie('token', null, -1, '/');
    echo json_encode(array(
        'status' => 'error',
        'message' => 'Vui Lòng Đăng Nhập'
    ));
    die;
} else {
    $username = $_COOKIE['username'];
    $check_user = $soicoder->num_rows("SELECT * FROM `users` WHERE `username` = '$username'");
    if ($check_user == 1) {
        $data_user = $soicoder->fetch_assoc("SELECT * FROM `users` WHERE `username` = '$username'", 1);
        if (RELOGIN == 'ON' && $data_user['token'] !== $_COOKIE['token']) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Vui Lòng Đăng Nhập Lại'
            ));
            die;
        }
    } else {
        setcookie('username', null, -1, '/');
        setcookie('token', null, -1, '/');
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Tài Khoản Của Bạn Đã Bị Vô Hiệu Hóa'
        ));
        die;
    }
}