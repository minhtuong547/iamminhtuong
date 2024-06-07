<?php
require_once __DIR__."/../config/database.php";
require_once __DIR__."/../../theme/head.php";
require_once __DIR__."/../../theme/header.php";



if( mysqli_num_rows(mysqli_query($connect, "SELECT * FROM danhmuc ")) < 1 ){
	header('location: /');
}
require_once __DIR__. "/../page/danhmuc.php";

require_once __DIR__. "/../../theme/footer.php";
?>