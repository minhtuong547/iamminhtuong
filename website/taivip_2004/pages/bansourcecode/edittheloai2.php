<?php
require_once __DIR__."/../../include/core/database.php";
require_once __DIR__."/../../include/theme/head.php";
require_once __DIR__."/../../include/theme/header.php";

$id_get = (int)$_GET['id'];
$info = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM danhmuc1 WHERE id = '$id_get'"));

?>
<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">




		<div class="row">
			<div class="col-md-3"></div>

			<div class="col-md-6 grid-margin stretch-card py-4">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Edit Thể loại</h4>
						<p class="card-description"> Chỉnh sửa thể loại (Danh mục) cho code</p>
						<form class="forms-sample" action method="POST">
							<div class="form-group">
								<label for="exampleInputUsername1">Tên</label>
								<input type="text" name="ten" value="<?Php echo $info['ten']; ?>" class="form-control mb-3" id="exampleInputUsername1" placeholder="Tên">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Mô tả</label>
								<input type="text" name="mota" value="<?Php echo $info['mota']; ?>" class="form-control mb-3" id="exampleInputEmail1" placeholder="Mô tả">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Thumbnail</label>
								<input type="text" name="thumbnail" value="<?Php echo $info['thumbnail']; ?>" class="form-control mb-3" id="exampleInputPassword1" placeholder="Thumbnail">
							</div>

							<img src="<?Php echo $info['thumbnail']; ?>" class="rounded border border-light mb-3" style="width: 100%; height: 200px">


							<button type="submit" name="them" class="btn btn-primary mr-2">Lưu</button>

						</form>
					</div>
				</div>
			</div>

			<?php
			if(isset($_POST['them'])){
				

				if( !empty($_POST['ten']) && !empty($_POST['mota']) && !empty($_POST['thumbnail']) ){
					$ten = $_POST['ten'];
					$mota = $_POST['mota'];
					$thumbnail = $_POST['thumbnail'];


					mysqli_query($connect, "UPDATE danhmuc1 SET ten = '$ten', mota = '$mota', thumbnail = '$thumbnail' WHERE id = '$id_get'");
					$err = 'Chỉnh sửa danh mục thành công!';
					echo '<script>swal("Thông báo", "'.$err.'", "success");</script>';

					echo '<meta http-equiv="refresh" content="1;url=/taivip_2004/pages/bansourcecode/edittheloaiz.php">';
					
				} else {
					$err = 'Vui lòng nhập đầy đủ thông tin!';
					echo '<script>swal("Thông báo", "'.$err.'", "error");</script>';
					echo '<meta http-equiv="refresh" content="1;url=">';
				}

			}
			?>


			<div class="col-md-3"></div>


		</div>




	</div>




</div>



</div>
</div>




<?php
require_once __DIR__."/../../include/theme/footer.php";
?>