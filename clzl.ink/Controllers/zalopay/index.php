<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Models/connect.php');
if ($_GET['LICENSE'] == 'hackconcacditmemay') {
    $account = $soicoder->real_escape_string(check_string($_GET['account'])); // số zalopay
    $loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '" . $account . "' LIMIT 1 ", 1);
    header("Content-type:text/json");
    echo json_encode($loadDATA, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
    require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/404.php';
}
die;