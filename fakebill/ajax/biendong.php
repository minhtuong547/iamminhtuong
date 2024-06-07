<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bank = $_POST["bank"];
    $type = $_POST["type"];
    $stk = $_POST["stk"];
    $sotien = $_POST["sotien"];
    $soducuoi = $_POST["soducuoi"];
    $time = $_POST["time"];
    $noidung = $_POST["noidung"];
    if (!is_numeric($sotien)) {
        http_response_code(405);
        echo "Ngu , số tiền mà dùng ký tự đặc biệt !.";
    } else {
           if($bank == 'agribank'){
    $filePath = 'images/bdsdagribank.png';
    $fontPath = 'font/';
    $image = imagecreatefrompng($filePath);
    function canletrai($image, $fontsize, $x, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }

    function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = ($imageWidth - $textWidth) / 2;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    function canbentren($image, $x, $y, $color, $fontPath, $text, $fontSize)
    {
        imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
    }
    if ($type === 'out') {
        canletrai($image, 40, 355, 1107, imagecolorallocate($image, 210, 121, 53), $fontPath . '/SVN-Arial/SVN-Arial Regular.ttf', '-'.number_format($sotien, 0, ',', ',').' VND');
    } elseif ($type === 'in') {
        canletrai($image, 40, 355, 1107, imagecolorallocate($image, 102, 168, 97), $fontPath . '/SVN-Arial/SVN-Arial Regular.ttf', '+'.number_format($sotien, 0, ',', ',').' VND');
    }
    canletrai($image, 40, 340, 1022, imagecolorallocate($image, 0, 0, 0), $fontPath . '/SVN-Arial/SVN-Arial Regular.ttf', $stk);
    canletrai($image, 40, 357, 1180, imagecolorallocate($image, 0, 0, 0), $fontPath . '/SVN-Arial/SVN-Arial Regular.ttf', number_format($soducuoi, 0, ',', ',').' VND');
    canletrai($image, 40, 335, 1260, imagecolorallocate($image, 0, 0, 0), $fontPath . '/SVN-Arial/SVN-Arial Regular.ttf', $noidung);
    canchinhgiua($image, 27, 750, imagecolorallocate($image, 0, 0, 0), $fontPath . '/SVN-Arial/SVN-Arial Regular.ttf', $time);
    canbentren($image, 115, 910, imagecolorallocate($image, 50, 50, 50), $fontPath . '/SVN-Arial/SVN-Arial Regular.ttf', $time, 29);
    ob_start();
    imagejpeg($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    echo $base64;
    imagedestroy($image);
}
    if($bank == 'acb'){
    $filePath = 'images/bdsdacb.png';
    $fontPath = 'font/';
    $image = imagecreatefrompng($filePath);
    function canletrai($image, $fontsize, $x, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }

    function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = ($imageWidth - $textWidth) / 2;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    function canbentren($image, $x, $y, $color, $fontPath, $text, $fontSize)
    {
        imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
    }
    if ($type === 'out') {
        canletrai($image, 37, 300, 794, imagecolorallocate($image, 51, 51, 51), $fontPath . '/Helvetica-Font/helvetica-light-587ebe5a59211.ttf', $stk.' - '.number_format($sotien, 0, ',', ',').' VND luc');
    } elseif ($type === 'in') {
       canletrai($image, 37, 300, 794, imagecolorallocate($image, 51, 51, 51), $fontPath . '/Helvetica-Font/helvetica-light-587ebe5a59211.ttf', $stk.' + '.number_format($sotien, 0, ',', ',').' VND luc');
    }
    canletrai($image, 40, 200, 933, imagecolorallocate($image, 51, 51, 51), $fontPath . '/Helvetica-Font/helvetica-light-587ebe5a59211.ttf',rand(3000,10000).' - '.$noidung);
    canbentren($image, 100, 614, imagecolorallocate($image, 51, 51, 51), $fontPath . '/Helvetica-Font/helvetica-light-587ebe5a59211.ttf', $time, 36);
    canbentren($image, 107, 867, imagecolorallocate($image, 51, 51, 51), $fontPath . '/Helvetica-Font/helvetica-light-587ebe5a59211.ttf', $time.'. So du '.number_format($soducuoi, 0, ',', ','), 40);
    ob_start();
    imagejpeg($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    echo $base64;
    imagedestroy($image);
}
if($bank == 'vietinbank'){
    $filePath = 'images/bdsdvietinbank.png';
    $fontPath = 'font/';
    $image = imagecreatefrompng($filePath);
    function canletrai($image, $fontsize, $x, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }

    function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = ($imageWidth - $textWidth) / 2;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    function canbentren($image, $x, $y, $color, $fontPath, $text, $fontSize)
    {
        imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
    }
    if ($type === 'out') {
        canletrai($image, 32, 284, 837, imagecolorallocate($image, 215, 18, 72), $fontPath . '/Vietinbank/SVN-Gilroy Bold.otf','-'.number_format($sotien, 0, ',', ',').' VND');
    } elseif ($type === 'in') {
       canletrai($image, 32, 284, 837, imagecolorallocate($image, 90, 175, 84), $fontPath . '/Vietinbank/SVN-Gilroy Bold.otf','+'.number_format($sotien, 0, ',', ',').' VND');
    }
    canletrai($image, 32, 364, 879, imagecolorallocate($image,2, 57, 58), $fontPath . '/Vietinbank/SVN-Gilroy Bold.otf',number_format($soducuoi, 0, ',', ',').' VND');
    canletrai($image, 32, 284, 789, imagecolorallocate($image, 2, 57, 58), $fontPath . '/Vietinbank/SVN-Gilroy Regular.otf', $stk);
    canletrai($image, 32, 460, 926, imagecolorallocate($image, 2, 57, 58), $fontPath . '/Vietinbank/SVN-Gilroy Regular.otf',rand(1000000000,9999999999).'; '.$noidung);
    canbentren($image, 136, 637, imagecolorallocate($image, 2, 57, 58), $fontPath . '/Vietinbank/SVN-Gilroy Regular.otf', $time, 32);
    canbentren($image, 284, 748, imagecolorallocate($image, 2, 57, 58), $fontPath . '/Vietinbank/SVN-Gilroy Regular.otf', $time, 32);
    ob_start();
    imagejpeg($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    echo $base64;
    imagedestroy($image);
}
if($bank == 'tpbank'){
    $filePath = 'images/bdsdtpbank.png';
    $fontPath = 'font/';
    $image = imagecreatefrompng($filePath);
    function canletrai($image, $fontsize, $x, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }

    function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = ($imageWidth - $textWidth) / 2;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }
    function canbentren($image, $x, $y, $color, $fontPath, $text, $fontSize)
    {
        imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
    }
    if ($type === 'out') {
        canletrai($image, 26, 235, 1423, imagecolorallocate($image, 27, 27, 27), $fontPath . '/SVN-Arial/SVN-Arial Regular.ttf', ' -'.number_format($sotien, 0, '.', '.').'VND');
    } elseif ($type === 'in') {
        canletrai($image, 40, 355, 1107, imagecolorallocate($image, 27, 27, 27), $fontPath . '/SVN-Arial/SVN-Arial Regular.ttf', ' +'.number_format($sotien, 0, '.', '.').'VND');
    }
    canletrai($image, 26, 320, 1373, imagecolorallocate($image, 27, 27, 27), $fontPath . '/SVN-Arial/SVN-Arial Regular.ttf', $stk);
    canletrai($image, 26, 250, 1473, imagecolorallocate($image, 27, 27, 27), $fontPath . '/SVN-Arial/SVN-Arial Regular.ttf', number_format($soducuoi, 0, '.', '.').'VND');
    canletrai($image, 26, 440, 1525, imagecolorallocate($image, 27, 27, 27), $fontPath . '/SVN-Arial/SVN-Arial Regular.ttf', number_format($soducuoi, 0, '.', '.').'VND');
    canletrai($image, 26, 255, 1576, imagecolorallocate($image, 27, 27, 27), $fontPath . '/SVN-Arial/SVN-Arial Regular.ttf', $noidung);
    canletrai($image, 26, 353, 1323, imagecolorallocate($image, 27, 27, 27), $fontPath . '/SVN-Arial/SVN-Arial Regular.ttf', $time);
    ob_start();
    imagejpeg($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    echo $base64;
    imagedestroy($image);
}
    }
} else {
    http_response_code(405);
    echo 'ERROR CONTACT TO TRONGTHAO';
}
?>
