<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Controllers/zalopay/zalopay.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
// cài đặt chung

$setting = $soicoder->fetch_assoc("SELECT * FROM `settings` ", 1);
$config_game = $soicoder->fetch_assoc("SELECT * FROM `game` WHERE `status` = 'on' ", 0);
$list_msg = explode(',', $setting['content']);
$msg_send = $list_msg[array_rand($list_msg, 1)];
$limit = $setting['limit_trans'];
// check bảo trì
if ($setting['status'] == 'off') {
    die('Web Đang Bảo Trì');
}

$list = $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `status` = 'success' AND `pay` = 'on' LIMIT 1000", 0);
if (count($list) == 0) {
    echo "Không Có Zalopay Nào Được Bật";
    die;
}
foreach ($list as $loadDATA) {
    $account = $loadDATA['phone'];
    $zalopay = new Zalopay($soicoder);
    // update số dư
    $get_balance = ($loadDATA['type_api'] == 'app') ? json_decode($zalopay->LoadData($loadDATA)->getBalance(), true) : json_decode($zalopay->LoadData($loadDATA)->getBalance_web(), true);
    if (empty($get_balance['error'])) {
        $soicoder->update("zalopays", array(
            'balance' => $get_balance['data']['balance'],
        ), "`phone` = '$account' ");
    } else {
        $soicoder->update("zalopays", array(
            'balance' => "0",
            'status' => 'wait_login',
            'errorDesc' => 'Hết Thời Gian Truy Cập Do Đổi Thiết Bị',
        ), "`phone` = '$account' ");
    } 
    // get lịch sử
    if ($loadDATA['type_api'] == 'app') {
        $result = $zalopay->LoadData($loadDATA)->History_noti($limit);
    } else {
        $result = $zalopay->LoadData($loadDATA)->History_noti_web($limit);
    }
    // print_r($result);
    // header("Content-type:text/json");
    // echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    // die;


    if (count($result['zalopayMsg']['tranList']) == 0) {
        echo "Không Tìm Thấy Lịch Sử Giao Dịch";
        continue;
    }
    foreach ($result['zalopayMsg']['tranList'] as $data) {
        $trans_id = $data['trans_id'];
        $sign = $data['sign'];
        $trans_time = $data['trans_time'];
        if ($sign == -1) {
            continue; // bỏ qua giao dịch chuyển đi
        }
        // check database
        $check = $soicoder->num_rows("SELECT * FROM `history` WHERE `account` = '" . $account . "' AND `trans_id` = '" . $trans_id . "' LIMIT 1 ");
        if ($check != 0) {
            continue;
        }
        // thông tin giao dịch
        $phone = $data['phone'];
        $balance_snapshot = $data['balance_snapshot'];
        $trans_amount = $data['trans_amount'];
        $description = strtoupper($data['description']);
        $app_trans_id = $data['app_trans_id'];
        // $user_id = $data['partner_user_id'];
        $is_phone = 0;
        $is_cmt = 0;
        // check nội dung
        if (strpos($description, ' ') !== false) {
            $number = explode(' ', $description)[0];
            if (preg_match('/^(\+84|0)[0-9]{9}$/', $number)) {
                $is_phone = 1;
                $phone_get_reward = $number;
                $comment = explode(' ', $description)[1];
            } else {
                $is_phone = 0;
                $comment = $description;
            }
        } else {
            $comment = $description;
        }

        // check game lần 1
        foreach ($config_game as $data_game) {
            $data_content = explode('|', $data_game['content']);
            foreach ($data_content as $content_game) {
                $data_cmt = explode('-', $content_game);
                if (in_array($comment, $data_cmt)) {
                    $game = $data_game['game_code'];
                    break;
                } else {
                    $game = 'undefined'; // nội dung sai cú pháp
                }
            }
            if ($game !== 'undefined') {
                break;
            }
        }
        if ($game == 'undefined') {
            $is_cmt = 0;
            $comment = substr($trans_amount, -2);
            // check game lần 2
            foreach ($config_game as $data_game) {
                $data_content = explode('|', $data_game['content2']);
                foreach ($data_content as $content_game) {
                    $data_cmt = explode('-', $content_game);
                    if (in_array($comment, $data_cmt)) {
                        $game = $data_game['game_code'];
                        break;
                    } else {
                        $game = 'undefined'; // nội dung sai cú pháp
                    }
                }
                if ($game !== 'undefined') {
                    break;
                }
            }
        } else {
            $is_cmt = 1;
        }
        echo "[comment,".$comment."]";
        // lưu vào database
        echo "[" . $trans_id . "," . $game . "]";
        $soicoder->insert('history', array(
            'account' => $account,
            'phone' => $phone,
            // 'partner_user_id' => $data['partner_user_id'],
            // 'partner_zalo_id' => $data['partner_zalo_id'],
            'phone_result' => 'undefined',
            'trans_id' => $trans_id,
            'sign' => $sign,
            'balance_snapshot' => $balance_snapshot,
            'trans_amount' => $trans_amount,
            'description' => $comment,
            'game' => $game,
            'amount_game' => '0',
            'result' => 'undefined',
            'status_text' => 'success',
            'bonus' => '0',
            'msg_bonus' => 'undefined',
            'status' => 'waiting',
            'trans_time' => strtotime($trans_time),
            'app_trans_id' => $app_trans_id,
            'date' => date('d/m/Y'),
            'time' => time()
        ));
        $soicoder->update("zalopays", array(
            'receive_day' => $loadDATA['receive_day'] + $trans_amount,
            // 'receive_mon' => $loadDATA['receive_mon'] + $trans_amount,
        ), " `phone` = '" . $account . "' ");
        // bỏ qua nếu sai nội dung
        if ($game == 'undefined') {
            $soicoder->update("history", array(
                'status' => 'wrong_content'
            ), " `account` = '" . $account . "' AND `trans_id` = '" . $trans_id . "' ");
            continue;
        }
        // các danh sách tách
        $end1c = substr($trans_id, -1);  // 1 số cuối
        $end2c = substr($trans_id, -2);  // 2 số cuối
        $end3c = substr($trans_id, -3);  // 3 số cuối
        $endkc = substr($end2c, 0, 1); // số kề cuối
        $endk2c = substr($end3c, 0, 1); // số thứ 3 kể từ cuối
        // check sai min max
        $min = $loadDATA['min'];
        $max = $loadDATA['max'];
        
        if ($trans_amount < $min or $trans_amount > $max) {
            $soicoder->update("history", array(
                'status' => 'wrong'
            ), " `account` = '" . $account . "' AND `trans_id` = '" . $trans_id . "' ");
            continue;
        }
        // check giao dịch trước khi đăng nhập
        if (strtotime($trans_time) < $loadDATA['time_login']) {
            $soicoder->update("history", array(
                'status' => 'late'
            ), " `account` = '" . $account . "' AND `trans_id` = '" . $trans_id . "' ");
            continue;
        }
        // ====================[ CHECK GAME ]=============================================
        $win = 0;
        $ratio_win = 0;
        foreach ($config_game as $data_game) {
            if ($data_game['type_code'] == '1END') {
                $check_win = $end1c;
            } else if ($data_game['type_code'] == '2END') {
                $check_win = $end2c;
            } else if ($data_game['type_code'] == 'H2END') {
                $check_win = $endkc - $end1c;
            } else if ($data_game['type_code'] == 'T3END') {
                $check_win = $endk2c + $endkc + $end1c;
            } else {
                continue;
            }
            $data_content = ($is_cmt == 1) ? explode('|', $data_game['content']) : explode('|', $data_game['content2']);
            $data_result = explode('|', $data_game['result']);
            $data_ratio = explode('|', $data_game['ratio']);
            for ($i = 0; $i < count($data_content); $i++) {
                $content_game = $data_content[$i];
                $result_game = explode('-', $data_result[$i]);
                $ratio_game = $data_ratio[$i];
                if (in_array($check_win, $result_game) && $comment == $content_game) {
                    echo "[done]";
                    // trả thưởng
                    $win = 1;
                    $ratio_win = $ratio_game;
                    $money = round($ratio_game * $trans_amount);
                    $content = substr($trans_id, -4);
                    break;
                }
            }
        }
        if ($win == 1) {
            // load data số trả thưởng
            if ($settings['type_reward'] == 'option') {
                $loadDATA_reward =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '".$loadDATA['reward']."' LIMIT 1 ", 1);
            } else {
                $loadDATA_reward = $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `balance` > '$money' AND `status` = 'success' ORDER BY RAND() LIMIT 1 ", 1);
            }
            // check block
            // echo "[check block]";
            // $check_block = $soicoder->num_rows("SELECT * FROM `block_list` WHERE `user_id` = '" . $user_id . "' ");
            // echo "[check_block,".$check_block."]";
            // if ($check_block != 0) {
            //     $soicoder->update('history', array(
            //         'phone_result' => $loadDATA_reward['phone'],
            //         'amount_game' => $ratio_win,
            //         'game' => $game,
            //         'result' => 'win',
            //         'bonus' => $money,
            //         'msg_bonus' => $content,
            //         'status' => 'block',
            //         'status_text' => "Block Do Spam Nên Không Được Nhận Tiền",
            //     ), " `account` = '" . $account . "' AND `trans_id` = '" . $trans_id . "' ");
            //     echo "[Win + Block ".$game."]";
            //     continue;
            // }
            // check kiểu trả thưởng
            if ($is_phone == 1) {
                if ($loadDATA_reward['type_api'] == 'app') {
                    $send = $zalopay->LoadData($loadDATA_reward)->SendMoney($phone_get_reward, $content, $money);
                } else {
                    $send = $zalopay->LoadData($loadDATA_reward)->SendMoney_web($phone_get_reward, $content, $money);
                }
            } else {
                // check info
                if ($loadDATA_reward['type_api'] == 'app') {
                    $info = $zalopay->LoadData($loadDATA)->getOrderInfo($app_trans_id);
                } else {
                    $info = $zalopay->LoadData($loadDATA)->getOrderInfo_web($app_trans_id);
                }
                // chuyển tiền lại
                if ($loadDATA_reward['type_api'] == 'app') {
                    $send = $zalopay->LoadData($loadDATA_reward)->Reward($info, $content, $money);
                } else {
                    $send = $zalopay->LoadData($loadDATA_reward)->Reward_web($info, $content, $money);
                }
            }
            if ($send['status'] == 'success') {
                $soicoder->update('history', array(
                    'phone_result' => $loadDATA_reward['phone'],
                    'amount_game' => $ratio_win,
                    'game' => $game,
                    'result' => 'win',
                    'bonus' => $money,
                    'msg_bonus' => $content,
                    'status' => 'done',
                    'status_text' => $send['message'],
                ), " `account` = '" . $account . "' AND `trans_id` = '" . $trans_id . "' ");
                echo '[Đã Thanh Toán]';
            } else {
                $soicoder->update('history', array(
                    'phone_result' => $loadDATA_reward['phone'],
                    'amount_game' => $ratio_win,
                    'game' => $game,
                    'result' => 'win',
                    'bonus' => $money,
                    'msg_bonus' => $content,
                    'status' => 'wait_tt',
                    'status_text' => $send['message'],
                ), " `account` = '" . $account . "' AND `trans_id` = '" . $trans_id . "' ");
                // check loại lỗi
                if ($send['type'] == 'max') {
                    $soicoder->update("zalopays", array(
                        'pay' => 'off',
                    ), " `phone` = '" . $account . "' ");
                }
            }
            echo "[Win ".$game."]";
            continue;
        } else {
            $soicoder->update("history", array(
                'result' => 'lose',
                'status' => 'done'
            ), " `account` = '" . $account . "' AND `trans_id` = '" . $trans_id . "' ");
        }
    }
}
echo "[Cron Hoàn Tất]";