<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php';
// check đường dẫn
if (strpos($_SERVER['REQUEST_URI'], '/'.config_admin.'/') !== 0 || strpos($_SERVER['REQUEST_URI'], '.php') !== false) {
    require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/404.php';
    die;
} 
?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Mini game giải trí chẵn lẻ Momo uy tín và hệ thống thanh toán tự động trong 30s">
    <meta name="keywords" content="clmm, chanlemomo 1k, chanlemomo 5k, chanle, chan le momo, chẵn lẻ momo 1k, chanlemomo, chẵn lẻ momo 5k, chẵn lẻ tài xỉu momo, tài xỉu momo, chẵn lẻ momo uy tín, chẵn lẻ momo, clmm 1k, chẵn lẻ momo 10k, web chẵn lẻ momo 1k, đánh chẵn lẻ momo, làm web chẵn lẻ momo, chan le momo, cltx momo, mimigame momo, chẵn lẻ momo, clm, chan le momo, clmm, clmmme, chẵn lẻ momo, chẵn lẻ uy tín, kiemmomo, vanmaynet, kiemmomocom, chẵn lẻ tự động, chan le no hu, game chan le, chan le vi momo, momo tu dong">
    <meta property="og:description" content="Mini game giải trí chẵn lẻ Momo uy tín và hệ thống thanh toán tự động trong 30s">
    <meta property="og:image" content="https://file.coin98.com/insights/Vi%CC%81-MOMO.jpg">
    <link rel="shortcut icon" href="../templates/img/logo.png" type="image/x-icon">
    <title>Quản Trị Hệ Thống - Hệ Thống Mini Game Chẳn Lẻ Momo Uy Tín - Tự Động</title>
    <link rel="stylesheet" href="../templates/css/app.css">
    <link rel="stylesheet" href="../templates/plugins/notify/css/jquery.growl.css">
    <link rel="stylesheet" href="../templates/css/richtext.css">
    <link rel="stylesheet" href="../templates/plugins/select2/select2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <div class="page-single">
            <div class="container">
                <div class="row authentication">
                    <div class="col-lg-5 col-xl-4 col-md-6 d-block col-login mx-auto">
                        <center>
                            <a class="header-brand" href="#" style="color:#fff;font-weight:bold">
                                <i class="fab fa-opencart" style="font-size: 20px; color: white;"></i>
                                </a>
                        </center>
                        <div class="card">
                            <div class="card-body p-6 ">
                                <div class="card-title text-center">Đăng Nhập</div>
                                <form action="/api/admin/login" method="post">
                                <input type="hidden" name="path" value="<?=$_SERVER['REQUEST_URI'];?>">
                                    <div class="input-icon form-group wrap-input">
                                        <span class="input-icon-addon search-icon"> <i class="fas fa-user"></i></span>
                                        <input type="text" name="username" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="input-icon form-group wrap-input">
                                        <span class="input-icon-addon search-icon"> <i class="fas fa-key"></i> </span>
                                        <input type="password" name="password" class="form-control mb-0"
                                            placeholder="Password">
                                        <label class="form-label">
                                            <a href="#" class="float-right small">Quên mật khẩu ?</a>
                                        </label>
                                    </div>
                                    <div class="form-group mt-5">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked="true">
                                            <span class="custom-control-label">Ghi nhớ</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Đăng Nhập</button>
                                    </div>
                                </form>
                                <div class="flex-c-m text-center mt-5">
                                    <a href="#" class="login100-social-item bg1">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="login100-social-item bg2">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="login100-social-item bg3">
                                        <i class="fab fa-google-plus-g"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
<!-- <script type="text/javascript">
    $(document).ready(function () {
        $('form').submit(function (e) {
            e.preventDefault();
            let data = $('form').serialize();

            $.ajax({
                url: '',
                method: 'POST',
                dataType: 'json',
                data,
                beforeSend: () => {
                    $('form>div>button').prop('disabled', true);
                    $('form>div>button').html('Đang xử lý <i class="fas fa-spinner text-white fa-spin ml-2" aria-hidden="true"></i>');
                },
                success: (res) => {
                    $('form>div>button').prop('disabled', false);
                    $('form>div>button').html('Đăng Nhập');
                    !res.success ? $.growl.error({
                        title: "<center>Error!</center>",
                        message: `<center>${res.message}</center>`,
                    }) : $.growl.notice({
                        title: "<center>Success!</center>",
                        message: `<center>${res.message}</center>`,
                    }) && setTimeout(() => window.location.reload(), 1500);
                }
            })
        })
    })
</script> -->