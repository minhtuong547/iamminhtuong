<title>Mua Tên Miền Giá Rẻ</title>

</div><div class="container">
    <div class="bg-light py-5 rounded">
        <form action method="POST">
        <div class="row">
            <div class="col-12 col-md-4 mb-5">
                <div class="container">
                <label class="mb-2">Nhập tên miền:</label><div><input name="ten" class="form-control rounded-pill mb-3" placeholder="Nhập tên miền" value="">
                <label class="mb-2">Chọn loại miền:</label><select class="form-control rounded-pill mb-3" name="mien"><option value="0">Chọn loại miền</option>
                <option value=".com">.com (30000 VNĐ)</option>
                <option value=".net">.net (30000 VNĐ)</option>
                <option value=".org">.org (30000 VNĐ)</option>
                </select>
                <label class="mb-2">Chọn hạn sử dụng:</label>
                <select class="form-control rounded-pill mb-3" name="hsd" id="thanhtoan"><option value="0">Chọn hạn sử dụng:</option>
                <option value="1">1 năm (30K)</option>
                <option value="2">2 năm (60K)</option>
                <option value="3">3 năm (90K)</option>
                <option value="4">4 năm (120K)</option>
                <option value="5">5 năm (150K)</option>
                </select><label class="mb-2">Nameserver (Viết sai lập tức inbox admin để hỗ trợ):</label>
                
                <input name="ns1" class="form-control mb-3" placeholder="Nhập nameserver 1 (Hoặc Ip Host)" value="">
                
                <input name="ns2" class="form-control mb-3" placeholder="Nhập nameserver 2 (Hoặc Ip Host)" value="">
                </div><button type="submit" name="muamien_submit" class="btn btn-danger w-100pt rounded-pill py-2">Mua ngay -  <span id="tongtiensx"></span>đ</button>
                </form></div></div>
                <?php
                $giathunhat = 30000;
                ?>
                <script>
                        setInterval(function(){

                            var list = {
                                '0': 0,
                                '1': "30,000",
                                '2': "60,000",
                                '3': "90,000",
                                '4': "120,000",
                                '5' : "150,000",
                            }

                            var thanhtoan = $("#thanhtoan").val();
                            let tongtien = list[thanhtoan];

                            $("#tongtiensx").html(tongtien);
                        }, 10);
                    </script>







                  <div class="col-12 col-md-8 mb-5">
                            <div class="container">
                                <b>Lịch Sử Mua Tên Miền</b>
                                <button type="button" class="btn btn-outline-danger w-50pt" data-toggle="modal" data-target="#exampleModal">Chú ý</button>
                                <div class="table-responsive">
                                    <table class="table table-striped rounded table-hover table-bordered">
                                        <thead>
                                            <tr>
                                               <th scope="col">ID</th>
                                                <th scope="col">Tên Miền</th>
                                                <th scope="col">Loại</th>
                                                <th scope="col">Thời Hạn</th>
                                                <th scope="col">Nameserver 1</th>
                                                <th scope="col">Nameserver 2</th>
                                                <th scope="col">Trạng Thái</th>
                                                </thead>
                                                <tbody>
                                                </tr>
                                        </thead>
                                        <tbody>
                                             <?php
    $query = mysqli_query($connect, "SELECT * FROM muamien WHERE uid = '".$user['id']."' ORDER BY id DESC");
    while($row = mysqli_fetch_assoc($query)){
        ?>
         <tr>
          <th scope="row"><?php echo $row['id']; ?></th>
          
          <td><?php echo $row['ten']; ?><?php echo $row['mien']; ?></td>
          <td><?php echo $row['mien']; ?></td>
           <td><?php echo date('d/m/Y - H:i:s', $row['hsd'] + (2592000 * $row['thanhtoan']) ); ?></td>
          <td><?php echo $row['ns1']; ?></td>
           <td><?php echo $row['ns2']; ?></td>
          
          <td>
            <?php
            echo trangthai_mien($row['trangthai']);
            ?>                
           </td>
          
      </tr>
      <?php
  }
  ?>
                                        </tbody>
                                 
                                    </tbody>
                                    </table>
                                                </div>
                                                </div></div></div></div></div></div></div></div></div>
                                                
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="xacnhanorder" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="xacnhanorder">CHÚ Ý KHI MUA TÊN MIỀN</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
TÊN MIỀN QUỐC TẾ GIÁ RẺ - KHÔNG FULL QUẢN LÝ - QUẢN LÝ QUA CLOUDFLARE
<br>
Cập Nhật 25/06/2021
<br>
Các tên miền .com , net , pro , org , info ... không full cp, có thể gia hạn được, quản lý dns trung gian qua Cloudflare
<br>
Hãy điền đúng NS 1 và NS 2 để thực hiện mua miền giá rẻ với chỉ 45K
</div>
<div class="modal-footer">
<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
</div>
</div>
</div>