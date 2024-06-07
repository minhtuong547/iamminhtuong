<?php
session_start();
require_once __DIR__."/../core/function.php";

//config database
$server = 'localhost';
$user = 'ieulyntk_taoweb';
$pass = 'ieulyntk_taoweb';
$db = 'ieulyntk_taoweb';
$error = 'Máy chủ bảo trì...';

//tiến hành connect
$connect = mysqli_connect($server, $user, $pass, $db) or die($error);

//thiết lập database uft-8
mysqli_query($connect,"SET NAMES 'UTF8'");

//get thông tin user
if(isset($_SESSION['user'])){
	$user = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM user WHERE taikhoan = '".$_SESSION['user']."'"));
	
	if($user['band'] == 1){
		exit('Bạn đã bị band!');
	}
}

date_default_timezone_set('Asia/Ho_Chi_Minh');
$time = date('d/m/Y - H:i:s');


?>