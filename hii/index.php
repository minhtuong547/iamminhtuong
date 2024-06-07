<?php
// Thông tin bot Telegram
$botToken = "6984012778:AAEhira9TdG_PikjqkUqeB7uu1XR8vTC2W8"; // Đặt token của bot của bạn ở đây
$chatID = "6399418466"; // Đặt chat ID của admin ở đây

// Nội dung thông báo
$message = "Có thông báo mới từ trang web của bạn.";

// Tạo URL để gửi thông báo
$apiUrl = "https://api.telegram.org/bot{$botToken}/sendMessage";
$params = [
    'chat_id' => $chatID,
    'text' => $message,
];

// Sử dụng cURL để gửi request
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Thực hiện request và nhận kết quả
$response = curl_exec($ch);
curl_close($ch);

// Hiển thị kết quả
echo "Thông báo đã được gửi đến admin.";
?>
