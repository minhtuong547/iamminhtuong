<?php
require(__DIR__."/../config/database.php");

require(__DIR__."/../config/napthe.php");
if(isset($_GET['status'])) {
	$code = $_GET['code'];
	$serial = $_GET['serial'];
	$thucnhan = $_GET['amount'];
	$tranid = $_GET['request_id'];
	$tien = $thucnhan / 100*70;
	
	$callback_sign = md5($sign.$_GET['code'].$_GET['serial']);
	if($_GET['callback_sign'] == $callback_sign) { 

		if ($_GET['status'] == 1) {

		    mysqli_query($connect, "UPDATE user SET tien = tien + $tien WHERE id = $tranid");

			mysqli_query($connect, "UPDATE `napthe` SET `trangthai` = 2 WHERE `mathe` = '".$code."'");
		} else {

			mysqli_query($connect, "UPDATE `napthe` SET `trangthai` = 1 WHERE `mathe` = '".$code."'");

		}


	}

}

?>