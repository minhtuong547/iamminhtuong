<?php

require_once __DIR__."/../config/database.php";
$id_api = '288'; // Lấy ID API tại nhà cung cấp dịch vụ
$api_key = '85b2930eea4ce589e7e6268741772126'; // Lấy API KEY tại nhà cung cấp dịch vụ
// vui lòng không để lộ api và link callback để bảo mật web



// vui lòng tự bọc hàm để bảo mật tránh bị tấn công XSS, SQL
$noidung = ansuzhi_format($_POST['noidung']);
$tien = ansuzhi_format($_POST['tien']);
$idapi = ansuzhi_format($_POST['idapi']);
$key = ansuzhi_format($_POST['api_key']);
$tranid =  ansuzhi_format($_POST['tranid']);

$check1 = md5($id_api.$api_key);
$check2 = md5($idapi.$key);
if($key != ''){
    if($check1 == $check2){
        // Thực hiện cộng tiền cho khách
        
   mysqli_query($connect, "UPDATE `user` SET `tien` = `tien` + '".$tien."' where `taikhoan`='".$noidung."'");
   mysqli_query($connect, "INSERT INTO `automomo` (`id`, `uid`, `sotien`, `time`) VALUES (NULL, '".$noidung."', '".$tien."', '".$time."')");
        
        
        
    }
}
?>

