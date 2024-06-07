<?php
require_once __DIR__."/../config/database.php";
require_once __DIR__."/../../theme/head.php";
require_once __DIR__."/../../theme/header.php";

if(!isset($_SESSION['user'])){
    header('location: /');
}

?>

<title>Lịch sử tạo website</title>
<div class="container"><div class="bg-table rounded">
  <table class="table table-light table-striped rounded table-hover table-bordered">
  <thead>
    <tr>
          <th scope="col">ID</th>
          
          <th scope="col">Tài khoản Admin</th>
          <th scope="col">Mật khẩu Admin</th>
          <th scope="col">URL</th>
          <th scope="col">Ngày tạo</th>
          <th scope="col">HSD</th>
          <th scope="col">Trạng thái</th>
          <th scope="col">Gia hạn</th>
      </tr>
  </thead>
  <tbody>

    <?php
    $query = mysqli_query($connect, "SELECT * FROM taoweb WHERE uid = '".$user['id']."' ORDER BY id DESC");
    while($row = mysqli_fetch_assoc($query)){
        ?>
        <tr>
          <th scope="row"><?php echo $row['id']; ?></th>
          
          <td><?php echo $row['taikhoanadmin']; ?></td>
          <td><?php echo $row['matkhauadmin']; ?></td>
           <td><?php echo $row['domain']; ?></td>
          <td><?php echo $row['time2']; ?></td>
           <td><?php echo date('d/m/Y - H:i:s', $row['time1'] + (2592000 * $row['thanhtoan']) ); ?></td>
          
          <td>
            <?php
            if( ( $row['time1'] + (2592000 * $row['thanhtoan']) ) >= time() ){
                 echo trangthai_taoweb($row['trangthai']); 
            } else {
                echo 'Hết hạn';
            }
            ?>                
           </td>
          <td><a href="/gia-han/taoweb/<?php echo $row['id']; ?>"><button class="btn btn-sm btn-danger">Gia hạn</button></a></td>
      </tr>
      <?php
  }
  ?>

</tbody>
</table>

</div>

<?php
require_once __DIR__."/../../theme/footer.php";
?>