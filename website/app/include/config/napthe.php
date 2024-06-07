<?php
$url = 'https://thesieure.com/chargingws/v2';
$partner_id = '2191462361';
$sign = '011d60999b32815b300b4f791259f1ef';


        function creatSign($partner_key, $params)
    {
        $data = array();
        $data['request_id'] = $params['request_id'];
        $data['code'] = $params['code'];
        $data['partner_id'] = $params['partner_id'];
        $data['serial'] = $params['serial'];
        $data['telco'] = $params['telco'];
        $data['command'] = $params['command'];
        ksort($data);
        $sign = $partner_key;
        foreach ($data as $item) {
            $sign .= $item;
        }

		//return $sign;

        return md5($sign);
    }

?>
