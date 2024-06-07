<?php
require_once __DIR__."/../config/database.php";

require_once __DIR__."/../../theme/head.php";
require_once __DIR__."/../../theme/header.php";
require_once __DIR__."/../page/muadomain.php";

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
								
							];
	
		$ten = ansuzhi_format($_POST['ten']);
		$mien = ansuzhi_format($_POST['mien']);
		$hsd = ansuzhi_format($_POST['hsd']);
		$ns1 = ansuzhi_format($_POST['ns1']);
		$ns2 = ansuzhi_format($_POST['ns2']);
		
	
							

        
	if(isset($thanhtoans[$hsd])){
								$thanhtoan = $thanhtoans[$hsd];
								

								

								

									$tienphaitra = (30000 * $thanhtoan);


									if($user['tien'] >= $tienphaitra){
										




											  mysqli_query($connect, "UPDATE user SET tien = tien - $tienphaitra WHERE  id = '".$user['id']."' ");
            mysqli_query($connect, "INSERT INTO `muamien` (`id`, `uid`, `ten`, `mien`, `hsd`, `ns1`, `ns2`, `thanhtoan`, `time`, `trangthai`) VALUES (NULL, '".$user['id']."', '$ten', '$mien', '".time()."', '$ns1', '$ns2', '$thanhtoan', '$time', '0')");
											$save= mysqli_query($connect,"INSERT INTO `hoatdong` (`id`, `taikhoan`, `hoatdong`, `time`) VALUES (Null, '".$user['taikhoan']."', 'Tạo Web Thành Công: ".$domain."', '$time')");

												$err = 'Mua Miền Thành CÔng!';
												echo '<script>Swal.fire("Thông báo", "'.$err.'", "success");</script>';
												

									} else {
										$err = 'Bạn không đủ tiền!';
										echo '<script>Swal.fire("Thông báo", "'.$err.'", "error");</script>';
									}

							}


						} else {

							$err = 'Vui lòng nhập đầy đủ thông tin!';
							echo '<script>Swal.fire("Thông báo", "'.$err.'", "error");</script>';

						}

					} else {
						$err = 'Đăng nhập để tiếp tục!';
						echo '<script>Swal.fire("Thông báo", "'.$err.'", "error");</script>';
					}
				}

			
			
require_once __DIR__. "/../../theme/footer.php";

?>


