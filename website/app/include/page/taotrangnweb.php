<?php
require_once __DIR__."/../config/database.php";
require_once __DIR__."/../../theme/head.php";
require_once __DIR__."/../../theme/header.php";
?>
<div class="container mb-5">
	<div class="row">
		<?php
		$result = mysqli_query($connect, "SELECT * FROM danhmuc");
		while($row = mysqli_fetch_assoc($result)){
			?>
			<div class="col-12 col-md-3 mb-3">
				<div class="row">
					<div class="col-1 col-md-12"></div>
					<div class="col-10 col-md-12">
					<center>
						<div class="card" style="width: 100%;">
							<img src="<?php echo $row['thumbnail']; ?>" style="height: 150px" class="card-img-top" alt="<?php echo $row['ten']; ?>">
							<div class="card-body">
								<h5 class="card-title text-uppercase text-info">
									<?php echo $row['ten']; ?></h5>
									<p class="card-text">
										<?php echo $row['mota']; ?>
									</p>
									<a href="/danh-muc/<?php echo $row['id']; ?>">
										<button style="width: 100%" class="btn btn-light">
											Chi tiết
										</button>
									</a>
								</div>
							</div>
						</center>
					</div>
					<div class="col-1 col-md-12"></div>
				</div>
			</div>
			<?php
		}
		?>			
	</div>
</div>

<?php
require_once __DIR__."/../../theme/footer.php";
?>