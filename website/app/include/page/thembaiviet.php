<title>Thêm Bài Viết</title>
<div class="container mb-5">
	<div class="bg-dark py-5 rounded">
		<div class="row">

<div class="bg-menu py-4 rounded mb-5">

	<div class="text-left container-fluid">

		<center>
		<h3 class="text-light">Thêm Bài Viết - <a href="/thong-tin-web"><button class="text-light btn btn-danger"><h4>Quay Lại</button></a></h3></h4>
</center>
</div>

<hr class="fix-hr rounded-pill">
<div class="py-2">
</div>
<div class="container mb-5"><div class="bg-main py-4 rounded container">
	<div class="row">

		<div class="col-12 col-md-6 mb-3 border-right border-dark">	
<form action method="POST">
					<label class="text-danger text-bold">Bài Viết:</label><input name="baiviet" class="form-control mb-4" placeholder="Bài Viết:" value="">
					<label class="text-danger text-bold">Nội Dung:</label><textarea rows="9" name="noidung" class="form-control mb-4" placeholder="Nội Dung:" value="" height: 200px"></textarea>
					
				
			</div>
		
		<div class="col-12 col-md-6 mb-3">
			<div class="text">
				<label class="text-danger text-bold">Người Đăng:</label><input name="nguoidang" class="form-control mb-4"  value="<?php echo $user['taikhoan']; ?>">
					<label class="text-danger text-bold">Link Ảnh:</label><input name="anh" class="form-control mb-4" placeholder="Link Ảnh:" value="">
					

						<div class="pỵ-5 mb-5"></div></div></div><button type="submit" name="them" class="btn btn-primary mr-2">Thêm</button></div></div></div>



              

              

            </form>
      