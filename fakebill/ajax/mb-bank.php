<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bank = $_POST["forbank"];
    $magd = $_POST["magiaodich"];
    $hinhthucck = $_POST["hinhthucck"];
    $time = $_POST["time1"];
    $noidung = $_POST["noidung"];
    $name_gui = $_POST["name_gui"];
    $stk_gui = $_POST["stk_gui"];
    $sotiengd = $_POST["amount"];
    $name_nhan = $_POST["name_nhan"];
    $stk_nhan = $_POST["stk"];
    $banknhan = $_POST["bank"];
    $thoigianhientai = $_POST["thoigianhientai"] ?? "trongthao";
    $filePath = 'images/mbbank.png';
    $fontPath = 'font/';
    $image = imagecreatefrompng($filePath);

    if (!is_numeric($sotiengd)) {
        http_response_code(405);
        echo "Ngu , số tiền mà dùng ký tự đặc biệt !.";
    } else {
    function removeAccentsAndUpperCase($str) {
    $str = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    $str = strtoupper($str);
    return $str;
    }    
    function canlephai($image, $fontsize, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $x = imagesx($image) - 80 - $textWidth;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }

    function canletrai($image, $fontsize, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        imagettftext($image, $fontSize, 0, 220, $y, $textColor, $font, $text);
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
    canlephai($image, 37, 1700, imagecolorallocate($image, 0, 0, 0), $fontPath . '/AvertaStd/AvertaStd-Regular.otf', $magd);
    canlephai($image, 37, 1605, imagecolorallocate($image, 0, 0, 0), $fontPath . '/AvertaStd/AvertaStd-Regular.otf', $hinhthucck);
    canlephai($image, 37, 1515, imagecolorallocate($image, 0, 0, 0), $fontPath . '/AvertaStd/AvertaStd-Regular.otf', $time);
    canlephai($image, 37, 1378, imagecolorallocate($image, 0, 0, 0), $fontPath . '/AvertaStd/AvertaStd-Regular.otf', $noidung);
    canlephai($image, 37, 1220, imagecolorallocate($image, 0, 0, 0), $fontPath . '/AvertaStd/AvertaStd-Regular.otf', $stk_gui);
    canlephai($image, 37, 1280, imagecolorallocate($image, 0, 0, 0), $fontPath . '/AvertaStd/AvertaStd-Bold.otf', removeAccentsAndUpperCase($name_gui));
    canchinhgiua($image, 75, 455, imagecolorallocate($image, 255, 255, 255), $fontPath . '/AvertaStd/AvertaStd-Bold.otf', number_format($sotiengd, 0, ',', ',') . ' VND');
    canletrai($image, 37, 910, imagecolorallocate($image, 0, 0, 0), $fontPath . '/AvertaStd/AvertaStd-Bold.otf', removeAccentsAndUpperCase($name_nhan));
    canletrai($image, 37, 970, imagecolorallocate($image, 0, 0, 0), $fontPath . '/AvertaStd/AvertaStd-Regular.otf', $stk_nhan);
    canletrai($image, 37, 1030, imagecolorallocate($image, 0, 0, 0), $fontPath . '/AvertaStd/AvertaStd-Regular.otf', $banknhan);
    canbentren($image, 57, 83, imagecolorallocate($image, 255, 255, 255), $fontPath . '/AvertaStd/AvertaStd-Bold.otf', $thoigianhientai, 34);
    
    
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
