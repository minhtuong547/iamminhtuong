<?php
require_once __DIR__."/../../include/core/database.php";
require_once __DIR__."/../../include/theme/head.php";
require_once __DIR__."/../../include/theme/header.php";

$id_get = (int)$_GET['id'];
$info = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM thongtin "));

?>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">




    <div class="row">
      <div class="col-md-3"></div>

      <div class="col-md-6 grid-margin stretch-card py-4">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Cài Đặt Chung</h4>
            <p class="card-description"> Chỉnh sửa Trang Web</p>
            <form class="forms-sample" action method="POST">

              <div class="form-group">
              <label for="exampleInputEmail1">Tiêu Đề Website</label>
              <input type="text" name="title" value="<?Php echo $info['title']; ?>" class="form-control mb-3" id="exampleInputEmail1" placeholder="title">
            </div>
            
             <div class="form-group">
              <label for="exampleInputEmail1">Nội Dung Wessite</label>
              <input type="text" name="noidung" value="<?Php echo $info['noidung']; ?>" class="form-control mb-3" id="exampleInputEmail1" placeholder="Nội Dung Web">
            </div>
              



            
            <div class="form-group">
              <label for="exampleInputEmail1">Tên Admin</label>
              <input type="text" name="admin" value="<?Php echo $info['admin']; ?>" class="form-control mb-3" id="exampleInputEmail1" placeholder="Tên Admin">
            </div>
            
            <div class="form-group">
              <label for="exampleInputEmail1">Số Điện Thoại</label>
              <input type="text" name="sdt" value="<?Php echo $info['sdt']; ?>" class="form-control mb-3" id="exampleInputEmail1" placeholder="sđt">
            </div>
            
            <div class="form-group">
              <label for="exampleInputPassword1">Logo Web:</label>
              <input type="text" name="logo" value="<?Php echo $info['logo']; ?>" class="form-control mb-3" id="exampleInputPassword1" placeholder="Logo Web">
            </div>
            <img src="<?Php echo $info['logo']; ?>" class="rounded border border-light mb-3" style="width: 100%; height: 200px">
           


            

            <div class="form-group">
              <label for="exampleInputUsername1">Facebook Admin</label>
              <input type="text" name="facebook" value="<?Php echo $info['facebook']; ?>" class="form-control mb-3" id="exampleInputUsername1" placeholder="Facebook Admin">
            </div>


            <div class="form-group">
              <label for="exampleInputUsername1">Zalo Admin</label>
              <input type="text" name="zalo" value="<?Php echo $info['zalo']; ?>" class="form-control mb-3" id="exampleInputUsername1" placeholder="Zalo Admin">
            </div>
              

              
               <div class="form-group">
              <label for="exampleInputUsername1">Ảnh Danh Mục 1</label>
              <input type="text" name="danhmuc1" value="<?Php echo $info['danhmuc1']; ?>" class="form-control mb-3" id="exampleInputUsername1" placeholder="Ảnh Danh Mục 1">
            </div>
            <img src="<?Php echo $info['danhmuc1']; ?>" class="rounded border border-light mb-3" style="width: 100%; height: 200px">
            <div class="form-group">
              <label for="exampleInputUsername1">Ảnh Danh Mục 2</label>
              <input type="text" name="danhmuc2" value="<?Php echo $info['danhmuc2']; ?>" class="form-control mb-3" id="exampleInputUsername1" placeholder="Ảnh Danh Mục 2">
            </div>
            <img src="<?Php echo $info['danhmuc2']; ?>" class="rounded border border-light mb-3" style="width: 100%; height: 200px">
            <div class="form-group">
              <label for="exampleInputUsername1">Ảnh Danh Mục 3</label>
              <input type="text" name="danhmuc3" value="<?Php echo $info['danhmuc3']; ?>" class="form-control mb-3" id="exampleInputUsername1" placeholder="Ảnh Danh Mục 3">
            </div>
            <img src="<?Php echo $info['danhmuc3']; ?>" class="rounded border border-light mb-3" style="width: 100%; height: 200px">

            <button type="submit" name="them" class="btn btn-primary mr-2">Lưu</button>

          </form>
        </div>
      </div>
    </div>

    <?php
    if(isset($_POST['them'])){


      if( !empty($_POST['title']) && !empty($_POST['noidung']) && !empty($_POST['admin']) && !empty($_POST['sdt']) && !empty($_POST['logo']) && !empty($_POST['facebook']) && !empty($_POST['zalo']) && !empty($_POST['danhmuc1']) && !empty($_POST['danhmuc2']) && !empty($_POST['danhmuc3'])){

          $title = $_POST['title'];
          $noidung = $_POST['noidung'];
          $admin = $_POST['admin'];
          $sdt = $_POST['sdt'];
          $logo = $_POST['logo'];
          $facebook = $_POST['facebook'];
          $zalo = $_POST['zalo'];
          $danhmuc1 = $_POST['danhmuc1'];
          $danhmuc2 = $_POST['danhmuc2'];
          $danhmuc3 = $_POST['danhmuc3'];
          


        mysqli_query($connect, "UPDATE thongtin SET title = '$title', noidung = '$noidung', admin = '$admin', sdt = '$sdt', logo = '$logo', facebook = '$facebook', zalo = '$zalo', danhmuc1 = '$danhmuc1', danhmuc2 = '$danhmuc2', danhmuc3 = '$danhmuc3' ");
        $err = 'Chỉnh sửa thành công!';
        echo '<script>swal("Thông Báo", "'.$err.'", "success");</script>';
        echo '<meta http-equiv="refresh" content="1;url=/taivip_2004/pages/setting/index.php">';

      } else {
        $err = 'Vui lòng nhập đầy đủ thông tin!';
        echo '<script>swal("Thông Báo", "'.$err.'", "error");</script>';
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