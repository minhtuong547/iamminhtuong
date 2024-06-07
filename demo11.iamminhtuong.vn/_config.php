<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

$url     = 'http://localhost';
$account = 'accountkaka.txt';

function generateRandomString($length = 29) {
    $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString     = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function writeFile($account,$username,$password) {
    $file = $account;
    $current = file_get_contents($file);
    $current .= "$username|$password\n";
    file_put_contents($file, $current);
}
?>