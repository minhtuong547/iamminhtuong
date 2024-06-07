// Hàm hiển thị thông báo từ bot
function showNotification() {
    // Thực hiện AJAX để gửi yêu cầu thông báo từ bot
    $.ajax({
        url: 'bot.php',
        type: 'GET',
        success: function(response) {
            console.log('Notification sent successfully:', response);
        },
        error: function(error) {
            console.error('Error sending notification:', error);
        }
    });
}

// Hàm yêu cầu chụp hình
function requestCapture() {
    // Hiển thị hộp thoại yêu cầu người dùng cho phép chụp hình
    if (confirm("Có phải bạn muốn chụp hình và gửi ảnh về Telegram không?")) {
        // Nếu người dùng đồng ý, thực hiện chụp hình và gửi thông tin về server PHP
        captureAndSendPhoto();
    } else {
        // Xử lý khi người dùng không đồng ý
    }
}

// Hàm chụp hình và gửi thông tin về server PHP
function captureAndSendPhoto() {
    // Sử dụng API hình ảnh của trình duyệt hoặc thư viện hỗ trợ để chụp hình
    // Sau đó, gửi ảnh về server PHP để xử lý và gửi đến Telegram
    // Việc này có thể thực hiện thông qua XMLHttpRequest hoặc fetch API
    // Ví dụ: sử dụng fetch API
    fetch('captureAndSend.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({}),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Server response:', data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
