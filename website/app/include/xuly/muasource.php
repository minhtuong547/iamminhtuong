<?php
				if(isset($_POST['tao'])){
					echo '<meta http-equiv="refresh" content="1;url=">';					

					if(isset($_SESSION['user'])){
						$giamgia = 0;

						if(isset($_POST['magiamgia'])){
							$magiamgia = $_POST['magiamgia'];
							$check_giam_gia = mysqli_query($connect, "SELECT * FROM magiamgia WHERE magiamgia = '$magiamgia' AND loai = 'muasourcecode' AND trangthai = 'true'");

							if(mysqli_num_rows($check_giam_gia) >= 1){
								$info_giamgia = mysqli_fetch_assoc($check_giam_gia);
								$giamgia = $info_giamgia['phantram_giamgia'];
							}

							$tienphaitra = $info_donhang['gia'] - ($info_donhang['gia'] / 100 * $giamgia);


							if($user['tien'] >= $tienphaitra){
								if(!empty($_POST['magiamgia'])){
									if(mysqli_num_rows($check_giam_gia) >= 1){
										if($info_giamgia['luotdung'] <= 1){
											mysqli_query($connect, "UPDATE magiamgia SET trangthai = 'false', luotdung = '0' WHERE id = '".$info_giamgia['id']."'");
										} else {
											mysqli_query($connect, "UPDATE magiamgia SET luotdung = luotdung - 1 WHERE id = '".$info_giamgia['id']."'");
										}

										mysqli_query($connect, "UPDATE user SET tien = tien - $tienphaitra WHERE id = '".$user['id']."'");
										mysqli_query($connect, "INSERT INTO `lichsu_muasourcecode` (`id`, `uid`, `id_code`, `time`) VALUES (NULL, '".$user['id']."', '$loai', '$time')");

										$err = 'Mua source thành công!';
										echo '<script>Swal.fire("Thông báo", "'.$err.'", "success");</script>';


									} else {								


										$err = 'Mã giảm giá không đúng!';
										echo '<script>Swal.fire("Thông báo", "'.$err.'", "error");</script>';


									}
								} else {
									mysqli_query($connect, "UPDATE user SET tien = tien - $tienphaitra WHERE id = '".$user['id']."'");
										mysqli_query($connect, "INSERT INTO `lichsu_muasourcecode` (`id`, `uid`, `id_code`, `time`) VALUES (NULL, '".$user['id']."', '$loai', '$time')");

										$err = 'Mua Code thành công!';
										echo '<script>Swal.fire("Thông báo", "'.$err.'", "success");</script>';
								}



							} else {
								$err = 'Bạn không đủ tiền!';
								echo '<script>Swal.fire("Thông báo", "'.$err.'", "error");</script>';
							}


						}




					} else {
						$err = 'Đăng nhập để tiếp tục!';
						echo '<script>Swal.fire("Thông báo", "'.$err.'", "error");</script>';
					}



				}
				?>