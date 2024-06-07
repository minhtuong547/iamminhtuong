<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php');
$render = [];
// list phone
$list_phone = [];
$min_max_phone = [];
$list = $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `pay` = 'on' AND `status` = 'success' ", 0);
foreach ($list as $data) {
    $info_phone = $soicoder->fetch_assoc("SELECT SUM(`trans_amount`) FROM `history` WHERE `date` = '" . date('d/m/Y') . "' AND `account` =  '" . $data['phone'] . "'", 1);
    $info_chyen = $soicoder->fetch_assoc("SELECT SUM(`bonus`),COUNT(*) FROM `history` WHERE `bonus` > 0 AND `date` = '" . date('d/m/Y') . "' AND `account` =  '" . $data['phone'] . "'", 1);
    $info_chuyentien = $soicoder->fetch_assoc("SELECT SUM(`amount`),COUNT(*) FROM `chuyen_tien` WHERE `date_time` = '" . date('d/m/Y') . "' AND `ownerNumber` =  '" . change_phone($data['phone']) . "'", 1);
    $level = $info_phone['SUM(`trans_amount`)']; // tổng số tiền nhận trong ngày
    $sum_gd = $info_chyen['COUNT(*)'] + $info_chuyentien['COUNT(*)']; // tổng số giao dịch chuyển trong ngày
    $sum_chuyentien = $info_chuyentien['SUM(`amount`)'] + $info_chyen['SUM(`bonus`)']; // tổng số tiền chuyển trong ngày
    if ($sum_chuyentien > $settings['limit_monney_day']) {
        continue;
    }
    $value = array(
        "id" => $data['id'],
        "phone" => $data['phone'],
        "min" => $data['min'],
        "max" => $data['max'],
        "total_day" => $sum_gd,
        "money_day" => round($sum_chuyentien),
        "money_month" => round($sum_chuyentien)
    );
    array_push($list_phone, $data['phone']);
    array_push($min_max_phone, $value);
    
}
// game
$list_game = [];
$config_game = $soicoder->fetch_assoc("SELECT * FROM `game` WHERE `status` = 'on' ", 0);
$list_des = array(
    '1END' => 'là một game tính kết quả bằng <b> 1 số cuối mã giao dịch</b>.',
    '2END' => 'là một game tính kết quả bằng <b> 2 số cuối mã giao dịch</b>.',
    'H2END' => 'là một game tính kết quả bằng hiệu <b> 2 số cuối mã giao dịch</b>.'
);
$id = 0;
foreach ($config_game as $key => $data) {
    $data_content = explode('|', $data['content2']);
    $data_result = explode('|', $data['result']);
    $data_ratio = explode('|', $data['ratio']);
    $list_rule = [];
    for ($i = 0; $i < count($data_content); $i++) {
        $content_game = $data_content[$i];
        $result_game = explode('-', $data_result[$i]);
        $ratio_game = $data_ratio[$i];
        $rule = array(
            'comment' => $content_game,
            'tile' => $ratio_game,
            'number' => $result_game
        );
        array_push($list_rule, $rule);
    }
    $data_game = array(
        'id' => (int)$id,
        'name' => $data['name'],
        'description' => '- <b>'.$data['name'].'</b>: '. $list_des[$data['type_code']]. str_replace("\\", '', html_entity_decode(base64_decode($data['description']))),
        'type' => $id,
        'rule' => $list_rule,
        'phone' => $list_phone
    );
    array_push($list_game, $data_game);
    $id++;
}
// lịch sử
$history = [];
$list = $soicoder->fetch_assoc("SELECT * FROM `history` WHERE  `result` = 'win' AND `status` = 'done' ORDER BY id desc LIMIT 10", 0);
$config_game = $soicoder->fetch_assoc("SELECT * FROM `game` ", 0);
$list_data_game = [];
foreach ($config_game as $data_game) {
    $list_data_game[$data_game['game_code']] = $data_game['name'];
}
$dem = 0;
foreach ($list as $data) {
    $phone = $data['phone'];
    $value = array(
        "phone" => $phone,
        "money" => $data['trans_amount'],
        "comment" => $data['description']
    );
    array_push($history, $value);
}
// list top
$list_top = [];
$time_week = strtotime("this week 00:00:00");
$list = $soicoder->fetch_assoc("SELECT DISTINCT `phone` FROM `history` ", 0);
$i = 1;
$list_top = [];
$reward_top = explode('/', $settings['reward_top']);
foreach ($list as $data) {
    $phone = $data['phone'];
    $topreal = $soicoder->fetch_assoc("SELECT SUM(`trans_amount`) FROM `history` WHERE `trans_amount` >= 0 AND `time` >= '" . $time_week . "' AND `phone` =  '" . $phone . "' ORDER BY 'SUM(`trans_amount`)' desc", 1);
    $list_top[$phone] = $topreal['SUM(`trans_amount`)'];
}
arsort($list_top);
$dem = 0;
foreach ($list_top as $phone => $trans_amount) {
    $dem++;
    if ($dem > 5) {break;}
    $top = array(
        "phone" => $phone,
        "money" => $trans_amount
    );
    array_push($list_top, $top);
}

// website
$website = array(
    "id" =>  1,
    "notification" =>  $settings['event'],
    "zalo" =>  $settings['box_tele'],
    "telegram" =>  $settings['tele'],
    "top_1" =>  $reward_top[0],
    "top_2" =>  $reward_top[1],
    "top_3" =>  $reward_top[2],
    "top_4" =>  $reward_top[3],
    "top_5" =>  $reward_top[4],
    "logo" =>  $settings['logo'],
    "color" =>  $settings['color_web'],
    "chat" =>  null,
    "by" =>  2,
    "created_at" =>  "2023-01-17T14 26:04.000000Z",
    "updated_at" => "2023-09-24T11:01:04.000000Z"
);
header("Content-type:text/json");
echo json_encode(array(
    "game" => $list_game,
    "phone" => [],
    "min_max_phone" => $min_max_phone,
    "history" => $history,
    "top" => $list_top,
    "website" => $website
), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);