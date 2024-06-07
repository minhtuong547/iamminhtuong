<?php
if(isset($_POST['doimatkhau_submit'])){
	?>
	<meta http-equiv="refresh" content="1;url=">
	<?php
	$matkhau = ansuzhi_format($_POST['matkhau']);
	$newmatkhau = ansuzhi_format($_POST['newmatkhau']);
	$newmatkhau2 = ansuzhi_format($_POST['newmatkhau2']);


	$taikhoantam = $user['taikhoan'];
	$result = mysqli_query($connect, "SELECT * FROM user WHERE taikhoan = '$taikhoantam' AND matkhau = '$matkhau'");
	if(mysqli_num_rows($result) >= 1){
		if($newmatkhau == $newmatkhau2 ){
			$check = mysqli_query($connect, "UPDATE user SET matkhau = '$newmatkhau' WHERE taikhoan = '$taikhoantam'");
			if($check){
				echo '<script>Swal.fire("Thông báo", "Đổi mật khẩu thành công", "success");</script>';
				unset($_SESSION['user']);
				?>
				<meta http-equiv="refresh" content="1">
				<?php
			} else {
				echo '<script>Swal.fire("Thông báo", "Có lỗi xảy ra!", "error");</script>';
			}
		} else {
			echo '<script>Swal.fire("Thông báo", "Nhập lại mật khẩu mới không khớp!", "error");</script>';
		}
	} else {
		echo '<script>Swal.fire("Thông báo", "Mật khẩu củ không đúng", "error");</script>';
	}


}
?>