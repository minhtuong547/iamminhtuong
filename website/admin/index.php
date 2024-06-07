<?php
require_once "include/core/database.php";
require_once "theme/head.php";
require_once "theme/header.php";

$tonguser = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user"));
$tienthuduoctrongnam  = 0;
$tongtien = 0;
$tientaoweb = 0;
$tienmuasource = 0;
$doanhthuhomnay = 0;
$cacwebdatao = 0;
$cacwebdangchay = 0;
$sourcedamua = 0;


$time2 = explode('/', $time);
$doanhthu = 0;
$doanhthuthangtruoc = 0;
$result = mysqli_query($connect, "SELECT * FROM napthe WHERE trangthai = 2");
while($row = mysqli_fetch_assoc($result)){
  $timez = explode('/', $row['time']);
  if( ($timez[1] == $time2[1]) && ($timez[2] == $time2[2]) ){
    $doanhthu = $doanhthu + $row['menhgia'];
  }
    if( ($timez[1] == $time2[1] - 1) && ($timez[2] == $time2[2]) ){
    $doanhthuthangtruoc = $doanhthuthangtruoc + $row['menhgia'];
  }
   if($timez[2] == $time2[2] ){
      $tienthuduoctrongnam = $tienthuduoctrongnam + $row['menhgia'];
  }
  
     if($timez[2] == $time2[2] - 1 ){
       $tienthuduocnamtruoc =  $tienthuduocnamtruoc + $row['menhgia'];
  }
  
  
    if( ($timez[0] == $time2[0]) && ($timez[1] == $time2[1]) && ($timez[2] == $time2[2]) ){
    $doanhthuhomnay = $doanhthuhomnay + $row['menhgia'];
  }
 
  
  $tongtien = $tongtien + $row['menhgia'];
} 


$result = mysqli_query($connect, "SELECT * FROM taoweb");
while($row = mysqli_fetch_assoc($result)){

    $cacwebdatao = $cacwebdatao + 1;
    $webchuatao = 0;
    
      $timez = explode('/', $row['time1']);
      
         if( ( $row['time1'] + (2592000 * $row['thanhtoan']) ) >= time() ){
                
            
    $cacwebdangchay = $cacwebdangchay + 1;

    

  }
  
}
$webchuatao = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM taoweb WHERE trangthai = '0'"));


$result = mysqli_query($connect, "SELECT * FROM lichsu_muasourcecode");
while($row = mysqli_fetch_assoc($result)){
    
    $sourcedamua = $sourcedamua + 1;
    
}

$all_magiamgia = 0;
$magiamgia_true = 0;
$result = mysqli_query($connect, "SELECT * FROM magiamgia");
while($row = mysqli_fetch_assoc($result)){
    
    $all_magiamgia = $all_magiamgia + 1;
    
    if($row['trangthai'] == 'true'){
            $magiamgia_true = $magiamgia_true + 1;
    }
    
}



?>

<div class="py-4"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="bg-light rounded shadow mb-3" style="width: 100%; height: 150px">
                            <div class="py-3"></div>
                            <h4 class="text-center text-danger">WEB Cần Tạo</h4>
                            <center>
                                <div style="width: 20px; margin-top: -10px;">
                                    <hr />
                                </div>
                            </center>
                            <h4 class="text-center"><?php echo number_format($webchuatao); ?> </h4>
                        </div>
                    </div>

                </div>
            </div>
           
            
<?php require_once "theme/footer.php"; ?>