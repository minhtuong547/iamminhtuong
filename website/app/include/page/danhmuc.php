
<title>Tạo Web</title>
</div><div class="container mb-5"><div class="rounded bg-main py-5 container maindanhsach"><h2 class="text-center text-danger text-bold">MẪU WEB THIẾT KẾ</h2><hr class="bg-danger"><div class="row">
<hr class="fix-hr rounded-pill"></div><div class="py-2"><div class="row">		<?php
		$result = mysqli_query($connect, "SELECT * FROM danhsachcode ");
		while($row = mysqli_fetch_assoc($result)){
			?>
			

			<div class="col-12 col-md-3 mb-3">
				<div class="row">
					<div>
						<div class="rounded bg-light shadow-sm mb-3">
							<div class="">
								<img src="<?php echo $row['thumbnail']; ?>" class="border w-100pt rounded-top border-bottom mb-3 img-thumb"></div>
								<div class="text-center">
									<p class="text-uppercase text-bold d-inline-block text-truncate text-hidden"><?php echo $row['ten']; ?></p>
									<a href="/tao-web/<?php echo $row['id']; ?>">
										<button class="btn btn-danger w-100pt no-border btn-buy rounded-bottom">Xem Ngay</button>
									</a>
								</div>
							</div>
						</div>
					
					<div class="col-1 col-md-12"></div>
				</div>
			</div>
			<?php
		}
		?>			
	</div>
</div>

