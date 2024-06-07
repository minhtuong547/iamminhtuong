<?php
require_once __DIR__."/../../include/core/database.php";
require_once __DIR__."/../../include/theme/head.php";
require_once __DIR__."/../../include/theme/header.php";

if(isset($_POST['tao'])){
  echo '<meta http-equiv="refresh" content="1;url=">';
  if( !empty($_POST['loaima']) && ($_POST['soluong'] > 0) && ($_POST['lansudung'] > 0) && ($_POST['giamgia'] > 0) ){

    $loaima = $_POST['loaima'];
    $soluong = (int) $_POST['soluong'];
    $lansudung = (int) $_POST['lansudung'];
    $giamgia = (int) $_POST['giamgia'];


    for($i = 1; $i <= $soluong; $i++){
      $magiamgia = md5('1ufheqhf021y02y1u5423054h1200tb2310gb1g4013hg13g'.$time.time().$loaima.$soluong.$lansudung.$giamgia.rand(100000, 999999));

      mysqli_query($connect, "INSERT INTO `magiamgia` (`id`, `magiamgia`, `phantram_giamgia`, `loai`, `trangthai`, `luotdung`) VALUES (NULL, '$magiamgia', '$giamgia', '$loaima', 'true', '$lansudung')");
    }

    $err = 'Thêm mã giảm giá thành công!';
    echo '<script>swal("Thông báo", "'.$err.'", "success");</script>';

  } else {
    $err = 'Vui lòng nhập đầy đủ thông tin!';
    echo '<script>swal("Thông báo", "'.$err.'", "error");</script>';

  }
}

?>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">




    <div class="row">


      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Thêm gifcode</h4>
            <p class="card-description"> Thêm mã quà tặng, mã giảm giá </p>
            <form class="forms-sample" action method="POST">

              <div class="form-group">
                <label for="exampleFormControlSelect1">Loại mã</label>
                <select class="form-control" id="exampleFormControlSelect1" name="loaima">
                  <option>Chọn loại mã:</option>
                  <option value="taoweb">Mã giảm giá tạo web</option>
                  <option value="muasourcecode">Mã giảm giá mua source code</option>
                </select>
              </div>

              <div class="form-group">
                <label for="exampleInputUsername1">Nhập số lượng</label>
                <input type="text" class="form-control" id="exampleInputUsername1" name="soluong" placeholder="Nhập số lượng">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nhập số lần sử dụng</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="lansudung" placeholder="Nhập số lần sử dụng">
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">% giảm giá</label>
                <input type="text" class="form-control" id="exampleInputUsername1" name="giamgia" placeholder="Nhập % giảm giá">
              </div>

              <button type="submit" name="tao" class="btn btn-primary btn-lg" style="width: 100%; height: 50px">Tạo</button>
            </form>
          </div>
        </div>
      </div>


      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Danh sách gifcode</h4>
            <p class="card-description"> Danh sách tất cả mã gifcode </code>
            </p>
            <div class="table-responsive overflow-auto" style="height: 500px; overflow: scroll;">
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Mã giảm giá</th>
                    <th>% Giảm</th>
                    <th>Loại</th>
                    <th>Trạng thái</th>
                    <th>Lần sử dụng còn lại</th>
                  </tr>
                </thead>
                <tbody>



                  <?php
                  $result = mysqli_query($connect, "SELECT * FROM magiamgia ORDER BY id DESC");
                  while($row = mysqli_fetch_assoc($result)){
                    ?>

                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['magiamgia']; ?></td>
                      <td><?php echo $row['phantram_giamgia']; ?>%</td>
                      <td><?php echo $row['loai']; ?></td>
                      <td><?php echo $row['trangthai']; ?></td>
                      <td><?php echo $row['luotdung']; ?> Lần</td>                    
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



    </div>




  </div>




</div>



</div>
</div>




<?php
require_once __DIR__."/../../include/theme/footer.php";
?>