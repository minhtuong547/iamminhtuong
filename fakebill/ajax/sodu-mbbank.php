<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $stk = $_POST["stk"];
    $point = $_POST["point"];
    $sodu = $_POST["sodu"];
    $filePath = 'images/sdmb.png';
    $fontPath = 'font/';
    $image = imagecreatefrompng($filePath);

    if (!is_numeric($sodu)) {
        http_response_code(405);
        echo "Ngu , số tiền mà dùng ký tự đặc biệt !.";
    } else {
     function canletrai($image, $fontsize, $y, $textColor, $font, $text)
        {
            $fontSize = $fontsize;
            imagettftext($image, $fontSize, 0, 390, $y, $textColor, $font, $text);
        }

        function canpoint($image, $fontsize, $y, $textColor, $font, $text)
        {
            $fontSize = $fontsize;
            imagettftext($image, $fontSize, 0, 330, $y, $textColor, $font, $text);
        }

        function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text)
        {
            $fontSize = $fontsize;
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $x = ($imageWidth - $textWidth) / 2; // Căn giữa theo chiều ngang
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }

        function cansodu($image, $fontsize, $y, $textColor, $font, $sodu, $vndColor)
        {
            $fontSize = $fontsize;
            $soduText = number_format($sodu, 0, ',', ',');
            $editX = 93;
            imagettftext($image, $fontSize, 0, $editX, $y, $textColor, $font, $soduText);
            $vndFontSize = $fontSize * 0.5;
            $vndX = $editX + imagettfbbox($fontSize, 0, $font, $soduText)[2] + 3;
            imagettftext($image, $vndFontSize, 0, $vndX, $y, $vndColor, $font, 'VND');
        }

        cansodu($image, 40, 1085, imagecolorallocate($image, 125, 140, 153), $fontPath . '/AvertaStd/AvertaStd-Bold.otf', $sodu, imagecolorallocate($image, 116, 116, 116));
        canletrai($image, 28, 1020, imagecolorallocate($image, 125, 140, 153), $fontPath . '/AvertaStd/AvertaStd-Regular.otf', $stk);
        canpoint($image, 26, 1247, imagecolorallocate($image, 125, 140, 153), $fontPath . '/AvertaStd/AvertaStd-Regular.otf', number_format($point, 0, ',', ',') . ' Point');
        canchinhgiua($image, 45, 350, imagecolorallocate($image, 255, 255, 255), $fontPath . '/AvertaStd/AvertaStd-Bold.otf', $name);
    
    
    ob_start();
    imagejpeg($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    echo $base64;
    imagedestroy($image);
}
} else {
    http_response_code(405);
    echo 'ERROR CONTACT TO TRONGTHAO';
}
?>
