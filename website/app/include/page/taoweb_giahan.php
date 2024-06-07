<style>
	body {
    background-color: #333333
    }
        </style>
<?php

$danhsach_giahan = [
	'taoweb' => 'taoweb'
];

if( isset($get_data[0]) && isset($get_data[1]) ){
	$loai = ansuzhi_format($get_data[0]);
	$id_giahan = (int)$get_data[1];

	if(!isset($danhsach_giahan[$loai])){
		header('location: /');
	} else {


		if($loai == 'taoweb'){
			if( mysqli_num_rows(mysqli_query($connect, "SELECT * FROM taoweb WHERE id = '$id_giahan' AND uid = '".$user['id']."' LIMIT 1")) < 1 ){
				header('location: /');
			} else {
				$info_donhang = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM taoweb WHERE id = '$id_giahan' AND uid = '".$user['id']."' LIMIT 1"));
				?>

				<div class="container py-5">
					<div class="row">

						<div class="col-12 col-md-6 mb-3">


							<form action method="POST">
								<h2 class="mb-3 text-uppercase font-weight-light text-warning text-center">Gia hạn web</h2>
								<select class="form-control mb-3" name="thanhtoan">
									<option value="">Gia hạn:</option>
									<option value="1">1 Tháng</option>
									<option value="2">3 Tháng</option>
									<option value="3">6 Tháng</option>
									<option value="4">12 Tháng</option>
									<option value="5">24 Tháng</option>
									<option value="6">36 Tháng</option>
								</select>
								<button type="submit" name="giahan" class="btn btn-warning mb-3" style="width: 100%">Gia hạn</button>
								
								<a href="/profile/lich-su-tao-web">
									<button type="button" class="btn btn-success mb-3" style="width: 100%">Trở về</button>
								</a>

							</form>

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

<?php
require_once __DIR__."/../../theme/footer.php";
?>