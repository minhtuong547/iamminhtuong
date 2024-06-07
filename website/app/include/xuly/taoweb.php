<?php
				if(isset($_POST['tao'])){
					$email = $user['email'];
					echo '<meta http-equiv="refresh" content="1;url=">';
					if(isset($_SESSION['user'])){
						
						if( !empty($_POST['taikhoan']) && !empty($_POST['matkhau']) && !empty($_POST['domain']) && !empty($_POST['thanhtoan']) ){

							$thanhtoans = [
								'1' => 1,
								'2' => 3,
								'3' => 6,
								'4' => 12,
								'5' => 24,
								'6' => 36,
							];

							$taikhoan = ansuzhi_format($_POST['taikhoan']);
							$matkhau = ansuzhi_format($_POST['matkhau']);
							$domain = ansuzhi_format($_POST['domain']);
							$tt = ansuzhi_format($_POST['thanhtoan']);
							

							



							if(isset($thanhtoans[$tt])){
								$thanhtoan = $thanhtoans[$tt];
								$giamgia = 0;

								if(isset($_POST['magiamgia'])){
									$magiamgia = $_POST['magiamgia'];
									$check_giam_gia = mysqli_query($connect, "SELECT * FROM magiamgia WHERE magiamgia = '$magiamgia' AND loai = 'taoweb' AND trangthai = 'true'");

									if(mysqli_num_rows($check_giam_gia) >= 1){
										$info_giamgia = mysqli_fetch_assoc($check_giam_gia);
										$giamgia = $info_giamgia['phantram_giamgia'];
									}

									$tienphaitra = ($info_donhang['gia'] * $thanhtoan) - ($info_donhang['gia'] * $thanhtoan / 100 * $giamgia);


									if($user['tien'] >= $tienphaitra){
										if(!empty($_POST['magiamgia'])){



											if(mysqli_num_rows($check_giam_gia) >= 1){
												if($info_giamgia['luotdung'] <= 1){
													mysqli_query($connect, "UPDATE magiamgia SET trangthai = 'false', luotdung = '0' WHERE id = '".$info_giamgia['id']."'");
												} else {
													mysqli_query($connect, "UPDATE magiamgia SET luotdung = luotdung - 1 WHERE id = '".$info_giamgia['id']."'");
												}

												mysqli_query($connect, "UPDATE user SET tien = tien - $tienphaitra WHERE id = '".$user['id']."'");
												mysqli_query($connect, "INSERT INTO `taoweb` (`id`, `uid`, `domain`, `id_code`, `time1`, `time2`, `thanhtoan`, `taikhoanadmin`, `matkhauadmin`, `trangthai`) VALUES (NULL, '".$user['id']."', '$domain', '$loai', '".time()."', '$time', '$thanhtoan', '$taikhoan', '$matkhau', '0')");

												$save= mysqli_query($connect,"INSERT INTO `hoatdong` (`id`, `taikhoan`, `hoatdong`, `time`) VALUES (Null, '".$user['taikhoan']."', 'Tạo Web Thành Công: ".$domain."', '$time')");

												$err = 'Thuê Shop thành công!';
												echo '<script>Swal.fire("Thông báo", "'.$err.'", "success");</script>';
												echo '<meta http-equiv="refresh" content="1;url=/profile/lich-su-tao-web">'; 
												try {
    // Địa chỉ nhận
    $mail->setFrom('tailocquy2004@gmail.com', 'Hỗ trợ trực tuyến');
    $mail->addAddress($email);     // Địa chỉ thư nhận
    $mail->addReplyTo('tailocquy2004@gmail.com', 'Hỗ trợ trực tuyến'); // Địa chỉ khách có thể phản hồi

    //Nội dung
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Bạn Vừa Tạo Shop Trên tailocquy2004.com';
    $mail->Body    = 'Bạn vừa tạo shop tại website tailocquy2004.com<br>
    Domain: '.$domain.' <br> 
    Tài Khoản: '.$taikhoan.' <br>
    Mật Khẩu:'.$matkhau.' <br>
    Giá: '.number_format($tienphaitra).'VNĐ ';
    $mail->AltBody = 'Bạn không thể trả lời thư này.';

    if(!$mail->send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
  
}
} catch (Exception $e) {
  
}

											} else {
												
												$err = 'Mã giảm giá không đúng!';
												echo '<script>Swal.fire("Thông báo", "'.$err.'", "error");</script>';
												
											}



										} else {

											mysqli_query($connect, "UPDATE user SET tien = tien - $tienphaitra WHERE id = '".$user['id']."'");
											mysqli_query($connect, "INSERT INTO `taoweb` (`id`, `uid`, `domain`, `id_code`, `time1`, `time2`, `thanhtoan`, `taikhoanadmin`, `matkhauadmin`, `trangthai`) VALUES (NULL, '".$user['id']."', '$domain', '$loai', '".time()."', '$time', '$thanhtoan', '$taikhoan', '$matkhau', '0')");

											$save= mysqli_query($connect,"INSERT INTO `hoatdong` (`id`, `taikhoan`, `hoatdong`, `time`) VALUES (Null, '".$user['taikhoan']."', 'Tạo Web Thành Công: ".$domain."', '$time')");

												$err = 'Thuê Shop thành công!';
												echo '<script>Swal.fire("Thông báo", "'.$err.'", "success");</script>';
												echo '<meta http-equiv="refresh" content="1;url=/profile/lich-su-tao-web">';  
												try {
    // Địa chỉ nhận
    $mail->setFrom('tailocquy2004@gmail.com', 'Hỗ trợ trực tuyến');
    $mail->addAddress($email);     // Địa chỉ thư nhận
    $mail->addReplyTo('tailocquy2004@gmail.com', 'Hỗ trợ trực tuyến'); // Địa chỉ khách có thể phản hồi

    //Nội dung
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Bạn Vừa Tạo Shop Trên tailocquy2004.com';
    $mail->Body    = 'Bạn vừa tạo shop tại website tailocquy2004.com<br>
    Domain: '.$domain.' <br> 
    Tài Khoản: '.$taikhoan.' <br>
    Mật Khẩu:'.$matkhau.' <br>
    Giá: '.number_format($tienphaitra).' VNĐ ';
    $mail->AltBody = 'Bạn không thể trả lời thư này.';

    if(!$mail->send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
  
}
} catch (Exception $e) {
  
}
}

									} else {
										$err = 'Bạn không đủ tiền!';
										echo '<script>Swal.fire("Thông báo", "'.$err.'", "error");</script>';
									}

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
				?>