<?php
require __DIR__.'/app/include/core/function.php';
require_once __DIR__."/../../theme/head.php";
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
    CURLOPT_URL => "".$_SERVER['HTTP_HOST']."/core/thesieure.php?transid=$tran_code&id=".user()['id'],
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
  if ($data['status'] == '1' && $data['data']['noidung'] == 'sourcegiare_'$_SESSION['user']) {
    $check_tranID = db_query("SELECT * FROM `tsr` WHERE `transid` = '".$tran_code."' ");

    if ($check_tranID->num_rows > 0) {
      echo json_encode([
        'status' => false,
        'msg' => 'Giao dịch đã được xử lý trước đó'
      ]);
    } else {
      $array_create = [
        'transid' => $data['data']['magiaodich'],
        'amount' => $data['data']['sotien'],
        'time' => time_now(),
        'username' => $_SESSION['user'],
      ];
      $create = db_insert("tsr", $array_create);
      if ($create) {
        db_query("UPDATE user SET
            `tien` = `tien` + '".$data['data']['sotien']."' WHERE `taikhoan` = '".$_SESSION['user']."' ");

        echo json_encode([
          'status' => true,
          'msg' => 'Thực Hiện '.strtolower($data['message']),
        ]);
      } else {
        echo json_encode([
          'status' => false,
          'msg' => 'Lỗi xảy ra báo cho Đạt ngay',
        ]);
      }
    }
  } else {
    echo json_encode([
      'status' => false,
      'msg' => $data['status'],
    ]);
  }
} else {
  echo json_encode([
    'status' => false,
    'msg' => 'Vui lòng nhập đủ thông tin'
  ]);
}
?>