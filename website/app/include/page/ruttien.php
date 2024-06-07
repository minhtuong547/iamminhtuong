
<title>Nạp Thẻ</title>
	<div class="row">
		<div class="bg-menu py-4 rounded mb-5">

	<div class="text-left container-fluid">

		<center>
		<h3 class="text-light">Rút Tiền</h3>
</div>

<hr class="fix-hr rounded-pill"><div class="py-2"></div><div class="row">	
		<div class="col-12 col-md-4 mb-5">
			<div class="container">

		

		
						<form action method="POST">
							

							<select class="form-control mb-3" name="thanhtoan">
								<option value="">-- Chọn Cổng Thanh Toán --</option>
								<option value="momo">MOMO</option>
								
							</select>
							
							

							<input type="number" name="sotaikhoan" class="form-control mb-3" placeholder="Nhập Số tài khoản">

							<input type="number" name="sotien" class="form-control mb-3" placeholder="Nhập số tiền">

							<button type="submit" name="ruttien" class="btn btn-info" style="width: 100%">Nạp thẻ</button>
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
							<th class="text-light" scope="col">ID</th>             
							<th class="text-light" scope="col">Uid</th>
							<th class="text-light" scope="col">Cổng thanh toán</th>	
							<th class="text-light" scope="col">SỐ tài khoản</th>							
							<th class="text-light" scope="col"> Số tiền</th>
                            <th class="text-light" scope="col">Thời gian</th>
							<th class="text-light" scope="col">Trang thái</th>
                            
						</tr>
					</thead>
					<tbody>
						<?php
						$stt = 0;

						$result = mysqli_query($connect, "SELECT * FROM ruttien WHERE uid = '".$user['id']."' ORDER BY id DESC");
						while($row = mysqli_fetch_assoc($result)){
							$stt++;
							?>
							<tr>
								<td class="text" ><?php echo $stt; ?></td>                      
								<td class="text">
									<?php echo $row['uid']; ?>
								</td>
								<td class="text"><?php echo ($row['thanhtoan']); ?></td>      
								<td class="text"> <?php echo $row['sotaikhoan']; ?></td>      
                                <td class="text"><?php echo $row['sotien']; ?></td>   
                                <td class="text"><?php echo $row['time']; ?></td> 
								<td class="text"><?php echo check_trangthairut($row['trangthai']); ?></td> 
                                                           
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





