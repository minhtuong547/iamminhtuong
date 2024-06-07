<?php
?>
<?php
if (isset($_POST['napthe_submit'])) {
	?>
	<meta http-equiv="refresh" content="1;url=">
	<?php



	if (empty($_POST['loaithe']) || empty($_POST['seri']) || empty($_POST['mathe']) || empty($_POST['menhgia'])) {
		$err = 'Bạn cần nhập đầy đủ thông tin';
		echo '<script>swal.fire("Thông báo", "'.$err.'", "error");</script>';
	} else {
		$type = $_POST['loaithe'];
		$pin = $_POST['mathe'];
		$serial = $_POST['seri'];
		$amount = $_POST['menhgia'];
		$check = mysqli_query($connect, "SELECT * FROM `napthe` WHERE `mathe` = '$pin' AND `serial` = '$serial'");
		$check = mysqli_num_rows($check);

		if ($type == '' || $serial == '' || $pin == '' || $amount == '') {
			$err = 'Bạn cần nhập đầy đủ thông tin';
			echo '<script>swal.fire("Thông báo", "'.$err.'", "error");</script>';
		}elseif($check >= 1){
			$err = 'Thẻ đã tồn tại trên hệ thống';
			echo '<script>swal.fire("Thông báo", "'.$err.'", "error");</script>';
		} else {
			

			require_once(__DIR__.'/../config/napthe.php'); //gọi đến file config.php để chèn vào code.

			$dataPost = array();
			$dataPost['partner_id'] = $partner_id;
			$dataPost['request_id'] = rand(10000,99999);
			$dataPost['telco'] = $type;
			$dataPost['amount'] = $amount;
			$dataPost['serial'] = $serial;
			$dataPost['code'] = $pin;
			$dataPost['command'] = 'charging';
			$sign = creatSign($sign, $dataPost);
			$dataPost['sign'] = $sign;

			$dataPost = http_build_query($dataPost);



			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPost);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 500);
			$resultRaw = curl_exec($ch);
			curl_close($ch);
			$obj = json_decode($resultRaw);
			if($obj->status == 99){

				$err = $obj->message;
				echo '<script>swal.fire("Thông báo", "'.$err.'", "success");</script>';

				mysqli_query($connect, "INSERT INTO `napthe` SET
					`uid` = '".$user["id"]."',
					`serial` = '$serial',
					`mathe` = '$pin',
					`loaithe` = '$type',
					`menhgia` = '$amount',
					`trangthai` = '0',
					`time` = '$time'
					");

			} else {

				$err = $obj->message;
				echo '<script>swal.fire("Thông báo", "'.$err.'", "error");</script>';
			}





		}
	}

}
?>