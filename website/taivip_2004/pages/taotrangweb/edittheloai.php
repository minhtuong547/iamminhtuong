<?php
require_once __DIR__."/../../include/core/database.php";
require_once __DIR__."/../../include/theme/head.php";
require_once __DIR__."/../../include/theme/header.php";

if(isset($_GET['xoa'])){
  $id_get = $_GET['xoa'];
 echo '<meta http-equiv="refresh" content="1;url=/taivip_2004/pages/taotrangweb/edittheloai.php">';
 mysqli_query($connect, "DELETE FROM danhmuc WHERE id='$id_get';");
 $err = 'Xóa danh mục thành công!';
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
            <h4 class="card-title">Edit danh mục</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>

                    <th> ID </th>
                    <th> Tên </th>
                    <th> Mô tả </th>
                    <th> Thumbnail </th>                     
                    <th> Chức năng </th>
                  </tr>
                </thead>
                <tbody>


                  <?php
                  $query = mysqli_query($connect, "SELECT * FROM danhmuc ORDER BY id DESC");
                  $dem = 0;
                  while($row = mysqli_fetch_assoc($query)){
                    $dem = $dem + 1;
                    ?>

                    <tr>


                      <td> <?php echo $row['id']; ?> </td>

                      <td> <?php echo $row['ten']; ?> </td>

                      <td> <?php echo $row['mota']; ?> </td>



                      <td> <img class="rounded" src="<?php echo $row['thumbnail']; ?>" style="width: 300px; height: 100px"> </td>

                      <td>

                        <a href="/taivip_2004/pages/taotrangweb/edittheloai2.php?id=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-success">Edit</button></a>
                        <a href="?xoa=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-danger">Xóa</button></a>


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