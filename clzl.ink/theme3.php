<?php
$color = $settings['color_web'];
$config_game = $soicoder->fetch_assoc("SELECT * FROM `game` WHERE `status` = 'on' ", 0);
?>
<!DOCTYPE html>
<html lang="vi" style="--main-color: <?=$color;?>;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Mini Game ZaloPay Uy Tín - Giao Dịch 24/7 - Thanh Toán 5s</title>
    <meta content="<?=$settings['description'];?>" name="description">
    <meta content="<?=$settings['keyword'];?>" name="keywords">
    <meta content="/" property="og:url">
    <meta content="article" property="og:type">
    <link href="https://i.imgur.com/18kVe4S.png" rel="apple-touch-icon">
    <link href="https://i.imgur.com/18kVe4S.png" rel="shortcut icon" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet">
    <link href="/assets/css3/bootstrap.min.css?u=<?=time();?>" rel="stylesheet">
    <link href="/assets/css3/bootstrap-social.css?u=<?=time();?>" rel="stylesheet">
    <link href="/assets/css3/style.css?u=<?=time();?>" rel="stylesheet">
    <link href="/assets/css3/custom.css?u=<?=time();?>" rel="stylesheet">
    <link href="/assets/css3/wheel.css?u=<?=time();?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@0.5.4/dist/simple-notify.min.css">
    <script type="module" crossorigin="" src="/assets/js3/index.x.js?u=<?=time();?>"></script>
    <link rel="stylesheet" href="/assets/css3/index.57da5773.css?u=<?=time();?>">
    <style>
    .week_top {
        display: none;
    }
    </style>
</head>

<body style="" class="">
    <div id="app" data-v-app=""></div>

    <script src="/assets/js3/jquery.min.js?u=<?=time();?>"></script>
    <script src="/assets/js3/bootstrap.min.js?u=<?=time();?>"></script>


    <script>
    $(document).ready(function() {
        $("#noteModal").modal('show');
    })
    </script>


</body>

</html>