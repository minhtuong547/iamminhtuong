
<title>Tạo Trang Website</title>

<div class="container mb-5"><div class="bg-main py-4 rounded container">
	<div class="row">

		<div class="col-12 col-md-7 mb-3 border-right border-dark">

				<form action method="POST">
					<label class="text-danger text-bold">Tài khoản Admin:</label><input name="taikhoan" class="form-control mb-4" placeholder="Nhập tài khoản Admin" value="">
					<label class="text-danger text-bold">Mật khẩu Admin:</label><input name="matkhau" class="form-control mb-4" placeholder="Nhập mật khẩu Admin" value="">
					<label class="text-danger text-bold">Tên miền:</label><input name="domain" class="form-control mb-4" placeholder="Nhập tên miền (domain.tk)" value="">
					

					<label class="text-danger text-bold">Thanh toán:</label><select name="thanhtoan" id="thanhtoan"onchange="thanhtoanUpdate()" class="form-control mb-4">
						<option value="0">Chọn tháng</option>
						<option value="1">1 Tháng/<?php echo number_format($giathunhat); ?> VNĐ</option>
						<option value="2">3 Tháng/<?php echo number_format($giathuhai); ?> VNĐ</option>
						<option value="3">6 Tháng/<?php echo number_format($giathuba); ?> VNĐ</option>
						<option value="4">12 Tháng/<?php echo number_format($giathubon); ?> VNĐ</option>
						
					</select>

					<label class="text-danger text-bold">Mã Giảm Giá:</label><input name="magiamgia" class="form-control mb-4" placeholder="Nhập mã giảm giá (nếu có)" value="">
					
					<button type="button" class="btn btn-danger w-100pt" data-toggle="modal" data-target="#exampleModal">Tạo Ngay - <span id="tongtiensx"></span>đ</button>

					<script>
						setInterval(function(){

							var list = {
								'0': 0,
								'1': "<?=number_format($giathunhat) ?>",
								'2': "<?=number_format($giathuhai) ?>",
								'3': "<?=number_format($giathuba) ?>",
								'4': "<?=number_format($giathubon) ?>",
							}

							var thanhtoan = $("#thanhtoan").val();
							let tongtien = list[thanhtoan];

							$("#tongtiensx").html(tongtien);
						}, 10);
					</script>

					<!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="xacnhanorder" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="xacnhanorder">XÁC NHẬN GIAO DỊCH</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
               Bạn Có Chắc Muốn Tạo Shop Này #<?php echo $info_donhang['id']; ?>?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">HỦY</button>
                  <button type="submit" name="tao" class="btn btn-primary">XÁC NHẬN</button>
                </div>
              </div>
            </div>
          </div>
    </form>

				


				



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
						<div class="alert alert-primary" role="alert">
    LƯU Ý: Vui lòng nhập tên miền .tk .ml .ga .cf .gq
</div> 
    </button>
</div> 
						</ul>
						<div class="pỵ-5 mb-5"></div></div></div></div></div></div>
		
