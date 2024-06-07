
<title>Thông Tin Website</title>
<div class="container mb-5">
	<div class="bg-dark py-5 rounded">
		<div class="row">

<div class="bg-menu py-4 rounded mb-5">

	<div class="text-left container-fluid">

		<center>
		<h3 class="text-light">Thông Tin Về Website</h3> - <?php 

if ($user['chucvu'] == 9) {
	
	?>
	<a href="/them-bai-viet"><i><button class="text-light btn btn-danger">Thêm Bài Viết</button></i></a>	
<?php	
} elseif ($user['chucvu'] == 6) {
?>
	<a href="/them-bai-viet"><i><button class="text-light btn btn-danger">Thêm Bài Viết</button></i></a>
<?php
}else {
}

?>
	</center>
</div>

<hr class="fix-hr rounded-pill">
<div class="py-2">
</div>
	
<div class="row">

<?php
		$result = mysqli_query($connect, "SELECT * FROM baiviet ORDER BY id DESC ");
		while($row = mysqli_fetch_assoc($result)){
			?>			
<div class="col-8 col-md-8">
<center>
<div class="container">

<div class="py-4 rounded border text-light ">
<font class="text"><strong>Bài Viết:</strong> <?=$row['baiviet'];?> </font><br>
<font class="text"><strong>Người Đăng:</strong> <?=$row['nguoidang'];?> </font><br>
<font class="text">Nội Dung: <?=$row['noidung'];?> </font><br>
<font class="text">Ngày Đăng: <?=$row['time'];?> </font><br><br>

<center><img src="<?=$row['anh'];?>" style="width:100px;height:100px;"></center>


</div>
</a>
</div>
</div>
</div>
</div>
<?php } ?>




