<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php');
$render = [];
$list = $soicoder->fetch_assoc("SELECT * FROM `history` WHERE `result` = 'win' ORDER BY id desc LIMIT 10", 0);
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
        "money" => ($data['trans_amount']),
        "bonus" => ($data['bonus']),
        "gameName" => $list_game[$data['game']],
        "content" => $data['description'][-1]
    );
    array_push($render, $value);
}
header("Content-type:text/json");
echo json_encode(array(
    "success" => true,
    "message" => "Lấy thành công!",
    "data" => $render
), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);