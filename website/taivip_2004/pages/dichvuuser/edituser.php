<?php
require_once __DIR__."/../../include/core/database.php";
require_once __DIR__."/../../include/theme/head.php";
require_once __DIR__."/../../include/theme/header.php";

$id_get = (int)$_GET['id'];
$info = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM user WHERE id = '$id_get'"));

?>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">




    <div class="row">
      <div class="col-md-3"></div>

      <div class="col-md-6 grid-margin stretch-card py-4">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Edit user</h4>
            <p class="card-description"> Chỉnh sửa thông tin cho user</p>
            <form class="forms-sample" action method="POST">
              <div class="form-group">
                <label for="exampleInputUsername1">Tài khoản</label>
                <input type="text" name="taikhoan" value="<?Php echo $info['taikhoan']; ?>" class="form-control mb-3" id="exampleInputUsername1" placeholder="Tài khoản">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Mật khẩu</label>
                <input type="text" name="matkhau" value="<?Php echo $info['matkhau']; ?>" class="form-control mb-3" id="exampleInputEmail1" placeholder="Mật khẩu">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Tiền</label>
                <input type="text" name="tien" value="<?Php echo $info['tien']; ?>" class="form-control mb-3" id="exampleInputPassword1" placeholder="Tiền">
              </div>

              <div class="form-group">
                <label for="exampleFormControlSelect1">Chức vụ</label>
                <select class="form-control" id="exampleFormControlSelect1" name="chucvu">
                  <option value="<?Php echo $info['chucvu']; ?>"><?Php echo chucvu($info['chucvu']); ?></option>
                  <option value="1">Thành viên</option>
                  <option value="9">Admin</option>
                </select>
              </div>





              <button type="submit" name="save" class="btn btn-primary mr-2">Lưu</button>

            </form>
          </div>
        </div>
      </div>

      <?php
      if(isset($_POST['save'])){


        if( !empty($_POST['taikhoan']) && !empty($_POST['matkhau']) && $_POST['tien'] >= 0 && $_POST['chucvu'] >= 1 ){
          $taikhoan = $_POST['taikhoan'];
          $matkhau = $_POST['matkhau'];
          $tien = $_POST['tien'];
          $chucvu = $_POST['chucvu'];


          mysqli_query($connect, "UPDATE user SET taikhoan = '$taikhoan', matkhau = '$matkhau', tien = '$tien', chucvu = '$chucvu' WHERE id = '$id_get'");
          $err = 'Chỉnh sửa user thành công!';
          echo '<script>swal("Thông báo", "'.$err.'", "success");</script>';

          echo '<meta http-equiv="refresh" content="1;url=/taivip_2004/pages/dichvuuser/quanliuser.php">';
          
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