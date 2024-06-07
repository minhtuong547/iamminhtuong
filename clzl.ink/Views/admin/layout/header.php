<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php';
// check đường dẫn
if (strpos($_SERVER['REQUEST_URI'], '/'.config_admin.'/') !== 0 || strpos($_SERVER['REQUEST_URI'], '.php') !== false) {
    require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/404.php';
    die;
}
// check cookie
if (empty($_COOKIE['username']) && empty($_COOKIE['token'])) {
    reset_cookie();
    echo "<script language='javascript'>window.location='/".config_admin."/login';</script>";
    die;
} else {
    $username = $_COOKIE['username'];
    $check_user = $soicoder->num_rows("SELECT * FROM `users` WHERE `username` = '$username'");
    if ($check_user == 1) {
        $data_user = $soicoder->fetch_assoc("SELECT * FROM `users` WHERE `username` = '$username'", 1);
        if (RELOGIN == 'ON' && $data_user['token'] !== $_COOKIE['token']) {
            echo '<script type="text/javascript">alert("Vui Lòng Đăng Nhập Lại");setTimeout(function(){ location.href = "/'.config_admin.'/login" },1000);</script>';
            die;
        }
    } else {
        reset_cookie();
        echo '<script type="text/javascript">alert("Tài Khoản Của Bạn Đã Bị Vô Hiệu Hóa");setTimeout(function(){ location.href = "/'.config_admin.'/login" },1000);</script>';
        die;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Mini game giải trí chẵn lẻ zalopay uy tín và hệ thống thanh toán tự động trong 30s">
    <meta name="keywords" content="clzl, chanlezalopay 1k, chanlezalopay 5k, chanle, chan le zalopay, chẵn lẻ zalopay 1k, chanlezalopay, chẵn lẻ zalopay 5k, chẵn lẻ tài xỉu zalopay, tài xỉu zalopay, chẵn lẻ zalopay uy tín, chẵn lẻ zalopay, clmm 1k, chẵn lẻ zalopay 10k, web chẵn lẻ zalopay 1k, đánh chẵn lẻ zalopay, làm web chẵn lẻ zalopay, chan le zalopay, cltx zalopay, mimigame zalopay, chẵn lẻ zalopay, clm, chan le zalopay, clmm, clmmme, chẵn lẻ zalopay, chẵn lẻ uy tín, kiemzalopay, vanmaynet, kiemzalopaycom, chẵn lẻ tự động, chan le no hu, game chan le, chan le vi zalopay, zalopay tu dong">
    <meta property="og:description" content="Mini game giải trí chẵn lẻ zalopay uy tín và hệ thống thanh toán tự động trong 30s">
    <meta property="og:image" content="https://file.coin98.com/insights/Vi%CC%81-zalopay.jpg">
    <link rel="shortcut icon" href="/templates/img/logo.png" type="image/x-icon">
    <title>Quản Trị Hệ Thống - Hệ Thống Mini Game Chẳn Lẻ zalopay Uy Tín - Tự Động</title>
    <link rel="stylesheet" href="/templates/css/app.css">
    <link rel="stylesheet" href="/templates/plugins/notify/css/jquery.growl.css">
    <link rel="stylesheet" href="/templates/css/richtext.css">
    <link rel="stylesheet" href="/templates/plugins/select2/select2.min.css">
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="../../templates/js/vendors/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<style>
    @media (min-width: 991px) {
        .mainbar {
            height: 40px;
        }
    }
</style>
<div class="page">
    <div class="page-main">
        <style>
            .page {
                background: url(../../templates/img/bg-01.jpg);
            }
        </style>