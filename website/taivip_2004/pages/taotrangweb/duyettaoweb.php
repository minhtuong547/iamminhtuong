<?php
require_once __DIR__."/../../include/core/database.php";
require_once __DIR__."/../../include/theme/head.php";
require_once __DIR__."/../../include/theme/header.php";

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
            <h4 class="card-title">Duyệt đơn tạo web</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>

                    <th> ID </th>
                    <th> Domain </th>
                    <th> Loại web </th>
                    <th> Ngày tạo </th>                     
                    <th> Thanh toán </th>
                    <th> Tài khoản AD </th>
                    <th> Mật khẩu AD </th>
                    <th> Trạng thái </th>
                    <th> Chức năng </th>
                  </tr>
                </thead>
                <tbody>


                  <?php
                  $query = mysqli_query($connect, "SELECT * FROM taoweb ORDER BY id DESC");
                  $dem = 0;
                  while($row = mysqli_fetch_assoc($query)){
                    $dem = $dem + 1;
                    ?>

                    <tr>


                      <td> <?php echo $row['id']; ?> </td>
                      <td> <?php echo $row['domain']; ?> </td>
                      <td> <a target="_bank" href="/tao-web/<?php echo $row['id_code']; ?>"><button class="btn btn-sm btn-info">XEM</button></a> </td>
                      <td> <?php echo $row['time2']; ?> </td>                        
                      <td> <?php echo $row['thanhtoan']; ?> Tháng </td>
                      <td> <?php echo $row['taikhoanadmin']; ?> </td>
                      <td> <?php echo $row['matkhauadmin']; ?> </td>
                      <td> <?php 

                      if( ( $row['time1'] + (2592000 * $row['thanhtoan']) ) >= time() ){
                       echo trangthai_taoweb($row['trangthai']); 
                     } else {
                      echo 'Hết hạn';
                    }

                    ?> </td>
                    <td>

                      <a href="?trangthai=true&id=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-success">Xong</button></a>
                      <a href="?trangthai=check&id=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-warning">Chờ</button></a>

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