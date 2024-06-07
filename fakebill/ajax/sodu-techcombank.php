<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sodu = $_POST["sodu"];
    $filePath = 'images/sdtech.png';
    $fontPath = 'font/';
    $image = imagecreatefrompng($filePath);

    if (!is_numeric($sodu)) {
        http_response_code(405);
        echo "Ngu , số tiền mà dùng ký tự đặc biệt !.";
    } else {
     function canletrai($image, $fontsize, $y, $textColor, $font, $text)
        {
            $fontSize = $fontsize;
            imagettftext($image, $fontSize, 0, 830, $y, $textColor, $font, $text);
        }

        canletrai($image, 41, 490, imagecolorallocate($image, 0, 0, 0), $fontPath . '/static/Vazirmatn-Regular.ttf', number_format($sodu, 0, ',', ','));
    
    
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
