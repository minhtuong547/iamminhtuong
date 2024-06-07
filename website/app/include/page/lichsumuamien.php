<title>Lịch Sử Mua Tên Miền</title>
<div class="container"><div class="bg-table rounded">
                                    <table class="table table-striped rounded table-hover table-bordered">
                                        <thead>
                                            <tr>
                                               <th scope="col">ID</th>
                                                <th scope="col">Tên Miền</th>
                                                <th scope="col">Loại</th>
                                                <th scope="col">Thời Hạn</th>
                                                <th scope="col">Nameserver 1</th>
                                                <th scope="col">Nameserver 2</th>
                                                <th scope="col">Trạng Thái</th>
                                                </thead>
                                                <tbody>
                                                </tr>
                                        </thead>
                                        <tbody>
                                             <?php
    $query = mysqli_query($connect, "SELECT * FROM muamien WHERE uid = '".$user['id']."' ORDER BY id DESC");
    while($row = mysqli_fetch_assoc($query)){
        ?>
         <tr>
          <th scope="row"><?php echo $row['id']; ?></th>
          
          <td><?php echo $row['ten']; ?><?php echo $row['mien']; ?></td>
          <td><?php echo $row['mien']; ?></td>
           <td><?php echo date('d/m/Y - H:i:s', $row['hsd'] + (2592000 * $row['thanhtoan']) ); ?></td>
          <td><?php echo $row['ns1']; ?></td>
           <td><?php echo $row['ns2']; ?></td>
          
          <td>
            <?php
            echo trangthai_mien($row['trangthai']);
            ?>                
           </td>
          
      </tr>
      <?php
  }
  ?>
                                        </tbody>
                                 
                                    </tbody>
                                    </table>
                                                </div>
                                                <?php
require_once __DIR__."/../../theme/footer.php";
?>