<?php
require __DIR__.'/app/include/core/function.php';
autoload();
if (!isset($_SESSION['user'])) {
  echo json_encode([
    'status' => false,
    'msg' => "Vui lòng đăng nhập",
  ]);
}
if (!empty($_POST['transid'])) {
  $tran_code = db_escape(addslashes(htmlentities(POST('transid', ENT_QUOTES, "UTF-8"))));
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "".$_SERVER['HTTP_HOST']."/core/momo.php?code=$tran_code",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  $data = json_decode($response, true);
  if ($data['status'] == 'success' && $data['content'] == 'sourcegiare_'.$_SESSION['user']) {
    $check_tranID = db_query("SELECT * FROM `momo` WHERE `tranId` = '".$tran_code."' ");

    if ($check_tranID->num_rows > 0) {
      echo json_encode([
        'status' => false,
        'msg' => 'Giao dịch đã được xử lý trước đó'
      ]);
    } else {
      $money_check = str_replace('.', '', $data['money']);
      $array_create = [
        'tranId' => $data['code'],
        'partnerId' => $data['phone'],
        'partnerName' => $data['name'],
        'amount' => $money_check,
        'comment' => $data['content'],
        'time' => $data['time'],
        'username' => $_SESSION['user'],
      ];
      $create = db_insert("momo", $array_create);
      if ($create) {
        db_query("UPDATE users SET
            `tien` = `tien` + '".$money_check."' WHERE `taikhoan` = '".$_SESSION['user']."' ");

        echo json_encode([
          'status' => true,
          'msg' => $data['msg'],
        ]);
      } else {
        echo json_encode([
          'status' => false,
          'msg' => 'Lỗi xảy ra báo cho Thành ngay',
        ]);
      }
    }
  } else {
    echo json_encode([
      'status' => false,
      'msg' => 'Lỗi xảy ra',
    ]);
  }
} else {
  echo json_encode([
    'status' => false,
    'msg' => 'Vui lòng nhập đủ thông tin'
  ]);
}