<?php
require_once __DIR__."/../../include/core/database.php";
require_once __DIR__."/../../include/theme/head.php";
require_once __DIR__."/../../include/theme/header.php";

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
                    <th> ID Mua </th>
                    <th> ID Code </th>
                    <th> Time </th>                     


                  </tr>
                </thead>
                <tbody>


                  <?php
                  $query = mysqli_query($connect, "SELECT * FROM lichsu_muasourcecode ORDER BY id DESC");
                  $dem = 0;
                  while($row = mysqli_fetch_assoc($query)){
                    $dem = $dem + 1;
                    ?>

                    <tr>


                      <td> <?php echo $row['id']; ?> </td>
                      <td> <?php echo $row['uid']; ?> </td>
                      <td> <a target="_bank" href="/mua-source-dh/<?php echo $row['id_code']; ?>"><button class="btn btn-sm btn-info">XEM</button></a> </td>
                      <td> <?php echo $row['time']; ?> </td>
         


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