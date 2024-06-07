
<title>Mua SourceCode</title>
<div class="container mb-5"><div class="bg-main py-4 rounded container">
	<div class="row">

		<div class="col-12 col-md-7 mb-3 border-right border-dark">

				<form action method="POST">
					<label class="text-danger text-bold">Mã Giảm Giá:</label><input name="magiamgia" class="form-control mb-4" placeholder="Nhập mã giảm giá (nếu có)" value="">
					
					<input type="hidden" name="opt" value="muasourcecode">
					
					<button class="btn btn-danger w-100pt" name="tao" type="submit" style="width: 100%">Mua Ngay - <?php echo number_format($info_donhang['gia']); ?></button>

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
							<span class="text-primary text-bold">GIÁ TIỀN: </span><?php echo number_format($info_donhang['gia']).'VNĐ'; ?></li>
							<li><span class="text-primary text-bold">MÔ TẢ: </span><?php echo $info_donhang['mota']; ?></li>
						</ul>
						<div class="pỵ-5 mb-5"></div></div></div></div></div></div>
		

	</div>
</div>


