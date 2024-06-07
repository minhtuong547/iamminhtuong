<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php');

$gameType = $soicoder->real_escape_string(check_string($_POST['gameType']));
$game = explode('_Game', $gameType)[0];
$render = [];
$data = $soicoder->fetch_assoc("SELECT * FROM `game` WHERE `game_code` = '$game'", 1);
if (is_array($data)) {
    $list_content = explode("|", $data['content']);
    $list_ratio = explode("|", $data['ratio']);
    $list_result = explode("|", $data['result']);
    for ($i = 0; $i < count($list_content); $i++) {
        $content = $list_content[$i];
        $result = explode("-", $list_result[$i]);
        $ratio = $list_ratio[$i];
        $value = array(
            "gameType" => $gameType,
            "content" => $content,
            "numberTLS" => $result,
            "amount" => $ratio,
            "createdAt" => time(),
            "updatedAt" => time()
        );
        array_push($render, $value);
    }
}
header("Content-type:text/json");
echo json_encode(array(
    "success" => true,
    "message" => "Lấy thành công!",
    "data" => $render
), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);