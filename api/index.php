<?php

// Thay đổi các giá trị này bằng thông tin của bot Telegram của bạn
$botToken = '6664613655:AAEyWPrUbUhDtj-CIisz35hxrcWjo_TPVkU';
$chatId = '6399418466';

// URL của API
$apiUrl = 'https://api.x10.mx/api/gpt-v2.php';

// Hàm này để gửi yêu cầu GET đến API và nhận dữ liệu
function fetchDataFromAPI($question) {
    global $apiUrl;
    $question = urlencode($question);
    $fullUrl = $apiUrl . '?question=' . $question;
    $response = file_get_contents($fullUrl);
    return json_decode($response, true);
}

// Nhận nội dung tin nhắn từ người dùng
$update = json_decode(file_get_contents('php://input'), true);

// Kiểm tra xem có dữ liệu tin nhắn không
if (isset($update['message'])) {
    $message = $update['message'];
    $text = $message['text'];

    // Kiểm tra xem tin nhắn có chứa lệnh /ask không
    if (strpos($text, '/ask') === 0) {
        // Tách câu hỏi từ sau dấu '='
        $question = trim(substr($text, strpos($text, '=') + 1));

        // Kiểm tra xem có câu hỏi hay không
        if (!empty($question)) {
            // Gửi yêu cầu đến API để lấy dữ liệu dựa trên câu hỏi từ người dùng
            $apiResponse = fetchDataFromAPI($question);

            // Kiểm tra xem dữ liệu có được trả về thành công không
            if ($apiResponse && isset($apiResponse['success']) && $apiResponse['success']) {
                // Lấy dữ liệu từ phản hồi của API
                $responseData = $apiResponse['data'];
                $responseText = "Dữ liệu từ trang web của bạn: $responseData";
            } else {
                // Xử lý khi không thể lấy dữ liệu từ API
                $responseText = "Xin lỗi, không thể lấy dữ liệu từ trang web của bạn vào lúc này.";
            }
        } else {
            // Xử lý khi không có câu hỏi
            $responseText = "Xin lỗi, không tìm thấy câu hỏi trong tin nhắn của bạn.";
        }

        // Gửi tin nhắn đến người dùng
        file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($responseText));
    }
}
