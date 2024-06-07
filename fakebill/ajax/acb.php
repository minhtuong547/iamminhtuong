<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bank = $_POST["forbank"];
    $magd = $_POST["magiaodich"];
    $hinhthucck = $_POST["hinhthucck"] ?? "";
    $time = $_POST["time1"];
    $noidung = $_POST["noidung"];
    $name_gui = $_POST["name_gui"];
    $stk_gui = $_POST["stk_gui"];
    $sotiengd = $_POST["amount"];
    $name_nhan = $_POST["name_nhan"];
    $stk_nhan = $_POST["stk"];
    $banknhan = $_POST["bank"] ?? "";;
    $filePath = 'images/acb.png';
    $fontPath = 'font/';
    $image = imagecreatefrompng($filePath);

    if (!is_numeric($sotiengd)) {
        http_response_code(405);
        echo "Ngu , số tiền mà dùng ký tự đặc biệt !.";
    } else {
        function canlephai($image,$fontsize,$y,$textColor,$font,$text){
            $fontSize = $fontsize;
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $x = imagesx($image) - 100 - $textWidth;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        
        }
        function canletrai($image,$fontsize,$y,$textColor,$font,$text){
            $fontSize = $fontsize;
            imagettftext($image, $fontSize, 0, 140, $y, $textColor, $font, $text);
        
        }
        function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text) {
            $fontSize = $fontsize;
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $x = ($imageWidth - $textWidth) / 2; 
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        } 
        
        $dateString = $time;
        $dateArray = explode(' - ', $dateString);
        $datePart = $dateArray[0]; 
        $datePart = substr($dateString, 0, strpos($dateString, ' - '));
        function convert_number_to_words($number)
        {
            if (strpos($number, '.')) {
                list($integer, $fraction) = explode(".", (string)$number);
            } else { 
                $integer = $number;
                $fraction = NULL;
            }
        
            $output = "";
        
            if ($integer[0] == "-") {
                $output = "âm ";
                $integer = ltrim($integer, "-");
            } else if ($integer[0] == "+") {
                $output = "dương ";
                $integer = ltrim($integer, "+");
            }
        
            if ($integer[0] == "0") {
                $output .= "không";
            } else {
                $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
                $group = rtrim(chunk_split($integer, 3, " "), " ");
                $groups = explode(" ", $group);
        
                $groups2 = array();
                foreach ($groups as $g) {
                    $groups2[] = convertThreeDigit($g[0], $g[1], $g[2]);
                }
        
                for ($z = 0; $z < count($groups2); $z++) {
                    if ($groups2[$z] != "") {
                        $output .= $groups2[$z] . convertGroup(11 - $z) . (
                            $z < 11
                            && !array_search('', array_slice($groups2, $z + 1, -1))
                            && $groups2[11] != ''
                            && $groups[11][0] == '0'
                                ? " "
                                : ", "
                            );
                    }
                }
        
                $output = rtrim($output, ", ");
            }
        
            if ($fraction > 0) {
                $output .= " phẩy";
                for ($i = 0; $i < strlen($fraction); $i++) {
                    $output .= " " . convertDigit($fraction[$i]);
                }
            }
        
            return $output;
        }
        
        function convertGroup($index)
        {
            switch ($index) {
                case 11:
                    return " decillion";
                case 10:
                    return " nonillion";
                case 9:
                    return " octillion";
                case 8:
                    return " septillion";
                case 7:
                    return " sextillion";
                case 6:
                    return " quintrillion";
                case 5:
                    return " nghìn triệu triệu";
                case 4:
                    return " nghìn tỷ";
                case 3:
                    return " tỷ";
                case 2:
                    return " triệu";
                case 1:
                    return " nghìn";
                case 0:
                    return "";
            }
        }
        
        function convertThreeDigit($digit1, $digit2, $digit3)
        {
            $buffer = "";
        
            if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0") {
                return "";
            }
        
            if ($digit1 != "0") {
                $buffer .= convertDigit($digit1) . " trăm";
                if ($digit2 != "0" || $digit3 != "0") {
                    $buffer .= " ";
                }
            }
        
            if ($digit2 != "0") {
                $buffer .= convertTwoDigit($digit2, $digit3);
            } else if ($digit3 != "0") {
                $buffer .= convertDigit($digit3);
            }
        
            return $buffer;
        }
        
        function convertTwoDigit($digit1, $digit2)
        {
            if ($digit2 == "0") {
                switch ($digit1) {
                    case "1":
                        return "mười";
                    case "2":
                        return "ai mươi";
                    case "3":
                        return "ba mươi";
                    case "4":
                        return "bốn mươi";
                    case "5":
                        return "năm mươi";
                    case "6":
                        return "sáu mươi";
                    case "7":
                        return "bảy mươi";
                    case "8":
                        return "tám mươi";
                    case "9":
                        return "chín mươi";
                }
            } else if ($digit1 == "1") {
                switch ($digit2) {
                    case "1":
                        return "mười một";
                    case "2":
                        return "mười hai";
                    case "3":
                        return "mười ba";
                    case "4":
                        return "mười bốn";
                    case "5":
                        return "mười lăm";
                    case "6":
                        return "mười sáu";
                    case "7":
                        return "mười bảy";
                    case "8":
                        return "mười tám";
                    case "9":
                        return "mười chín";
                }
            } else {
                $temp = convertDigit($digit2);
                if ($temp == 'năm') $temp = 'lăm';
                if ($temp == 'một') $temp = 'mốt';
                switch ($digit1) {
                    case "2":
                        return "hai mươi $temp";
                    case "3":
                        return "ba mươi $temp";
                    case "4":
                        return "bốn mươi $temp";
                    case "5":
                        return "năm mươi $temp";
                    case "6":
                        return "sáu mươi $temp";
                    case "7":
                        return "bảy mươi $temp";
                    case "8":
                        return "tám mươi $temp";
                    case "9":
                        return "chín mươi $temp";
                }
            }
        }
        
        function convertDigit($digit)
        {
            switch ($digit) {
                case "0":
                    return "không";
                case "1":
                    return "một";
                case "2":
                    return "hai";
                case "3":
                    return "ba";
                case "4":
                    return "bốn";
                case "5":
                    return "năm";
                case "6":
                    return "sáu";
                case "7":
                    return "bảy";
                case "8":
                    return "tám";
                case "9":
                    return "chín";
            }
        }
        canlephai($image, 38, 2410, imagecolorallocate($image, 9, 42, 137), $fontPath.'/Helvetica-Font/Helvetica.ttf', $noidung);
        canlephai($image, 37, 1745, imagecolorallocate($image, 0, 1, 2), $fontPath.'/Helvetica-Font/Helvetica.ttf', $stk_nhan);
        canlephai($image, 37, 1565, imagecolorallocate($image, 0, 1, 2), $fontPath.'/Helvetica-Font/Helvetica.ttf', $banknhan);
        canlephai($image, 37, 1455, imagecolorallocate($image, 0, 1, 2), $fontPath.'/Helvetica-Font/Helvetica.ttf', $name_nhan);
        canletrai($image, 37, 1140, imagecolorallocate($image, 0, 37, 127), $fontPath.'/Helvetica-Font/Helvetica.ttf', $name_nhan);
        canletrai($image, 37, 1200, imagecolorallocate($image, 0, 37, 127), $fontPath.'/Helvetica-Font/Helvetica-Bold.ttf', $stk_gui);
        canletrai($image, 35, 630, imagecolorallocate($image, 72, 72, 72), $fontPath.'/Helvetica-Font/Helvetica.ttf', 'Ngày lập lệnh');
        canletrai($image, 35, 750, imagecolorallocate($image, 72, 72, 72), $fontPath.'/Helvetica-Font/Helvetica.ttf', 'Ngày hiệu lực');
        canlephai($image, 35, 630, imagecolorallocate($image, 72, 72, 72), $fontPath.'/Helvetica-Font/Helvetica.ttf', $time);
        canlephai($image, 35, 750, imagecolorallocate($image, 72, 72, 72), $fontPath.'/Helvetica-Font/Helvetica.ttf', $datePart);
        canchinhgiua($image, 45, 280, imagecolorallocate($image, 13, 107, 194), $fontPath.'/Helvetica-Font/UTM HelveBold.ttf', number_format($sotiengd, 0, '.', '.') . ' VND');
        canchinhgiua($image, 30, 350, imagecolorallocate($image, 72, 72, 72), $fontPath.'/Helvetica-Font/Helvetica.ttf', ucfirst(convert_number_to_words($sotiengd)).' đồng');
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
