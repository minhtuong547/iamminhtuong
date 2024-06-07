<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $time = $_POST["time"] ?? "";
    $code = $_POST["code"] ?? "";
    $name_di = $_POST["name_di"];
    $stk_nhan = $_POST["stk_nhan"];
    $name_nhan = $_POST["name_nhan"];
    $bank = $_POST["bank"];
    $menhgia = $_POST["menhgia"];
    $phick = $_POST["phick"];
    $nd = $_POST["nd"];
    $banknhan = $_POST["bank"] ?? "";
    function alignRight($image, $text, $font, $size, $color, $y,$nhan=50)
        {
            $bbox = imagettfbbox($size, 0, $font, $text);
            $text_width = $bbox[2] - $bbox[0];
            $x = imagesx($image) - $text_width - $nhan; 
            imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
        }
        function alignCenter($image, $text, $font, $size, $color, $y)
{
    $bbox = imagettfbbox($size, 0, $font, $text);
    $text_width = $bbox[2] - $bbox[0];
    $x = (imagesx($image) - $text_width) / 2;
    imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
}
function ucwordsFirst($str) {
    $words = explode(' ', $str);
    $words = array_map('ucfirst', $words);
    return implode(' ', $words);
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
                return "hai mươi";
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
$output .= " đồng";
$output = ucfirst($output);
    return $output;
}
    $source_img = imagecreatefromjpeg('images/vietinbank.jpg');
        $width = imagesx($source_img);
        $height = imagesy($source_img);
        $dest_img = imagecreatetruecolor($width, $height);
        $masked_stk_di = '*******' . substr($stk_di, 5);
        imagecopy($dest_img, $source_img, 0, 0, 0, 0, $width, $height);
        alignRight($dest_img, $time, 'font/Vietinbank/SVN-Gilroy SemiBold.otf', 24, imagecolorallocate($dest_img, 133, 146, 151), 300);
        alignRight($dest_img, $code, 'font/Vietinbank/SVN-Gilroy SemiBold.otf', 24, imagecolorallocate($dest_img, 133, 146, 151), 350);
        alignRight($dest_img, $masked_stk_di, 'font/Vietinbank/SVN-Gilroy Medium.otf', 30, imagecolorallocate($dest_img, 13, 42, 70), 730);
        alignRight($dest_img, $name_di, 'font/Vietinbank/SVN-Gilroy Medium.otf', 30, imagecolorallocate($dest_img, 13, 42, 70), 790);
        alignRight($dest_img, $stk_nhan, 'font/Vietinbank/SVN-Gilroy Bold.otf', 30, imagecolorallocate($dest_img, 13, 42, 70), 890);
        alignRight($dest_img, $name_nhan, 'font/Vietinbank/SVN-Gilroy Bold.otf', 30, imagecolorallocate($dest_img, 13, 42, 70), 945);
        alignRight($dest_img, $bank, 'font/Vietinbank/SVN-Gilroy Medium.otf', 30, imagecolorallocate($dest_img, 13, 42, 70), 1050);
        alignRight($dest_img, number_format($menhgia).' VND', 'font/Vietinbank/SVN-Gilroy XBold.otf', 30, imagecolorallocate($dest_img, 4, 88, 146), 1190);
        alignRight($dest_img, convert_number_to_words($menhgia), 'font/Vietinbank/SVN-Gilroy XBold.otf', 30, imagecolorallocate($dest_img, 4, 88, 146), 1250);
        alignRight($dest_img, $phick, 'font/Vietinbank/SVN-Gilroy Medium.otf', 30, imagecolorallocate($dest_img, 13, 42, 70), 1350);
        alignRight($dest_img, $nd, 'font/Vietinbank/SVN-Gilroy Medium.otf', 30, imagecolorallocate($dest_img, 13, 42, 70), 1445);
        ob_start();
        imagejpeg($dest_img);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        echo $base64;
        imagedestroy($dest_img);
        
} else {
    http_response_code(405);
    echo 'ERROR CONTACT TO TRONGTHAO';
}
?>
