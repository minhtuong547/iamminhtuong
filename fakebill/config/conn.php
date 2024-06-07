<?php
$website_domain ="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$post_url = $_SERVER['REQUEST_URI'];
$domain = $_SERVER['HTTP_HOST'];
$hakibavuong = '';
function cache() { 
 return '?'.bin2hex(random_bytes(3));   
}
$changepages = basename($_SERVER['REQUEST_URI'], '.php');
$title = "Đinh Minh Tướng - Trang website fake bill chuyển khoản miễn phí";
$description = "Minh Tướng  - Trang chủ fake bill Vietinbank, Mbbank, Momo, vietcombank, v.v.v";
$keyword = "Minh Tướng , ,dinh minh tuong  , fakengahang , hethongdev , hethongdev.store , arraycyber, sieuthird.site , gachcard1s.online ,hethongdev , gachcard1s , trang fakebill ,vanduy, fakebill minh duy, fakebill ngân hàng, minh duy fakebill, minhduy, website fake bill";
$iconshortcut = "https://i.pinimg.com/564x/e3/09/8b/e3098b4d664deaf2878cc17fe8796b42.jpg";
$imgreviews = "https://i.pinimg.com/564x/e3/09/8b/e3098b4d664deaf2878cc17fe8796b42.jpg";
if ($changepages == 'fake-bill-vietinbank') {
    $title = "Fakebill - Ngân Hàng VietinBank";
    $description = "trongthao - Trang fake bill VietinBank chuyển khoản miễn phí";
    $imgreviews = "https://play-lh.googleusercontent.com/F8D0AbyMmiuwsTZYLaPsu_o40XGfQHgvRnq25lVSWupgHPpH3-TQ9soMrWwDJco3siI";
    $iconshortcut = "https://play-lh.googleusercontent.com/F8D0AbyMmiuwsTZYLaPsu_o40XGfQHgvRnq25lVSWupgHPpH3-TQ9soMrWwDJco3siI";
}elseif ($changepages == 'fake-bill-acb-bank') {
    $title = "Fakebill - Ngân Hàng ACB Bank";
    $description = "Fakebill - Trang fake bill ACB Bank chuyển khoản miễn phí";
    $imgreviews = "https://play-lh.googleusercontent.com/knIdLBzE-ngS8Fhim_0FxH56vWhXaQmuLcpMdAcoFY_790hd3t4_XQAlyEWUnYJRyWFP";
    $iconshortcut = "https://play-lh.googleusercontent.com/knIdLBzE-ngS8Fhim_0FxH56vWhXaQmuLcpMdAcoFY_790hd3t4_XQAlyEWUnYJRyWFP";
}elseif ($changepages == 'fake-bill-mbbank') {
    $title = "Fakebill - Ngân Hàng MBBank";
    $description = "trongthao - Trang fake bill MBBank chuyển khoản miễn phí";
    $imgreviews = "https://files.catbox.moe/fq9mki.png";
    $iconshortcut = "https://play-lh.googleusercontent.com/rBEfIxFhnCIq9p6eMdw-U1RhD5psINWr0_Rbx3Wvy3HMJpRRsnG6efhug5eyPlJc7u0";
}elseif ($changepages == 'fake-bill-techcombank') {
    $title = "Fakebill - Ngân Hàng Technetbank";
    $description = "trongthao - Trang fake bill Technetbank chuyển khoản miễn phí";
    $imgreviews = "https://play-lh.googleusercontent.com/Ddr3ZQEu6Vef9JV9ITALeyBEXvYwQWZ3kKJXxrdncD9JR0xlsO--J6zo7uGARfuTBmk";
    $iconshortcut = "https://play-lh.googleusercontent.com/Ddr3ZQEu6Vef9JV9ITALeyBEXvYwQWZ3kKJXxrdncD9JR0xlsO--J6zo7uGARfuTBmk";
}elseif ($changepages == 'fake-bill-vietcombank') {
    $title = "Fakebill - Ngân Hàng vietcombank";
    $description = "trongthao - Trang fake bill vietcombank chuyển khoản miễn phí";
    $imgreviews = "https://play-lh.googleusercontent.com/hRq2DVKkzBXQkyftxr0e2ytl0fS2hEWx3UTe3V652RfJVYWqVRGgBNhmZgqNzJ8PKHE";
    $iconshortcut = "https://play-lh.googleusercontent.com/hRq2DVKkzBXQkyftxr0e2ytl0fS2hEWx3UTe3V652RfJVYWqVRGgBNhmZgqNzJ8PKHE";
}elseif ($changepages == 'fake-sodu-mbbank') {
    $title = "Fakesodu - Ngân Hàng MB Bank";
    $description = "Fakesodu - Trang số dư MB Bank miễn phí";
    $imgreviews = "https://files.catbox.moe/fq9mki.png";
    $iconshortcut = "https://play-lh.googleusercontent.com/rBEfIxFhnCIq9p6eMdw-U1RhD5psINWr0_Rbx3Wvy3HMJpRRsnG6efhug5eyPlJc7u0";
}
elseif ($changepages == 'fake-sodu-techcombank') {
    $title = "Fakesodu - Ngân Hàng Techcombank";
    $description = "Fakesodu - Trang số dư Techcombank miễn phí";
    $imgreviews = "https://play-lh.googleusercontent.com/Ddr3ZQEu6Vef9JV9ITALeyBEXvYwQWZ3kKJXxrdncD9JR0xlsO--J6zo7uGARfuTBmk";
    $iconshortcut = "https://play-lh.googleusercontent.com/Ddr3ZQEu6Vef9JV9ITALeyBEXvYwQWZ3kKJXxrdncD9JR0xlsO--J6zo7uGARfuTBmk";
}
$daysOfWeek = [
    'Sunday' => 'Chủ Nhật',
    'Monday' => 'Thứ Hai',
    'Tuesday' => 'Thứ Ba',
    'Wednesday' => 'Thứ Tư',
    'Thursday' => 'Thứ Năm',
    'Friday' => 'Thứ Sáu',
    'Saturday' => 'Thứ Bảy'
];
$timestamp = time();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$now = date('H:i l d/m/Y', $timestamp);
$now = strtr($now, $daysOfWeek);
?>