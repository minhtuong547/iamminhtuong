<?php session_start(); ?>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/connect.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Models/head_request_admin.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Controllers/zalopay/zalopay.php');
$type_login = $soicoder->real_escape_string(check_string($_POST['type_login']));
$phone = $soicoder->real_escape_string(check_string($_POST['phone']));
$password = $soicoder->real_escape_string(check_string($_POST['password']));
if (strlen($phone) == 10) {
    $zalopay = new Zalopay($soicoder);
    if ($settings['type_login'] == 'app') {
        $otp = $soicoder->real_escape_string(check_string($_POST['otp']));
        $select = $soicoder->num_rows("SELECT * FROM `zalopays` WHERE `phone` = '" . $phone . "' LIMIT 1 ");
        if ($select >= 1) {
            $loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '" . $phone . "' LIMIT 1 ", 1);
            if ($loadDATA['status'] == 'wait_no_otp') {
                $login = $zalopay->LoadData($loadDATA)->ZaloLogin2($password);
                if(!isset($login['error'])){
                    $soicoder->update("zalopays", array(
                        'reward'        => $phone,
                        'password'      => $password,
                        'access_token'  => $login['data']['access_token'],
                        'session_id'    => $login['data']['session_id'],
                        'zalo_id'       => $login['data']['zalo_id'],
                        'user_id'       => $login['data']['user_id'],
                        'profile_level' => $login['data']['profile_level'],
                        'status'        => 'success',
                        'min'           => "6000",
                        'max'           => "1000000",
                        'limit_day'     => "200",
                        'limit_month'   => "1000",
                        'errorDesc'     => 'Thành Công',
                        'time_login'    => time(),
                        'pay'           => 'off'
                    ), "`phone` = '$phone' ");
                    // update số dư
                    $loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '" . $phone . "' LIMIT 1 ", 1);
                    $get_balance = json_decode($zalopay->LoadData($loadDATA)->getBalance(), true);
                    // get maccesstoken
                    $get = $zalopay->LoadData($loadDATA)->getlistmerchantuserinfo();
                    $maccesstoken = $get['listmerchantuserinfo'][0]['maccesstoken'];
                    $mappuser = $get['listmerchantuserinfo'][0]['muid'];
                    $soicoder->update("zalopays", array(
                        'balance' => $get_balance['data']['balance'],
                        'maccesstoken' => $maccesstoken,
                        'mappuser' => $mappuser
                    ), "`phone` = '$phone' ");
                    echo "<script language='javascript'>alert('Login Thành Công');window.location='/".config_admin."/zalopay';</script>";
                    die;
                } else {
                    echo "<script language='javascript'>alert('" . $login['error']['details']['localized_message']['message'] . "');window.location='/".config_admin."/zalopay';</script>";
                    die;
                }
            } else {
                $xacminh = $zalopay->LoadData($loadDATA)->xac_thuc_otp($otp);
                // print_r($xacminh);
                if(isset($xacminh['data']['phone_verified_token'])) {
                    $phone_verified_token = $xacminh['data']['phone_verified_token'];
                    $login = $zalopay->ZaloLogin($password, $phone_verified_token);
                    if(!isset($login['error'])){
                        $soicoder->update("zalopays", array(
                            'reward'        => $phone,
                            'password'      => $password,
                            'access_token'  => $login['data']['access_token'],
                            'session_id'    => $login['data']['session_id'],
                            'zalo_id'       => $login['data']['zalo_id'],
                            'user_id'       => $login['data']['user_id'],
                            'profile_level' => $login['data']['profile_level'],
                            'status'        => 'success',
                            'min'           => "6000",
                            'max'           => "1000000",
                            'limit_day'     => "200",
                            'limit_month'   => "1000",
                            'errorDesc'     => 'Thành Công',
                            'time_login'    => time(),
                            'pay'           => 'off'
                        ), "`phone` = '$phone' ");
                        // update số dư
                        $loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '" . $phone . "' LIMIT 1 ", 1);
                        $get_balance = json_decode($zalopay->LoadData($loadDATA)->getBalance(), true);
                        // get maccesstoken
                        $get = $zalopay->LoadData($loadDATA)->getlistmerchantuserinfo();
                        $maccesstoken = $get['listmerchantuserinfo'][0]['maccesstoken'];
                        $mappuser = $get['listmerchantuserinfo'][0]['muid'];
                        $soicoder->update("zalopays", array(
                            'balance' => $get_balance['data']['balance'],
                            'maccesstoken' => $maccesstoken,
                            'mappuser' => $mappuser
                        ), "`phone` = '$phone' ");
                        echo "<script language='javascript'>alert('Login Thành Công');window.location='/".config_admin."/zalopay';</script>";
                        die;
                    } else {
                        echo "<script language='javascript'>alert('" . $login['error']['details']['localized_message']['message'] . "');window.location='/".config_admin."/zalopay';</script>";
                        die;
                    }
                } else {
                    $soicoder->update("zalopays", array('status' => 'error', 'errorDesc' => "Otp Không Hợp Lệ"), "`phone` = '$phone' ");
                    echo "<script language='javascript'>alert('Otp Không Hợp Lệ');window.location='/".config_admin."/zalopay';</script>";
                    die;
                }
            }
        } else {
            echo "<script language='javascript'>alert('Vui Lòng Gửi Otp Trước');window.location='/".config_admin."/zalopay';</script>";
            die;
        }
    } else if ($settings['type_login'] == 'web') {
        $cookie = $soicoder->real_escape_string(check_string($_POST['cookie']));
        $select = $soicoder->num_rows("SELECT * FROM `zalopays` WHERE `phone` = '".$phone."' LIMIT 1 ");
        if ($select >= 1) {
            $soicoder->query("UPDATE `zalopays` SET
                `type_api` = 'web',
                `SECUREID` = 'underfined',
                `cookie` = '$cookie',
                `status` = 'pending'
                WHERE `phone` = '$phone'
            ");
        } else {
            $soicoder->insert('zalopays' , array (
                'phone' => $phone,
                'type_api' => 'web',
                'cookie' => $cookie,
                'status' => 'pending',
            ));
        }
        $loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '" . $phone . "' LIMIT 1 ", 1);
        $info = $zalopay->LoadData($loadDATA)->ZaloLogin_Cookie();
        if(!isset($info['error'])){
            $soicoder->update("zalopays", array(
                'reward'        => $phone,
                'password'      => $password,
                // 'access_token'  => $info['data']['access_token'],
                // 'session_id'    => $info['data']['session_id'],
                'name' => $info['data']['display_name'],
                "avatar" => $info['data']['avatar'],
                'zalo_id'       => $info['data']['zalo_id'],
                'user_id'       => $info['data']['zalopay_id'],
                'profile_level' => $info['data']['profile_level'],
                'status'        => 'success',
                'min'           => "6000",
                'max'           => "1000000",
                'limit_day'     => "200",
                'limit_month'   => "1000",
                'errorDesc'     => 'Thành Công',
                'time_login'    => time(),
                'pay'           => 'off'
            ), "`phone` = '$phone' ");
            // update số dư
            $loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '" . $phone . "' LIMIT 1 ", 1);


            $get_balance = ($loadDATA['type_api'] == 'app') ? json_decode($zalopay->LoadData($loadDATA)->getBalance(), true) : json_decode($zalopay->LoadData($loadDATA)->getBalance_web(), true);
            // get maccesstoken
            // $get = $zalopay->LoadData($loadDATA)->getlistmerchantuserinfo();
            // print_r($get);
            // $maccesstoken = $get['listmerchantuserinfo'][0]['maccesstoken'];
            // $mappuser = $get['listmerchantuserinfo'][0]['muid'];
            $soicoder->update("zalopays", array(
                'balance' => $get_balance['data']['balance'],
                // 'maccesstoken' => $maccesstoken,
                // 'mappuser' => $mappuser
            ), "`phone` = '$phone' ");
            echo "<script language='javascript'>alert('Login Thành Công');window.location='/".config_admin."/zalopay';</script>";
            die;
        } else {
            $soicoder->query("UPDATE `zalopays` SET
                `status` = 'error'
                'errorDesc' = 'Cookie Không Hợp Lệ'
                WHERE `phone` = '$phone'
            ");
            echo "<script language='javascript'>alert('Cookie Không Hợp Lệ');window.location='/".config_admin."/zalopay';</script>";
            die;
        }
        // print_r($info);
    } else {
        echo "<script language='javascript'>alert('Loại Login Không Hợp Lệ');window.location='/".config_admin."/zalopay';</script>";
        die;
    }
    
} else {
    echo "<script language='javascript'>alert('Vui Lòng Nhập Số Điện Thoại');window.location='/".config_admin."/zalopay';</script>";
}
