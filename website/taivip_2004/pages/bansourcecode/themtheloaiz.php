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
            <h4 class="card-title">Thêm thể loại</h4>
            <p class="card-description"> Thêm thể loại (Danh mục) cho code</p>
            <form class="forms-sample" action method="POST">
              <div class="form-group">
                <label for="exampleInputUsername1">Tên</label>
                <input type="text" name="ten" class="form-control mb-3" id="exampleInputUsername1" placeholder="Tên">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Mô tả</label>
                <input type="text" name="mota" class="form-control mb-3" id="exampleInputEmail1" placeholder="Mô tả">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Thumbnail</label>
                <input type="text" name="thumbnail" class="form-control mb-3" id="exampleInputPassword1" placeholder="Thumbnail">
              </div>


              <button type="submit" name="them" class="btn btn-primary mr-2">Thêm</button>
              

            </form>
          </div>
        </div>
      </div>

      <?php
      if(isset($_POST['them'])){
        echo '<meta http-equiv="refresh" content="1;url=">';

        if( !empty($_POST['ten']) && !empty($_POST['mota']) && !empty($_POST['thumbnail']) ){
          $ten = $_POST['ten'];
          $mota = $_POST['mota'];
          $thumbnail = $_POST['thumbnail'];


          mysqli_query($connect, "INSERT INTO `danhmuc1` (`id`, `ten`, `mota`, `thumbnail`) VALUES (NULL, '$ten', '$mota', '$thumbnail')");
          $err = 'Thêm danh mục source code thành công!';
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