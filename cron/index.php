<?php

function check_websites_status($urls) {
    foreach ($urls as $url) {
        $headers = @get_headers($url);

        if ($headers && strpos($headers[0], '200') !== false) {
            echo "Website $url hoạt động bình thường.\n";
        } else {
            echo "Không thể kết nối đến website $url hoặc có vấn đề khác.\n";
        }
    }
}

// Thay thế các địa chỉ URL bên dưới bằng danh sách các trang web bạn muốn kiểm tra.
$websites = array(
    "https://cron.sieutuoiteen.com/phn_dev/cronnow.php?code=1",
    "https://cron.sieutuoiteen.com/phn_dev/vcb.php",
    "https://cron.sieutuoiteen.com/phn_dev/cronnow.php?code=2",
    "https://cron.sieutuoiteen.com/phn_dev/cronnow.php?code=3",
    "https://cron.sieutuoiteen.com/phn_dev/cronnow.php?code=4",
    "https://cron.sieutuoiteen.com/phn_dev/cronnow.php?code=5",
    "https://cron.sieutuoiteen.com/phn_dev/cronnow.php?code=6"

);

check_websites_status($websites);

?>
