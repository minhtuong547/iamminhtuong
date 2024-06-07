<?php
if (isset($_POST['ruttien'])) {
	
	
	



	if (empty($_POST['thanhtoan']) || empty($_POST['sotaikhoan']) || empty($_POST['sotien'])) {
		$err = 'Bạn cần nhập đầy đủ thông tin';
		echo '<script>Swal.fire("Thông Báo", "'.$err.'", "error");</script>';
	} else {
		$thanhtoan = $_POST['thanhtoan'];
		$sotaikhoan = $_POST['sotaikhoan'];
		$sotien = $_POST['sotien'];
		
		$tienht = $user['tien'];
		$check = mysqli_query($connect, "SELECT * FROM `ruttien` WHERE `thanhtoan` = '$thanhtoan' AND `sotaikhoan` = '$sotaikhoan'");
		$check = mysqli_num_rows($check);
        

		if ($thanhtoan == '' || $sotaikhoan == '' || $sotien == '') {
			$err = 'Bạn cần nhập đầy đủ thông tin';
			echo '<script>Swal.fire("Thông Báo", "'.$err.'", "error");</script>';
		
}

		if($sotien < 50000){
		    $err = 'Vui Lòng Nhập Số Tiền Trên 50,000 VNĐ';
		    echo '<script>Swal.fire("Thông Báo", "'.$err.'", "error");</script>';
		    
        
        }elseif ($tienht >= $sotien) {
		    
            mysqli_query($connect, "UPDATE user SET tien = tien - $sotien WHERE  id = '".$user['id']."' ");
            mysqli_query($connect, "INSERT INTO `ruttien` (`id`, `uid`, `thanhtoan`, `sotaikhoan`, `sotien`, `trangthai`, `time`) VALUES (NULL, '".$user['id']."', '$thanhtoan', '$sotaikhoan', '$sotien', '0', '$time')");
    
		    $err = 'Rút Tiền Thành Công';
				echo '<script>Swal.fire("Thông Báo", "'.$err.'", "success");</script>';
				
				
			}else{
                $err = 'Số tiền của bạn không đủ để rút';
                echo '<script>Swal.fire("Thông Báo", "'.$err.'", "error" );</script>';
            }
}
}



			
			?>