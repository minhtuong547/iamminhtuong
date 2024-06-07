<?php
require_once "include/core/database.php";
require_once "theme/head.php";
require_once "theme/header.php";

$id_get = (int)$_GET['id'];
$info = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM taoweb WHERE id = '$id_get'"));

$tong = $info['gia'];
$phantram = 50;
$phantramgia= ($tong*$phantram)/100;
if( !empty($_GET['trangthai']) && !empty($_GET['id'])  ){
    echo '<meta http-equiv="refresh" content="1;url=lichsuweb.php">';
    $trangthai = ansuzhi_format($_GET['trangthai']);
    $id = (int) ansuzhi_format($_GET['id']);
    
    
    if($trangthai == 'true'){
      $return_trangthai = 2;
    }
  
    if($trangthai == 'check'){
      $return_trangthai = 0;
    }
  
    mysqli_query($connect, "UPDATE taoweb SET trangthai = '$return_trangthai' WHERE id = '$id'");
    mysqli_query($connect, "UPDATE user SET tien = tien + '$phantramgia' WHERE id = '".$user['id']."' ");
    
  
  
    $err = 'Duyệt đơn thành công!';
    echo '<script>swal("Thông báo", "'.$err.'", "success");</script>';
  
  }
?>

 <div class="py-4"></div>
<div class="container">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"> 

    <div>
        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    
                    <th>LOẠI THEME</th>
                    <th>TÀI KHOẢN ADMIN</th>
                    <th>MẬT KHẨU ADMIN</th>
                    <th>DOMAIN</th>
                    <th>HSD</th>
                    <th>NGÀY MUA</th>
                    <th>CONTROL</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>
            <tbody>
            <?php
                  $query = mysqli_query($connect, "SELECT * FROM taoweb ");
                  
                  $dem = 0;
                  while($row = mysqli_fetch_assoc($query)){
                    $dem = $dem + 1;
                    ?>
            <tr>
                        <td><?php echo $row['id']; ?></td>
                      
                        <td>
                            <a target="_bank" href="/tao-web/<?php echo $row['id_code']; ?>"><button class="btn btn-info text-light" style="min-width: 200px">
                                ID THEME <?php echo $row['id_code']; ?>                            </button></a>
                        </td>
                        <td><?php echo $row['taikhoanadmin']; ?></td>
                        <td><?php echo $row['matkhauadmin']; ?></td>
                        <td><?php echo $row['domain']; ?></td>
                        <td><button class="btn btn-danger">
                        <?php echo $row['thanhtoan']; ?> Tháng                   </button></td>
                        <td><?php echo $row['time2']; ?></td>
                        <td>
                 <?php
                  if( ($row['trangthai'] == 0)){ ?>
                     <a href="?trangthai=true&id=<?php echo $row['id']; ?>"><button class="btn btn-success" style="width: 100%;" entabled>Hoàn thành</button>
                  <?php } else { ?>
                  <button class="btn btn-success" style="width: 100%;" disabled>Hoàn thành</button>
                  <?php
                }
                       ?>
                                                                </td>
                        <td>
                        <?php 

                  if( ( $row['time1'] + (2592000 * $row['thanhtoan']) ) >= time() ){
                      echo trangthai_taoweb($row['trangthai']); 
                        } else {
                    echo '<button class="text-light btn btn-danger">Hết hạn</button>';
                    }

                        ?>
                        </td>                                 
                    </tr>
                    <?php } ?>
           
         
<?php require_once "theme/footer.php"; ?>


