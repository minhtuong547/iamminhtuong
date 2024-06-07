
							<?php
							if(isset($_POST['giahan'])){
								echo '<meta http-equiv="refresh" content="1;url=">';

								$thanhtoans = [
									'1' => 1,
									'2' => 3,
									'3' => 6,
									'4' => 12,
									'5' => 24,
									'6' => 36,
								];

								if( !empty($_POST['thanhtoan']) ){
									$tt = $_POST['thanhtoan'];
									$thanhtoan = $thanhtoans[$tt];

									if(isset($thanhtoans[$tt])){



										$info_code = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM danhsachcode WHERE id = '".$info_donhang['id_code']."' LIMIT 1"));

										$tienphaitra = $info_code['gia'] * $thanhtoan;

										if($user['tien'] >= $tienphaitra){											
											mysqli_query($connect, "UPDATE user SET tien = tien - $tienphaitra WHERE id = '".$user['id']."'");
											mysqli_query($connect, "UPDATE taoweb SET thanhtoan = thanhtoan  + $thanhtoan WHERE id = '$id_giahan'");
											mysqli_query($connect, "INSERT INTO `giahan_web` (`id`, `domain`, `giahan`, trangthai) VALUES (NULL, '".$info_donhang['domain']."', '".$thanhtoan."', 0)");

											$err = 'Tạo website thành công!';
											echo '<script>swal("Thông báo", "'.$err.'", "success");</script>';
										} else {
											$err = 'Bạn không đủ tiền!';
											echo '<script>swal("Thông báo", "'.$err.'", "error");</script>';
										}





									}

								} else {
									$err = 'Vui lòng nhập đầy đủ thông tin!';
									echo '<script>swal("Thông báo", "'.$err.'", "error");</script>';
								}

							}
							?>


						</div>



						<div class="col-12 col-md-6">
							

							<div class="container py-5 border border-info">
								<h2 class="mb-4 text-uppercase font-weight-light text-info text-center">Info Trang Web</h2>

								<center>

									<div style="width: 80%">
										
										<ul class="text-left text-uppercase text-info">
											<li>ID: <?php echo $info_donhang['id']; ?></li>
											<li>Domain: <?php echo $info_donhang['domain']; ?></li>
											<li>Loại code: <?php echo $info_donhang['id_code']; ?></li>
											<li>Ngày tạo: <?php echo $info_donhang['time2']; ?></li>
											<li>Ngày hết hạn: <?php echo date('d/m/Y - H:i:s', $info_donhang['time1'] + (2592000 * $info_donhang['thanhtoan']) ); ?></li>
											<li>Thanh toán: <?php echo $info_donhang['thanhtoan']; ?> Tháng</li>
											<li>Trạng thái: <?php
											if( ( $info_donhang['time1'] + (2592000 * $info_donhang['thanhtoan']) ) >= time() ){
												echo trangthai_taoweb($info_donhang['trangthai']); 
											} else {
												echo 'Hết hạn';
											} 
											?></li>
										</ul>

									</div>

								</center>

							</div>

						</div>



					</div>
				</div>



				<?php


			}
		}


	}

} else {
	header('location: /');
}
?>
