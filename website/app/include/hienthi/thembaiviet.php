<?php
require_once __DIR__."/../config/database.php";
require_once __DIR__."/../../theme/head.php";
require_once __DIR__."/../../theme/header.php";
	if($user['chucvu'] == 6){
}elseif($user['chucvu'] == 9){
 }else {
	header('location: /');
}
 require_once __DIR__. "/../page/thembaiviet.php";
 require_once __DIR__. '/../xuly/thembaiviet.php';
 require_once __DIR__. "/../../theme/footer.php";
 ?>