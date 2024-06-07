<title>Nạp Thẻ</title>
<div class="container"><div class="bg-light py-5 rounded">
	<div class="row">
		<div class="bg-menu py-4 rounded mb-5">

	<div class="text-left container-fluid">

		<center>
		<h3 class="text-dark">Nạp Thẻ</h3>
</div>

<hr class="fix-hr rounded-pill"><div class="py-2"></div><div class="row">	
		<div class="col-12 col-md-4 mb-5">
			<div class="container">

		

		
						<form action method="POST">
							

							<select class="form-control mb-3" name="loaithe">
								<option value="">-- Chọn loại thẻ --</option>
								<option value="VIETTEL">Viettel</option>
								<option value="MOBIFONE">Mobifone</option>
								<option value="VINAPHONE">Vinaphone</option>
								<option value="VNMOBI">Vietnammobi</option>
								<option value="GATE">Gate</option>
								<option value="ZING">Zing</option>
							</select>
							<select class="form-control mb-3" name="menhgia">
								<option value="">-- Chọn mệnh giá --</option>
								<option value="10000">10,000đ</option>
								<option value="20000">20,000đ</option>
								<option value="30000">30,000đ</option>
								<option value="50000">50,000đ</option>
								<option value="100000">100,000đ</option>
								<option value="200000">200,000đ</option>
								<option value="300000">300,000đ</option>
								<option value="500000">500,000đ</option>
								<option value="1000000">1,000,000đ</option>
							</select>

							<input type="number" name="seri" class="form-control mb-3" placeholder="Nhập seri">

							<input type="number" name="mathe" class="form-control mb-3" placeholder="Nhập mã thẻ">

							<button type="submit" name="napthe_submit" class="btn btn-info" style="width: 100%">Nạp thẻ</button>
						</form>
					</div>
				</div>
				<div class="col-12 col-md-8 mb-5">
					<div class="container">
						<div class="table-responsive">
							<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"> 
    <table id="myTable" >
								<thead>
									<tr>
							<th class="text-dark" scope="col">ID</th>             
							<th class="text-dark" scope="col">Loại thẻ</th>
							<th class="text-dark" scope="col">Mệnh giá</th>	
							<th class="text-dark" scope="col">Serial</th>							
							<th class="text-dark" scope="col"> Time</th>
							<th class="text-dark" scope="col">Trang thái</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$stt = 0;

						$result = mysqli_query($connect, "SELECT * FROM napthe WHERE uid = '".$user['id']."' ORDER BY id DESC");
						while($row = mysqli_fetch_assoc($result)){
							$stt++;
							?>
							<tr>
								<td class="text" ><?php echo $stt; ?></td>                      
								<td class="text">
									<?php echo $row['loaithe']; ?>
								</td>
								<td class="text"><?php echo number_format($row['menhgia']); ?>đ</td>      
								<td class="text"> <?php echo $row['serial']; ?></td>      
								<td class="text"><?php echo $row['time']; ?></td>
								<td class="text"><?php echo check_trangthai($row['trangthai']); ?></td>                              
							</tr>
							<?php
						}
						?>





					</tbody>
				</table>



			</div>
		</div>

	</div>
</div>
<div class="py-4"></div>