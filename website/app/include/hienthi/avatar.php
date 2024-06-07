<?php
require_once __DIR__."/../config/database.php";
if(!isset($_SESSION['user'])){
	header('location: /');
}
require_once __DIR__."/../../theme/head.php";
require_once __DIR__."/../../theme/header.php";
require_once __DIR__."/../page/changeavatar.php";
require_once __DIR__.'/../xuly/avatar.php';
require_once __DIR__. "/../../theme/footer.php";
?>