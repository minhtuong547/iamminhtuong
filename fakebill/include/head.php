<?php
$current_page = basename($_SERVER['PHP_SELF'], '.php');
if (!$current_page || $current_page !== 'index') {
    require_once('../config/conn.php');
} else {
    require_once('config/conn.php');
}
?>
<!DOCTYPE html>
<html lang="vi" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="./assets/" data-template="horizontal-menu-template-starter">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?=$title?></title>
    <meta name="title" content="<?=$title?>" />
    <meta name="description" content="<?=$description?>" />
    <meta name="author" content="trongthao" />
    <link rel="canonical" href="<?=$domain?>"/>
    <meta property="og:title" content="<?=$title?>" />
    <meta property="og:description" content="<?=$description?>" />
    <meta property="og:image" content="<?=$imgreviews?>" />
    <meta name="keywords" content="<?=$keyword?>">
    <link rel="shortcut icon" href="<?=$iconshortcut?>" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/vendor/fonts/materialdesignicons.css" />
    <link rel="stylesheet" href="./assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="./assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="./assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="./assets/css/demo.css<?=cache($hakibavuong)?>" />
    <link rel="stylesheet" href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <script src="./assets/vendor/js/helpers.js"></script>
    <script src="./assets/vendor/js/template-customizer.js"></script>
    <script src="./assets/js/config.js<?=cache($hakibavuong)?>"></script>
    <link rel="stylesheet" href="./assets/vendor/libs/toastr/toastr.css" />
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  </head>
  <body>
  <style>body{user-select:none;}
  .Blob {
  background: black;
  border-radius: 15%;
  height: 50px;
  width: 50px; 
  box-shadow: 0 1px 7px rgb(231, 231, 231);
}</style>