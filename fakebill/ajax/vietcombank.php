<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bank = $_POST["forbank"];
    $magd = $_POST["magiaodich"];
    $hinhthucck = $_POST["hinhthucck"] ?? "";
    $time = $_POST["time1"];
    $noidung = $_POST["noidung"];
    $sotiengd = $_POST["amount"];
    $name_nhan = $_POST["name_nhan"];
    $stk_nhan = $_POST["stk"];
    $banknhan = $_POST["bank"] ?? "";
    $giochuyen = $_POST["giochuyen"] ?? "trongthao";
    $filePath = 'images/vietcombank.png';
    $fontPath = 'font/';
    $image = imagecreatefrompng($filePath);

    if (!is_numeric($sotiengd)) {
        http_response_code(405);
        echo "Ngu , số tiền mà dùng ký tự đặc biệt !";
    } else {
        function canlephai($image,$fontsize,$y,$textColor,$font,$text){
            $fontSize = $fontsize;
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $x = imagesx($image) - 50 - $textWidth;
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
        canlephai($image, 37, 1545, imagecolorallocate($image, 255, 255, 255), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', $noidung);
        canlephai($image, 37, 1380, imagecolorallocate($image, 255, 255, 255), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', $magd);
        canlephai($image, 37, 1220, imagecolorallocate($image, 255, 255, 255), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', $stk_nhan);
        canlephai($image, 37, 1050, imagecolorallocate($image, 255, 255, 255), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', $name_nhan);
        canchinhgiua($image, 50, 790, imagecolorallocate($image, 115, 191, 3), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', number_format($sotiengd, 0, ',', ',') . ' VND');
        canchinhgiua($image, 25, 850, imagecolorallocate($image, 124, 135, 143), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', $time);
        canbentren($image, 57, 83, imagecolorallocate($image, 255, 255, 255), $fontPath . '/San Francisco/SanFranciscoText-Semibold.otf', $giochuyen, 34);
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
