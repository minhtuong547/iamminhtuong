<?php
					if(isset($_POST['dangky'])){
						if( !empty($_POST['email']) && !empty($_POST['taikhoan']) && !empty($_POST['matkhau']) && !empty($_POST['matkhau2']) ){
						    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
        //your site secret key
        $secret = '6Le3S40cAAAAAPofrKAyR_7YWKHq5--EEAATMNC3';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success){
							$email = ansuzhi_format($_POST['email']);
							$taikhoan = ansuzhi_format($_POST['taikhoan']);
							$matkhau = ansuzhi_format($_POST['matkhau']);
							$matkhau2 = ansuzhi_format($_POST['matkhau2']);


								//kiểm tra tài khoản đã tồn tại chưa
							$kiemtra1 = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user WHERE email = '$email'"));
							if($kiemtra1 <= 0){

							$kiemtra = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user WHERE taikhoan = '$taikhoan'"));
							if($kiemtra <= 0){
							
									//nếu chưa tồn tại

								//kiểm tra pass khớp chưa
								if($matkhau == $matkhau2){
									//khớp rồi

									$save = mysqli_query($connect,
									"INSERT INTO `user` (`id`, `taikhoan`, `matkhau`, `tien`, `chucvu`, `email`, `time`, `avatar`) VALUES (NULL, '$taikhoan', '$matkhau', '500', '1', '$email', '$time', '/public/images/avatar.png')");
									$save= mysqli_query($connect,"INSERT INTO `hoatdong` (`id`, `taikhoan`, `hoatdong`, `time`) VALUES (Null, '$taikhoan', 'Đăng Ký Thành Công!', '$time')");
						    
										?>
										
										<script type="text/javascript">
											Swal.fire("Thông báo", "Đăng ký thành công!", "success");
										</script>
										<meta http-equiv="refresh" content="1;url=home">
										<?php
										$_SESSION['user'] = $taikhoan;

								 } else {
									//không khớp
									?>
									<script type="text/javascript">
										Swal.fire("Thông báo", "Mật khẩu bạn nhập không khớp nhau!", "error");
									</script>
									<meta http-equiv="refresh" content="1">
									<?php
								}

							} else {
									//nếu tồn tại rồi
								?>
								<script type="text/javascript">
									Swal.fire("Thông báo", "Tài khoản đã tồn tại!", "error");
								</script>
								<meta http-equiv="refresh" content="1">
							<?php
						}

							


								//echo $taikhoan;
						} else {
							?>
							<script type="text/javascript">
								Swal.fire("Thông báo", "Vui lòng nhập đầy đủ thông tin!", "error");
							</script>
							<meta http-equiv="refresh" content="1">
							<?php
						}
						}
						}
					}
					}
					?>