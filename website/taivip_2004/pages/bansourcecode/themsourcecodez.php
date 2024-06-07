<?php
require_once __DIR__."/../../include/core/database.php";
require_once __DIR__."/../../include/theme/head.php";
require_once __DIR__."/../../include/theme/header.php";



?>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">




    <div class="row">
      <div class="col-md-3"></div>

      <div class="col-md-6 grid-margin stretch-card py-4">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Thêm source code</h4>
            <p class="card-description"> Thêm source code cho code</p>
            <form class="forms-sample" action method="POST">

              <div class="form-group">
                <label for="exampleFormControlSelect1">Chọn danh mục</label>
                <select class="form-control" id="exampleFormControlSelect1" name="danhmuc">
                   <option value="">Chọn danh mục:</option>
                  <?php
                  $result = mysqli_query($connect, "SELECT * FROM danhmuc1");
                  while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['ten']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="exampleInputUsername1">Tên</label>
                <input type="text" name="ten" class="form-control mb-3" id="exampleInputUsername1" placeholder="Tên">
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Link Code</label>
                <input type="text" name="download" class="form-control mb-3" id="exampleInputUsername1" placeholder="Link Download">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Mô tả</label>
                <input type="text" name="mota" class="form-control mb-3" id="exampleInputEmail1" placeholder="Mô tả">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Thumbnail</label>
                <input type="text" name="thumbnail" class="form-control mb-3" id="exampleInputPassword1" placeholder="Thumbnail">
              </div>


              <div class="form-group">
                <label for="exampleInputPassword1">Giá</label>
                <input type="text" name="gia" class="form-control mb-3" id="exampleInputPassword1" placeholder="Giá">
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Demo</label>
                <input type="text" name="demo" class="form-control mb-3" id="exampleInputPassword1" placeholder="Link Demo">
              </div>


              <button type="submit" name="them" class="btn btn-primary mr-2">Thêm</button>
              

            </form>
          </div>
        </div>
      </div>

      <?php
      if(isset($_POST['them'])){
        echo '<meta http-equiv="refresh" content="1;url=">';

        if( !empty($_POST['danhmuc']) && !empty($_POST['ten']) && !empty($_POST['download']) && !empty($_POST['mota']) && !empty($_POST['thumbnail']) && !empty($_POST['gia']) && !empty($_POST['demo']) ){

          $danhmuc = $_POST['danhmuc'];
          $ten = $_POST['ten'];
          $download = $_POST['download'];
          $mota = $_POST['mota'];
          $thumbnail = $_POST['thumbnail'];
          $gia = $_POST['gia'];
          $demo = $_POST['demo'];


          mysqli_query($connect, "INSERT INTO `danhsachcode1` (`id`, `id_danhmuc`, `ten`, `download`, `mota`, `thumbnail`, `gia`, `demo`) VALUES (NULL, '$danhmuc', '$ten', '$download', '$mota', '$thumbnail', '$gia', '$demo')");
          $err = 'Thêm source code thành công!';
          echo '<script>swal("Thông báo", "'.$err.'", "success");</script>';

        } else {
          $err = 'Vui lòng nhập đầy đủ thông tin!';
          echo '<script>swal("Thông báo", "'.$err.'", "error");</script>';
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