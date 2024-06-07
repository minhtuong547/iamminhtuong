<?php
					if(isset($_POST['dangnhap'])){
						if( !empty($_POST['taikhoan']) && !empty($_POST['matkhau']) ){
							$taikhoan = ansuzhi_format($_POST['taikhoan']);
							$matkhau = ansuzhi_format($_POST['matkhau']);
							$kiemtra = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user WHERE taikhoan = '$taikhoan' AND matkhau = '$matkhau'"));
							if($kiemtra >= 1){
								$save= mysqli_query($connect,"INSERT INTO `hoatdong` (`id`, `taikhoan`, `hoatdong`, `time`) VALUES (Null, '$taikhoan', 'Đăng Nhập Thành Công!', '$time')");

									
										?>
								
								<script type="text/javascript">
									Swal.fire("Thông báo", "Đăng nhập thành công!", "success");
								</script>
								<meta http-equiv="refresh" content="1;url=/home">
								<?php
								$_SESSION['user'] = $taikhoan;
							} else {
								?>
								<script type="text/javascript">
									Swal.fire("Thông báo", "Sai tài khoản hoặc mật khẩu!", "error");
								</script>
								<meta http-equiv="refresh" content="1">
								<?php
							}
						} else {
							?>
							<script type="text/javascript">
								Swal.fire("Thông báo", "Vui lòng nhập đầy đủ thông tin!", "error");
							</script>
							<meta http-equiv="refresh" content="1">

							<?php
						}
					}
					?>