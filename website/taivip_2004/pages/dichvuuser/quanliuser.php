<?php
require_once __DIR__."/../../include/core/database.php";
require_once __DIR__."/../../include/theme/head.php";
require_once __DIR__."/../../include/theme/header.php";

if(isset($_GET['band'])){
  echo '<meta http-equiv="refresh" content="1;url=quanliuser.php">';
  $id = (int) ansuzhi_format($_GET['band']);



  mysqli_query($connect, "UPDATE user SET band = '1' WHERE id = '$id'");


  $err = 'Band thành viên thành công!';
  echo '<script>swal("Thông báo", "'.$err.'", "success");</script>';

}

if(isset($_GET['unband'])){
  echo '<meta http-equiv="refresh" content="1;url=quanliuser.php">';
  $id = (int) ansuzhi_format($_GET['unband']);



  mysqli_query($connect, "UPDATE user SET band = '0' WHERE id = '$id'");


  $err = 'Unband thành viên thành công!';
  echo '<script>swal("Thông báo", "'.$err.'", "success");</script>';

}



if( !empty($_GET['trangthai']) && !empty($_GET['id']) ){
  echo '<meta http-equiv="refresh" content="1;url=duyettaoweb.php">';
  $trangthai = ansuzhi_format($_GET['trangthai']);
  $id = (int) ansuzhi_format($_GET['id']);

  if($trangthai == 'true'){
    $return_trangthai = 2;
  }

  if($trangthai == 'check'){
    $return_trangthai = 0;
  }

  mysqli_query($connect, "UPDATE taoweb SET trangthai = '$return_trangthai' WHERE id = '$id'");


  $err = 'Duyệt đơn thành công!';
  echo '<script>swal("Thông báo", "'.$err.'", "success");</script>';

}

?>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">




    <div class="row">


      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Quản lí user</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>

                    <th> ID </th>
                    <th> Tài khoản </th>
                    <th> Mật khẩu </th>
                    <th> Tiền </th>                     
                    <th> Chức vụ </th>
                    <th> Ngày đăng ký </th>
                    <th> Band </th>
                    <th> Chức năng </th>
                  </tr>
                </thead>
                <tbody>


                  <?php
                  $query = mysqli_query($connect, "SELECT * FROM user ORDER BY id DESC");
                  $dem = 0;
                  while($row = mysqli_fetch_assoc($query)){
                    $dem = $dem + 1;
                    ?>

                    <tr>


                      <td> <?php echo $row['id']; ?> </td>
                      <td> <?php echo $row['taikhoan']; ?> </td>

                      <td> <?php echo $row['matkhau']; ?> </td>                        
                      <td> <?php echo number_format($row['tien']); ?>đ </td>
                      <td> <?php echo chucvu($row['chucvu']); ?> </td>
                      <td> <?php echo $row['time']; ?> </td>
                      <td> <?php echo $row['band']; ?> </td>

                      <td>

                        <a href="/taivip_2004/pages/dichvuuser/edituser.php?id=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-success">Chỉnh sữa</button></a>
                        <a href="?band=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-warning">Band</button></a>
                        <a href="?unband=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-warning">Unband</button></a>

                      </td>


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