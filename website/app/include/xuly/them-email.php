<?php
if(isset($_POST['doi'])){
	?>
	<meta http-equiv="refresh" content="1;url=">
	<?php
	$email = ansuzhi_format($_POST['email']);
	


	$taikhoantam = $user['taikhoan'];
	$result = mysqli_query($connect, "SELECT * FROM user WHERE taikhoan = '$taikhoantam' AND email = '$email'");
	
		
			$check = mysqli_query($connect, "UPDATE user SET email = '$email' WHERE taikhoan = '$taikhoantam'");
			if($check){
				echo '<script>Swal.fire("Thông báo", "Đổi email thành công", "success");</script>';
				
				?>
				<meta http-equiv="refresh" content="1">
				<?php
			} else {
				echo '<script>Swal.fire("Thông báo", "Có lỗi xảy ra!", "error");</script>';
			}
		



}
?>