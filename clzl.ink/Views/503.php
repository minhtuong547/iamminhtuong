
<!doctype html>
<html lang="en">
<head>
  
    <!-- <base href="https://<?=$_SERVER['SERVER_NAME'];?>"> -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="<?= $settings['description']; ?>">
    <meta name="keywords" content="<?= $settings['description']; ?>">
    <meta property="og:description" content="<?= $settings['description']; ?>">
    <meta property="og:image" content="https://simg.zalopay.com.vn/zlp-website/assets/ktm_banner_web_min_aee416c195.png">
    <link rel="shortcut icon" href="<?= $settings['favion']; ?>" type="image/x-icon">
    <title><?= $settings['nameweb']; ?> - Hệ Thống Mini Game Chẳn Lẻ ZaloPay Uy Tín - Tự Động</title>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/js/all.min.js"
      integrity="sha512-Cvxz1E4gCrYKQfz6Ne+VoDiiLrbFBvc6BPh4iyKo2/ICdIodfgc5Q9cBjRivfQNUXBCEnQWcEInSXsvlNHY/ZQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <link rel="stylesheet" href="/templates/css/app.css">
    <link rel="stylesheet" href="/templates/css/cutom.css">
    <link rel="stylesheet" href="/templates/plugins/notify/css/jquery.growl.css">
    <link rel="stylesheet" href="/templates/css/richtext.css">
    <link rel="stylesheet" href="/templates/plugins/select2/select2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>
<style>
    .login-img {
    background: url(https://i.imgur.com/QtYp1JV.jpg);
    height: 100%;
    width: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    display: inline-table;
}
</style>
<body>
    <div class="login-img">
    
        <div id="global-loader"></div>
        <div class="page h-100">
            <div class="page-content error-page">
                <div class="container text-center">
                    <div class="error-template">
                        <h4 class=" text-white mb-5"><?= $settings['maintenance_content']; ?></h4>
                        <!-- <div class="mb-3 error-details text-transparent">Web sẽ mở cửa vào 19h tối nay</div> -->
                    </div>
                    
                </div>
                <div class="text-center mb-3">
                        <a target="_blank" href="<?= $settings['tele']; ?>" class="badge badge-primary p-2"><i
                                class="fa fa-users" aria-hidden="true"></i>Liên Hệ Support</a>
                        <a target="_blank" href="<?= $settings['box_tele']; ?>"
                            class="badge badge-info p-2"><i class="fa fa-users"
                                aria-hidden="true"></i>Box Giao Lưu Trao Đổi</a>
                    </div>
            </div>
        </div>
    </div>
</body>
<script src="/templates/js/vendors/jquery-3.2.1.min.js"></script>
<script src="/templates/js/vendors/popper.min.js"></script>
<script src="/templates/js/vendors/bootstrap.min.js"></script>
<script src="/templates/js/vendors/jquery.sparkline.min.js"></script>
<script src="/templates/js/sticky.js"></script>
<script src="/templates/js/clipboard.js"></script>
<script src="/templates/js/jquery.mousewheel.min.js"></script>
<script src="/templates/plugins/notify/js/rainbow.js"></script>
<script src="/templates/plugins/notify/js/jquery.growl.js"></script>
<script src="/templates/js/jquery.richtext.js"></script>
<script src="/templates/plugins/select2/select2.full.min.js"></script>
<script src="/templates/plugins/datatable/jquery.dataTables.min.js"></script>
<script src="/templates/plugins/datatable/dataTables.bootstrap4.min.js"></script>
<script src="/templates/plugins/pusher/pusher.min.js"></script>
<script src="/templates/js/app.js"></script>