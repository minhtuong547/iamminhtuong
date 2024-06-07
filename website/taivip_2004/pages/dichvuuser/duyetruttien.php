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
  echo '<meta http-equiv="refresh" content="1;url=duyetruttien.php">';
  $trangthai = ansuzhi_format($_GET['trangthai']);
  $id = (int) ansuzhi_format($_GET['id']);

  if($trangthai == 'true'){
    $return_trangthai = 2;
    
  }

  mysqli_query($connect, "UPDATE ruttien SET trangthai = '$return_trangthai' WHERE id = '$id'");
  $err = 'Duyệt đơn thành công!';
  echo '<script>swal("Thông báo", "'.$err.'", "success");</script>';


  if($trangthai == 'check'){
    $return_trangthai = 1;
    
  }

  mysqli_query($connect, "UPDATE ruttien SET trangthai = '$return_trangthai' WHERE id = '$id'");

  $err = 'Hủy đơn thành công!';
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
            <h4 class="card-title">Đơn Rút</h4>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"> 

    <div>
        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                  <tr>

                    <th> ID </th>
                    <th> Uid </th>
                    <th> Thanh toán </th>
                    <th> Số tài khoản </th>                     
                    <th> Số tiền </th>
                    <th> Thời gian </th>
                    <th> Trạng thái </th>
                    <th> Control </th>
                   
                  </tr>
                </thead>
                <tbody>


                  <?php
                  $query = mysqli_query($connect, "SELECT * FROM ruttien ORDER BY id DESC");
                  
                  $dem = 0;
                  while($row = mysqli_fetch_assoc($query)){
                    $dem = $dem + 1;
                    ?>

                    <tr>


                      <td> <?php echo $row['id']; ?> </td>
                      <td> <?php echo $row['uid']; ?> </td>

                      <td> <?php echo $row['thanhtoan']; ?> </td>                        
                      <td> <?php echo ($row['sotaikhoan']); ?>đ </td>
                      <td> <?php echo number_format($row['sotien']); ?> </td>
                      <td> <?php echo $row['time']; ?> </td>
                      <td> <?php echo check_trangthairut($row['trangthai']); ?> </td>
                      <td>  <a href="?trangthai=true&id=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-success">Duyệt</button></a>
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