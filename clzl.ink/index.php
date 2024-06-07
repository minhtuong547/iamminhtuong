<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php';
// check bảo trì
if ($settings['status'] == 'off') {
    require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/503.php';
    die;
} else {
    require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/theme'.$settings['theme'].'.php';
}
?>
