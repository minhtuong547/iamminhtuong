<?php


//code php

if (isset($_POST['shorten'])) {

    // người dùng đã bấm submit
    $link = "";
    if (!empty($_POST['link'])) {
        $link = $_POST['link'];

        $chars = ['y', 'z', 'o', 'i', 's'];
        $shorten_url_name = "";
        for ($i = 0; $i < 5; $i++) {
            // tên file rút gọn cái 5 ký tự
            $random_index = rand(0, count($chars) - 1);
            $shorten_url_name .= $chars[$random_index];
        }
        if (strlen($shorten_url_name) > 0) {
            // 86400 = 1 ngày
            setcookie($shorten_url_name, $link, time() + (86400 + 365), "/");
            $base_url = "https://iamminhtuong.vn/php?url="; // đổi thành đường dẫn của bạn
            $full_link_shorten =  $base_url . $shorten_url_name;
        }
    }
}

if (isset($_GET['url'])) {
    $url = $_GET['url'];
    $url_from_cookies = $_COOKIE[$url];
    header("location:${url_from_cookies}");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shorten Links</title>
    <link rel="stylesheet" href="./styles/main.css">
</head>

<body>

    <div class="container">
        <h1 class="title">Rút gọn link với PHP</h1>
        <form action="index.php" method="POST">
            <input value="
            <?php
            if (!empty($full_link_shorten)) {
                echo $full_link_shorten;
            }
            ?>
            " type="text" class="link" name="link" placeholder="https://">
            <input type="submit" class="shorten" name="shorten" value="Rút gọn">
        </form>
    </div>
</body>

</html>