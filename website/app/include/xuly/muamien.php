<?php
if(isset($_POST['muamien_submit'])){
					$email = $user['email'];
					echo '<meta http-equiv="refresh" content="1;url=">';
					if(isset($_SESSION['user'])){
						
						if( !empty($_POST['ten']) && !empty($_POST['mien']) && !empty($_POST['hsd']) && !empty($_POST['ns1']) && !empty($_POST['ns2']) ){

							$thanhtoans = [
								'1' => 1,
								'2' => 2,
								'3' => 3,
								'4' => 4,
								'5' => 5,
								
							]
	} else {
		$ten = ansuzhi_format($_POST['ten']);
		$mien = ansuzhi_format($_POST['mien']);
		$hsd = ansuzhi_format($_POST['hsd']);
		$ns1 = ansuzhi_format($_POST['ns1']);
		$ns2 = ansuzhi_format($_POST['ns2']);
		$sotien = $user['tien'];
		$thanhtoan = $thanhtoans[$hsd];
		$tienphaitra = 30000 * $thanhtoan;
							

        

		if ($ten == '' || $mien == '' || $hsd == '' || $ns1 == '' || $ns2 == '') {
			$err = 'Bạn cần nhập đầy đủ thông tin';
			echo '<script>Swal.fire("Thông Báo", "'.$err.'", "error");</script>';
		
}

		if($sotien < 30000){
		    $err = 'Vui Lòng Nạp Tiền Để Mua Miền';
		    echo '<script>Swal.fire("Thông Báo", "'.$err.'", "error");</script>';
		    
        
        }else{
		    
            mysqli_query($connect, "UPDATE user SET tien = tien - $tienphaitra WHERE  id = '".$user['id']."' ");
            mysqli_query($connect, "INSERT INTO `muamien` (`id`, `uid`, `ten`, `mien`, `hsd`, `ns1`, `ns2`, `thanhtoan`, `time`, `trangthai`) VALUES (NULL, '".$user['id']."', '$ten', '$mien', '".time()."', '$ns1', '$ns2', '$thanhtoan', '$time', '0')");
    
		    $err = 'Mua Miền Thành Công';
				echo '<script>Swal.fire("Thông Báo", "'.$err.'", "success");</script>';
				
				
			
}
}


			
			?>