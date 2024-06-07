<?php
if(isset($_POST['doimatkhau_submit'])){
	?>
	<meta http-equiv="refresh" content="1;url=">
	<?php
	$avatar = ansuzhi_format($_POST['avatar']);
	


	$taikhoantam = $user['taikhoan'];
	$result = mysqli_query($connect, "SELECT * FROM user WHERE taikhoan = '$taikhoantam' AND avatar = '$avatar'");
	
		
			$check = mysqli_query($connect, "UPDATE user SET avatar = '$avatar' WHERE taikhoan = '$taikhoantam'");
			if($check){
				echo '<script>Swal.fire("Thông báo", "Đổi avatar thành công", "success");</script>';
				
				?>
				<meta http-equiv="refresh" content="1">
				<?php
			} else {
				echo '<script>Swal.fire("Thông báo", "Có lỗi xảy ra!", "error");</script>';
			}
		



}
?>