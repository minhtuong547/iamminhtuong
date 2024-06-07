<?php
require_once __DIR__."/../../include/core/database.php";
require_once __DIR__."/../../include/theme/head.php";
require_once __DIR__."/../../include/theme/header.php";

if( !empty($_GET['trangthai']) && !empty($_GET['id']) ){
  echo '<meta http-equiv="refresh" content="1;url=duyetdonmien.php">';
  $trangthai = ansuzhi_format($_GET['trangthai']);
  $id = (int) ansuzhi_format($_GET['id']);

  if($trangthai == 'true'){
    $return_trangthai = 2;
  }

  if($trangthai == 'check'){
    $return_trangthai = 1;
  }

  mysqli_query($connect, "UPDATE muamien SET trangthai = '$return_trangthai' WHERE id = '$id'");


  $err = 'Duyệt Miền thành công!';
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
            <h4 class="card-title">Duyệt đơn tạo miền</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>

                    <th> ID </th>
                    <th> Domain </th>
                    <th> Namserver 1 </th>
                    <th> Namserver 1 </th>                     
                    <th> Time </th>
                    <th> Trạng Thái </th>
                    <th> Chức năng </th>
                  </tr>
                </thead>
                <tbody>


                  <?php
                  $query = mysqli_query($connect, "SELECT * FROM muamien ORDER BY id DESC");
                  $dem = 0;
                  while($row = mysqli_fetch_assoc($query)){
                    $dem = $dem + 1;
                    ?>

                    <tr>


                      <td> <?php echo $row['id']; ?> </td>
                      <td> <?php echo $row['ten']; ?><?php echo $row['mien']; ?> </td>
                      
                      <td> <?php echo $row['ns1']; ?> </td>                        
                      <td> <?php echo $row['ns2']; ?> </td>
                      <td> <?php echo $row['time']; ?> </td>
                      
                      <td> <?php 

                      
                       echo trangthai_mien($row['trangthai']); 
                     

                    ?> </td>
                    <td>

                      <a href="?trangthai=true&id=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-success">Thành Công</button></a>
                      <a href="?trangthai=check&id=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-warning">Không Thành Công</button></a>

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