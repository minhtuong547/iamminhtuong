<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php');

$render = [];
$list = $soicoder->fetch_assoc("SELECT * FROM `history` WHERE  `result` = 'win' AND `status` = 'done' ORDER BY id desc LIMIT 10", 0);
$config_game = $soicoder->fetch_assoc("SELECT * FROM `game` ", 0);
$list_game = [];
foreach ($config_game as $data_game) {
    $list_game[$data_game['game_code']] = $data_game['name'];
}
$dem = 0;
foreach ($list as $data) {
    $phone = $data['phone'];
    $value = array(
        "time" => date('H:i:s d/m/Y', $data['time']),
        "phone" => $phone,
        "amount_play" => format_cash($data['trans_amount']),
        "result_number" => format_cash($data['bonus']),
        "game" => $list_game[$data['game']],
        "comment" => $data['description'],
        "code_status" => ($data['result'] == 'win') ? 'success' : 'danger',
        "status" => ($data['result'] == 'win') ? 'Thắng' : 'Thua'
    );
    array_push($render, $value);
}

echo json_encode($render, JSON_UNESCAPED_UNICODE);