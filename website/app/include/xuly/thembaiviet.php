      <?php
if(isset($_POST['them'])){
	?>
	<meta http-equiv="refresh" content="1;url=">
	<?php
	if (empty($_POST['baiviet']) || empty($_POST['nguoidang']) || empty($_POST['noidung']) || empty($_POST['anh'])) {
				echo '<script>Swal.fire("Thông báo", "Vui Lòng Nhập Đầy Đủ Thông Tin!", "error");</script>';

	}else{
	$baiviet = ansuzhi_format($_POST['baiviet']);
	$nguoidang = ansuzhi_format($_POST['nguoidang']);
	$noidung = ansuzhi_format($_POST['noidung']);
	$anh = ansuzhi_format($_POST['anh']);
	


	$taikhoantam = $user['taikhoan'];
	
		
		
			$check = mysqli_query($connect, "INSERT INTO `baiviet` (`id`, `baiviet`, `nguoidang`, `noidung`, `anh`, `time`) VALUES (NULL, '$baiviet', '$nguoidang', '$noidung', '$anh', '$time')");

			if($check){
				echo '<script>Swal.fire("Thông báo", "Thêm Bài Viết Thành Công", "success");</script>';
				
				?>
				<meta http-equiv="refresh" content="1">
				<?php
			
			
			} else {
				echo '<script>Swal.fire("Thông báo", "Có lỗi xảy ra!", "error");</script>';
			}
		

}

}
?>