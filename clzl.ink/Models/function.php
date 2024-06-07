<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
$base_url = 'https://' . $_SERVER['SERVER_NAME'] . '/';
function BASE_URL($url)
{
    global $_DOMAIN;
    return $_DOMAIN . $url;
}

function encrypt($string, $key1, $key2)
{
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $key1);
    $iv = substr(hash('sha256', $key2), 0, 16); // sha256 is hash_hmac_algo
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
    return $output;
}
function decrypt($string, $key1, $key2)
{
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $key1);
    $iv = substr(hash('sha256', $key2), 0, 16); // sha256 is hash_hmac_algo
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}

function soicoder_enc($string)
{
    return encrypt($string, LICENSE, ENCRYT);
}

function soicoder_dec($string)
{
    return decrypt($string, LICENSE, ENCRYT);
}

function zalopay_enc($string)
{
    return encrypt($string, LICENSE, ENCRYT_ZALOPAY);
}

function zalopay_dec($string)
{
    return decrypt($string, LICENSE, ENCRYT_ZALOPAY);
}

function change_phone($phone)
{
    $list_old = array(
        '0162',
        '0163',
        '0164',
        '0165',
        '0166',
        '0167',
        '0168',
        '0169',
        '0120',
        '0121',
        '0122',
        '0126',
        '0128',
        '0123',
        '0124',
        '0125',
        '0127',
        '0129',
        '0186',
        '0188',
        '0199'
    );
    $list_new = array(
        '032',
        '033',
        '034',
        '035',
        '036',
        '037',
        '038',
        '039',
        '070',
        '079',
        '077',
        '076',
        '078',
        '083',
        '084',
        '085',
        '081',
        '082',
        '056',
        '058',
        '059'
    );
    if (strlen($phone) == 10) {
        $head = substr($phone, 0, 3);
        return str_replace($list_new, $list_old, $head) . substr($phone, 3, 10);
    } else if (strlen($phone) == 11) {
        $head = substr($phone, 0, 4);
        return str_replace($list_old, $list_new, $head) . substr($phone, 4, 11);
    } else {
        return $phone;
    }
}

function REQUEST($url)
{
    $data = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HEADER => FALSE,
        CURLOPT_FOLLOWLOCATION => TRUE,
        CURLOPT_ENCODING => '',
        CURLOPT_USERAGENT => $_SESSION['useragent'],
        CURLOPT_AUTOREFERER => TRUE,
        CURLOPT_CONNECTTIMEOUT => 15,
        CURLOPT_TIMEOUT => 15,
        CURLOPT_MAXREDIRS => 5,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_SSL_VERIFYPEER => 0
    );
    $ch = curl_init();
    curl_setopt_array($ch, $data);
    $access = curl_exec($ch);
    return $access;
}


function api_token()
{
    $headers = array();
    foreach ($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    return $headers['Api-Token'];
}
function curl_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);

    curl_close($ch);
    return $data;
}


function BASE_($url)
{
    global $base_url;
    return $base_url . $url;
}

function format_cash($price)
{
    return str_replace(",", ".", number_format($price));
}

function gettime()
{
    return date('Y-m-d H:i:s');
}

function so_nguyen($price)
{
    return str_replace(",", "", number_format($price));
}

function alert($content = null, $navi = null, $time) {
    echo '<script type="text/javascript">alert("'.$content.'");setTimeout(function(){ location.href = "'.$navi.'" },'.$time.');</script>';
}

function navi_js($navi = null, $time) {
    echo '<script type="text/javascript">setTimeout(function(){ location.href = "'.$navi.'" },'.$time.');</script>';
}


function reset_cookie () {
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, null, time()-1000);
            setcookie($name, null, time()-1000, '/');
        }
    }
}
function randomColor()
{
    $str = '#';
    for ($i = 0; $i < 6; $i++) {
        $randNum = rand(0, 15);
        switch ($randNum) {
            case 10:
                $randNum = 'A';
                break;
            case 11:
                $randNum = 'B';
                break;
            case 12:
                $randNum = 'C';
                break;
            case 13:
                $randNum = 'D';
                break;
            case 14:
                $randNum = 'E';
                break;
            case 15:
                $randNum = 'F';
                break;
        }
        $str .= $randNum;
    }
    return $str;
}


function check_string($data)
{
    return (trim(htmlspecialchars(addslashes($data))));
}
function TypePassword($string)
{
    return md5($string);
}
function getFinishNgay($subday)
{

    $ngay  = getStartNgay($subday) + 86399;

    return $ngay;
}
function getStartNgay($subday)
{

    $ngay  = strtotime(date('Y-m-d', strtotime('-' . $subday . ' days', time())));
    return $ngay;
}


function getNgayDauThang($thang)
{
    if ($thang) {
        $ngaydaucuathang = strtotime('first day of -' . $thang . ' month', getStartNgay(0));
    } else {
        $ngaydaucuathang = strtotime('first day of this month', getStartNgay(0));
    }
    return $ngaydaucuathang;
}
function getNgayCuoiThang($thang)
{
    if ($thang) {
        $ngaycuoicuathang = strtotime('last day of -' . $thang . ' month', getFinishNgay(0));
    } else {
        $ngaycuoicuathang = strtotime('last day of this month', getFinishNgay(0));
    }
    return $ngaycuoicuathang;
}
function format_money($number)
{
    return number_format($number);
}
function getStartAndEndDate()
{
    global $year;
    $date = date('Y-m-d');
    while (date('w', strtotime($date)) != 1) {
        $tmp = strtotime('-1 day', strtotime($date));
        $date = date('Y-m-d', $tmp);
    }
    $week = date('W', strtotime($date));

    $week_start = new DateTime();
    $week_start->setISODate($year, $week);
    $return[0] = $week_start->format('d-M-Y');
    $time = strtotime($return[0], time());
    $time += 6 * 24 * 3600;
    $return[1] = date('d-M-Y', $time);
    return $return;
}

function getTimeStartTuan()
{
    $ngay  = strtotime(getStartAndEndDate()[0]);
    return $ngay;
}
function getTimeEndTuan()
{

    $ngay  = strtotime(getStartAndEndDate()[1]);
    return $ngay;
}
function getStartTuan($tuan)
{

    if ($tuan == 1) {
        $day = 1;
    } else if ($tuan == 2) {
        $day = 8;
    } else if ($tuan == 3) {
        $day = 15;
    } else if ($tuan == 4) {
        $day = 21;
    } else if ($tuan == 5) {
        $day = 28;
    }
    return $day;
}





///tính hiệu
function subDigitsOfNumber($n)
{
    $DEC_10 = 10;
    $total = $n % $DEC_10;
    $n = floor($n / $DEC_10);
    do {
        $total = ($n % $DEC_10) - $total;
        $n = floor($n / $DEC_10);
    } while ($n > 0);
    return $total;
}

function totalDigitsOfNumber($n)
{
    $DEC_10 = 10;
    $total = 0;
    do {
        $total = $total + ($n % $DEC_10);
        $n = floor($n / $DEC_10);
    } while ($n > 0);
    return $total;
}

function base64UrlEncode($text)
{
    return str_replace(
        ['+', '/', '='],
        ['-', '_', ''],
        base64_encode($text)
    );
}

function createToken()
{
    $secret = "SWdw46oeBRnvrkFhX2AaPIuicm35Mq19gKEQzbJCVLYf";
    $header = json_encode([
        'typ' => 'JWT',
        'alg' => 'HS256'
    ]);

    $payload = json_encode([
        'user_id' => 1,
        'role' => 'admin',
        'exp' => time()
    ]);
    $base64UrlHeader = base64UrlEncode($header);
    $base64UrlPayload = base64UrlEncode($payload);
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
    $base64UrlSignature = base64UrlEncode($signature);
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    return $jwt;
}
function random($string, $int)
{
    $chars = $string;
    $data = substr(str_shuffle($chars), 0, $int);
    return $data;
}
function curl($url = null, $param = array(), $header = [], $userA = NULL)
{
    if (!empty($url)) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $userA);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        if (count($param) > 0) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
        }
        if (curl_errno($ch)) {
            $res = "Lỗi: " . curl_error($ch);
        } else {
            $res = curl_exec($ch);
        }

        curl_close($ch);
        return $res;
    }
}

function text($string, $separator = ', ')
{
    $vals = explode($separator, $string);
    foreach ($vals as $key => $val) {
        $vals[$key] = strtolower(trim($val));
    }
    return array_diff($vals, array(""));
}
//anti_xss
function anti_xss($text)
{
    return htmlspecialchars(strip_tags($text));
}
// $_GET 
function GET($key)
{
    return isset($_GET[$key]) ? $_GET[$key] : false;
}
// $_POST
function POST($key)
{
    return isset($_POST[$key]) ? $_POST[$key] : false;
}

// gọn hơn :v
function load_url($url = "")
{
    header('Location: ' . $url . '');
    exit();
}
// xác nhận người dùng
function is_client()
{
    $username = isset($_SESSION["user"]) ? $_SESSION["user"] : false;
    if ($username) {
        return true;
    }
    return false;
}

//bb code
function bbcode($text)
{
    $find = array(

        '~\[b\](.*?)\[/b\]~s',

        '~\[p\](.*?)\[/p\]~s',

        '~\[i\](.*?)\[/i\]~s',

        '~\[u\](.*?)\[/u\]~s',

        '~\[quote\](.*?)\[/quote\]~s',

        '~\[size=(.*?)\](.*?)\[/size\]~s',

        '~\[color=(.*?)\](.*?)\[/color\]~s',

        '~\[url=(.*?)\](.*?)\[/url\]~s',

        '~\[img=(.*?)\](.*?)\[/img\]~s'

    );
    $replace = array(

        '<b>$1</b>',

        '<p>$1</p>',

        '<i>$1</i>',

        '<span style="text-decoration:underline;">$1</span>',

        '<pre>$1</' . 'pre>',

        '<span style="font-size:$1px;">$2</span>',

        '<span style="color:$1;">$2</span>',

        '<a href="$1">$2</a>',

        '<img src="$1" alt="$2" />'

    );
    return preg_replace($find, $replace, $text);
}
function junoo_boc($data)
{
    $text = html_entity_decode(trim(strip_tags($data)), ENT_QUOTES, 'UTF-8');
    $text = str_replace(" ", "", $text);
    $text = str_replace("/", "", $text);
    $text = str_replace("{", "", $text);
    $text = str_replace("}", "", $text);
    $text = str_replace("\\", "", $text);
    $text = str_replace(":", "", $text);
    $text = str_replace("\"", "", $text);
    $text = str_replace("'", "", $text);
    $text = str_replace("<", "", $text);
    $text = str_replace(">", "", $text);
    $text = str_replace("?", "", $text);
    $text = str_replace(";", "", $text);
    $text = str_replace(",", "", $text);
    $text = str_replace("[", "", $text);
    $text = str_replace("]", "", $text);
    $text = str_replace("(", "", $text);
    $text = str_replace(")", "", $text);
    $text = str_replace("*", "", $text);
    $text = str_replace("!", "", $text);
    $text = str_replace("$", "", $text);
    $text = str_replace("&", "", $text);
    $text = str_replace("%", "", $text);
    $text = str_replace("#", "", $text);
    $text = str_replace("^", "", $text);
    $text = str_replace("=", "", $text);
    $text = str_replace("+", "", $text);
    $text = str_replace("~", "", $text);
    $text = str_replace("`", "", $text);
    $text = str_replace("-", "", $text);
    $text = str_replace("|", "", $text);
    $text = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $text);
    $text = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $text);

    $text = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $text);

    $text = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $text);

    $text = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $text);
    $text = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $text);

    $text = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $text);
    $text = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $text);

    $text = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $text);
    $text = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $text);

    $text = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $text);
    $text = preg_replace("/(đ)/", 'd', $text);
    $text = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $text);
    $text = preg_replace("/(đ)/", 'd', $text);

    $text = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $text);
    $text = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $text);

    $text = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $text);
    $text = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $text);

    $text = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $text);
    $text = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $text);

    $text = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $text);
    $text = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $text);

    $text = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $text);
    $text = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $text);

    $text = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $text);
    $text = preg_replace("/(Đ)/", 'D', $text);

    $text = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $text);
    $text = preg_replace("/(Đ)/", 'D', $text);

    $text = strtolower($text);
    return $text;
}

// bỏ dấu
function bodau2($strTitle)
{
    $strTitle = strtolower($strTitle);
    $strTitle = trim($strTitle);
    $strTitle = str_replace(' ', '-', $strTitle);
    $strTitle = preg_replace("/(!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~)/", '-', $strTitle);
    $strTitle = preg_replace("/(ò|ó|ọ|ỏ|õ|ơ|ờ|ớ|ợ|ở|ỡ|ô|ồ|ố|ộ|ổ|ỗ)/", 'o', $strTitle);
    $strTitle = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|Ô|Ố|Ổ|Ộ|Ồ|Ỗ)/", 'o', $strTitle);
    $strTitle = preg_replace("/(à|á|ạ|ả|ã|ă|ằ|ắ|ặ|ẳ|ẵ|â|ầ|ấ|ậ|ẩ|ẫ)/", 'a', $strTitle);
    $strTitle = preg_replace("/(À|Á|Ạ|Ả|Ã|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|Â|Ấ|Ầ|Ậ|Ẩ|Ẫ)/", 'a', $strTitle);
    $strTitle = preg_replace("/(ề|ế|ệ|ể|ê|ễ|é|è|ẻ|ẽ|ẹ)/", 'e', $strTitle);
    $strTitle = preg_replace("/(Ể|Ế|Ệ|Ể|Ê|Ễ|É|È|Ẻ|Ẽ|Ẹ)/", 'e', $strTitle);
    $strTitle = preg_replace("/(ừ|ứ|ự|ử|ư|ữ|ù|ú|ụ|ủ|ũ)/", 'u', $strTitle);
    $strTitle = preg_replace("/(Ừ|Ứ|Ự|Ử|Ư|Ữ|Ù|Ú|Ụ|Ủ|Ũ)/", 'u', $strTitle);
    $strTitle = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $strTitle);
    $strTitle = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $strTitle);
    $strTitle = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $strTitle);
    $strTitle = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $strTitle);
    $strTitle = preg_replace('/(đ|Đ)/', 'd', $strTitle);
    $strTitle = preg_replace("/(^\-+|\-+$)/", '', $strTitle);
    return $strTitle;
}

function bodau($str)
{
    $str = preg_replace('/[\s]+/mu', ' ', $str);
    $unicode = array(

        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

        'd' => 'đ',

        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

        'i' => 'í|ì|ỉ|ĩ|ị',

        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',

        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

        'D' => 'Đ',

        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',

        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

    );

    foreach ($unicode as $nonUnicode => $uni) {
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    $str = str_replace(' ', '-', $str);
    return $str;
}

function time_ago($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'năm',
        'm' => 'tháng',
        'w' => 'tuần',
        'd' => 'ngày',
        'h' => 'giờ',
        'i' => 'phút',
        's' => 'giây',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' trước' : 'Bây giờ';
}


function time_stamp($time)
{
    $periods = array("giây", "phút", "giờ", "ngày", "tuần", "tháng", "năm", "thập kỉ");
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
    $now = time();
    $difference = $now - $time;
    $tense = "trước";
    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }
    $difference = round($difference);
    return "Cách đây $difference $periods[$j]";
}


// func time ago
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'năm',
        'm' => 'tháng',
        'w' => 'tuần',
        'd' => 'ngày',
        'h' => 'giờ',
        'i' => 'phút',
        's' => 'giây',
    );


    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' trước' : 'vừa xong';
}
// time left

function time_left($from, $to = '')
{
    if (empty($to))
        $to = time();
    $diff = (int) abs($to - $from);
    if ($diff <= 60) {
        $since = sprintf('Còn vài giây');
    } elseif ($diff <= 3600) {
        $mins = round($diff / 60);
        if ($mins <= 1) {
            $mins = 1;
        }
        /* translators: min=minute */
        $since = sprintf('Còn %s phút', $mins);
    } else if (($diff <= 86400) && ($diff > 3600)) {
        $hours = round($diff / 3600);
        if ($hours <= 1) {
            $hours = 1;
        }
        $since = sprintf('Còn %s giờ', $hours);
    } elseif ($diff >= 86400) {
        $days = round($diff / 86400);
        if ($days <= 1) {
            $days = 1;
        }
        $since = sprintf('Còn %s ngày', $days);
    }
    return $since;
}


function in_array_r($needle, $haystack, $strict = false)
{
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}
