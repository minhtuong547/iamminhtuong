<?php
require_once __DIR__."/../../../app/include/config/database.php";

if(isset($user['chucvu'])){
	if($user['chucvu'] != 9){
		header('location: /');
	}
} else {
	header('location: /');
}
?>