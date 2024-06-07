<?php
require_once __DIR__."/../config/database.php";
require_once __DIR__."/../../theme/head.php";
require_once __DIR__."/../../theme/header.php";
$loai = (int)$get_data[0];


if( mysqli_num_rows(mysqli_query($connect, "SELECT * FROM danhsachcode WHERE id = '$loai'")) < 1 ){
	header('location: /');
}

$info_donhang = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM danhsachcode WHERE id = '$loai' LIMIT 1"));
$giathunhat = $info_donhang['gia'];
        $giathuhai = $info_donhang['gia'] * 3;
        $giathuba = $info_donhang['gia'] * 6;
        $giathubon = $info_donhang['gia'] * 12;
        $giathunam = $info_donhang['gia'] * 24;
        $giathusau = $info_donhang['gia'] * 36;
        

?>
<title>Tạo Trang Website</title>

<div class="container mb-5"><div class="bg-main py-4 rounded container">
	<div class="row">

		<div class="col-12 col-md-7 mb-3 border-right border-dark">

				<form action method="POST">
					<label class="text-danger text-bold">Tài khoản Admin:</label><input name="taikhoan" class="form-control mb-4" placeholder="Nhập tài khoản Admin" value="">
					<label class="text-danger text-bold">Mật khẩu Admin:</label><input name="matkhau" class="form-control mb-4" placeholder="Nhập mật khẩu Admin" value="">
					<label class="text-danger text-bold">Tên miền:</label><input name="domain" class="form-control mb-4" placeholder="Nhập tên miền (url website)" value="">
					

					<label class="text-danger text-bold">Thanh toán:</label><select name="thanhtoan" class="form-control mb-4">
						
						<option value="1">1 Tháng/<?php echo number_format($giathunhat); ?> VNĐ</option>
						<option value="2">3 Tháng/<?php echo number_format($giathuhai); ?> VNĐ</option>
						<option value="3">6 Tháng/<?php echo number_format($giathuba); ?> VNĐ</option>
						<option value="4">12 Tháng/<?php echo number_format($giathubon); ?> VNĐ</option>
						
					</select>

					<label class="text-danger text-bold">Mã Giảm Giá:</label><input name="magiamgia" class="form-control mb-4" placeholder="Nhập mã giảm giá (nếu có)" value="">
					
					<button class="btn btn-danger w-100pt" name="tao" type="submit" style="width: 100%">Tạo ngay</button>

				</form>


				<?php
				if(isset($_POST['tao'])){
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

												$err = 'Tạo website thành công!';
												echo '<script>swal("Thông báo", "'.$err.'", "success");</script>';

											} else {
												
												$err = 'Mã giảm giá không đúng!';
												echo '<script>swal("Thông báo", "'.$err.'", "error");</script>';
											}



										} else {

											mysqli_query($connect, "UPDATE user SET tien = tien - $tienphaitra WHERE id = '".$user['id']."'");
											mysqli_query($connect, "INSERT INTO `taoweb` (`id`, `uid`, `domain`, `id_code`, `time1`, `time2`, `thanhtoan`, `taikhoanadmin`, `matkhauadmin`, `trangthai`) VALUES (NULL, '".$user['id']."', '$domain', '$loai', '".time()."', '$time', '$thanhtoan', '$taikhoan', '$matkhau', '0')");

											$err = 'Tạo website thành công!';
											echo '<script>swal("Thông báo", "'.$err.'", "success");</script>';

										}

									} else {
										$err = 'Bạn không đủ tiền!';
										echo '<script>swal("Thông báo", "'.$err.'", "error");</script>';
									}

								}





							} 


						} else {

							$err = 'Vui lòng nhập đầy đủ thông tin!';
							echo '<script>swal("Thông báo", "'.$err.'", "error");</script>';

						}

					} else {
						$err = 'Đăng nhập để tiếp tục!';
						echo '<script>swal("Thông báo", "'.$err.'", "error");</script>';
					}
				}
				?>



			</div>
		
		<div class="col-12 col-md-5 mb-3">
			<div class="text-center">
				<div class="img-show-fix mb-3">
					<img src="<?php echo $info_donhang['thumbnail']; ?>" class="img-show rounded">
				</div><a href="<?php echo $info_donhang['demo']; ?>" target="_bank">
					<button class="btn btn-primary btn-buy text-light w-100pt">XEM DEMO</button>
				</a><hr></div><ul><li>
					<span class="text-primary text-bold">MÃ SỐ: </span> <?php echo $info_donhang['id']; ?></li>
					<li>
						<span class="text-primary text-bold">TÊN GIAO DIỆN: </span><?php echo $info_donhang['ten']; ?></li>
						<li>
							<span class="text-primary text-bold">GIÁ TIỀN: </span><?php echo number_format($info_donhang['gia']).'đ/1 Tháng'; ?></li>
							<li><span class="text-primary text-bold">MÔ TẢ: </span><?php echo $info_donhang['mota']; ?></li>
						</ul>
						<div class="pỵ-5 mb-5"></div></div></div></div></div></div>
				


<?php
require_once __DIR__."/../../theme/footer.php";
?>