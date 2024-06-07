 
<title>Trang Cá Nhân</title>
  
<div class="container mb-5">
    <div class="bg-main rounded">
        <div class="cover">
            <img src="/images/cover.d81d7c7c.png" class="w-100pt"></div>
            <div class="text-center">
                <img src="<?php echo $user['avatar']; ?>" class="avatar rounded-circle img-thumbnail border shadow"></div>
                <h3 class="text-center text-bold upcase text-avatar mb-5">
                    <span class="text-uppercase">
    <?php echo $user['taikhoan']; ?> <br><br>
    <h5><a href="change-avatar"><font color="red"> Thay Đổi avatar</font></a></h5>

</h3>
    


<div class="py-3">
    <div class="row">
        <div class="col-12 col-md-12 mb-3">
            <div class="container">
                <a href="/profile/lich-su-tao-web">
                    <button class="btn btn-danger w-100pt mb-3">WEB ĐÃ THUÊ</button></a>
                        </div>
                        
                         <div class="row">
            <div class="col-12 col-md-12 mb-5">
                <div class="container">
                <label class="mb-2">Tài Khoản:</label><div><name="ten" class="form-control rounded-pill mb-3" placeholder=""><?php echo $user['taikhoan']; ?>
                        </div>
                        </div>
                        
                        <div class="row">
            <div class="col-12 col-md-12 mb-5">
                <div class="container">
                <label class="mb-2">Số Dư:</label><div><name="ten" class="form-control rounded-pill mb-3" placeholder=""><?php echo number_format($user['tien']); ?> 
                        </div>
                        </div>
                        
                         <div class="row">
            <div class="col-12 col-md-12 mb-5">
                <div class="container">
                <label class="mb-2">Loại Tài Khoản:</label><div><name="ten" class="form-control rounded-pill mb-3" placeholder=""><?php echo chucvu($user['chucvu']); ?>  
                        </div>
                        </div>
                         
                          <div class="row">
            <div class="col-12 col-md-12 mb-5">
                <div class="container">
                <label class="mb-2">Ngày Tham Gia:</label><div><name="ten" class="form-control rounded-pill mb-3" placeholder=""><?php echo $user['time']; ?> 
                        </div>
                        </div>
                        
                         <div class="row">
            <div class="col-12 col-md-12 mb-5">
                <div class="container">
                <label class="mb-2">Mật Khẩu:</label><div><name="ten" class="form-control rounded-pill mb-3" placeholder=""><a href="/profile/doi-mat-khau"><b><i class="text-danger">****** (Đổi mật khẩu)</a>  
                        </div>
                        </div>
                        
                                                     <div class="row">
            <div class="col-12 col-md-12 mb-5">
                <div class="container">
                <label class="mb-2">Email:</label><div><name="ten" class="form-control rounded-pill mb-3" placeholder=""> <a href="/them-email"><b><i class="text-danger"><?php echo $user['email'];?> (Đổi Ngay)</a>
                        </div>
                        </div>
                       
                       
                       
                        
                                                
                        </div>
                      </div>

                </div>   
    </div>
                        

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"> 
    <table id="myTable" class="table table-striped table-bordered">
        
                                <thead>
                                    <tr><h5>Hoạt Động Gần Đây</h5></tr>
                                    <tr>
                            <th class="text-dark" scope="col">ID</th>             
                            
                            <th class="text-dark" scope="col">Hoạt Động</th>    
                            <th class="text-dark" scope="col">Thời Gian</th>                          
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt = 0;

                        $result = mysqli_query($connect, "SELECT * FROM hoatdong WHERE taikhoan = '".$user['taikhoan']."' ORDER BY id DESC");
                        while($row = mysqli_fetch_assoc($result)){
                            $stt++;
                            ?>
                            <tr>
                                <td class="text" ><?php echo $stt; ?></td>                      
                                <td class="text"><button class="text-light btn btn-danger">
                                    <?php echo $row['hoatdong']; ?>
                                </button></td>
                                <td class="text"><?php echo ($row['time']); ?></td>      
                                
                            </tr>
                            <?php
                        }
                        ?>


</div>

</div>

</div>



</div>
<div class="py-3"></div>
<?php
require_once __DIR__."/../../theme/footer.php";
?>