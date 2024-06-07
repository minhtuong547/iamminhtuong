<?php
require_once __DIR__."/../config/database.php";
require_once __DIR__."/../../theme/head.php";
require_once __DIR__."/../../theme/header.php";
$loai = (int)$get_data[0];


if( mysqli_num_rows(mysqli_query($connect, "SELECT * FROM danhsachcode1 WHERE id = '$loai'")) < 1 ){
	header('location: /');
}

$info_donhang = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM danhsachcode1 WHERE id = '$loai' LIMIT 1"));

require_once __DIR__. "/../page/muasource.php";
require_once __DIR__. '/../xuly/muasource.php';
require_once __DIR__. '/../../theme/footer.php';
?>