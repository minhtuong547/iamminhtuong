<?php
include_once '_config.php';
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="vi" by="RangerLazzy">
<!--<script type="text/javascript" src="https://hocsinhthanhlich2020.info/js/tuyetroi.js"></script> -->

<head>
    <title>BÌNH CHỌN HỌC SINH - Chào mừng tới bình chọn học sinh thanh lịch 2020</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Chào mừng tới bình chọn học sinh thanh lịch năm 2020" />
    <meta name="description"
        content="TOP 8 HỌC SINH THANH LỊCH 2020 Poster chính thức của 8 gương mặt vào Vòng chung kết cuộc thi Học sinh Thanh lịch 2020 sẽ góp mặt trong Đêm Hội diễn TVG December Show 2020”." />
    <link rel="canonical" href="<?php echo $url;?>" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="/assets/img/main.jpg">
    <meta property="og:title" content="Học Sinh Thanh Lịch" />
    <meta property="og:description"
        content="TOP 8 HỌC SINH THANH LỊCH 2020 Poster chính thức của 8 gương mặt vào Vòng chung kết cuộc thi Học sinh Thanh lịch 2020 sẽ góp mặt trong Đêm Hội diễn TVG December Show 2020”." />
    <meta property="og:url" content="<?php echo $url;?>" />
    <meta property="og:site_name" content="Học Sinh Thanh Lịch" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description"
        content="TOP 8 HỌC SINH THANH LỊCH 2020 Poster chính thức của 8 gương mặt vào Vòng chung kết cuộc thi Học sinh Thanh lịch 2020 sẽ góp mặt trong Đêm Hội diễn TVG December Show 2020”." />
    <meta name="twitter:title" content="Học Sinh Thanh Lịch" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://lolstatic-a.akamaihd.net/awesomefonts/1.0.0/lol-fonts.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i&amp;subset=vietnamese" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <style>
    .card {
        border-radius: .25rem;
    }

    .bg-cover {
        border-radius: .25rem;
    }
    </style>
</head>

<body id="wrapped" class="home">
    <div class="loading" style="display: none;"></div>
    <header id="header">
        <div class="bg-black">
            <div class="container">
                <div class="d-xl-none mb-3 text-center logo">
                    <a href="#">
                        <img src="assets/img/logo-site.png?v=1" alt="logo" />
                    </a>
                </div>
                <nav class="menu mb-4 d-none d-xl-block text-uppercase">
                    <a href="#">
                        <img src="assets/img/logo-site.png?v=1" alt="logo" />
                    </a>
                    <a class="menu-item active" aria-current="page" href="/" rel="nofollow">Trang chủ</a>| <a
                        class="menu-item" href="/">Thể lệ</a>|
                    <a class="menu-item" href="/">Thông báo</a>|
                    <a class="menu-item" href="/">Sự kiện</a>|
                    <?php if(!isset($username)) {?>
                    <a class="menu-item" href="/<?php echo generateRandomString();?>N">Đăng Nhập</a>
                    <?php } else {?>
                    <a class="menu-item" href="logout.php">Đăng Xuất</a>
                    <?php } ?>
                </nav>
                <div class="d-xl-none">
                    <div class="nav-overlay d-none" id="menu-overlay"></div>
                    <nav class="menu sidenav text-center" id="menu-m">
                        <a href="#">
                            <img class="img-fluid mb-3" src="assets/img/logo-site.png?v=1" alt="logo" />
                        </a>
                        <a class="menu-item active" aria-current="page" href="/" rel="nofollow">Trang chủ</a>| <a
                            class="menu-item" href="/">Thể lệ</a>|
                        <a class="menu-item" href="/">Thông báo</a>|
                        <a class="menu-item" href="/">Sự kiện</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <main id="main" class="container text-center">
        <h1 class="title">
            <?php if(!isset($username)) {?>
            <span>BẢNG BÌNH CHỌN HỌC SINH THANH LỊCH</span>
            <?php } else { ?>
            <span>XIN CHÀO: <?php echo $username;?></span>
            <?php } ?>
        </h1>
        <div class="row font-weight-bold text-uppercase">
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card flex-column-reverse">
                    <div class="bg-cover" style="background-image: url(../assets/img/info/1.jpg);"></div>
                    <div class="position-absolute w-100 py-1 bg-dark-transparent gift-title">Lớp 12A1 | Lượt bình chọn :
                        978</p>
                    </div>
                    <button type="button" onclick="voted(1)" id="1" class="claim-reward btn"><i
                            class="fa fa-sort-down"></i>Vào Bình Chọn</button>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card flex-column-reverse">
                    <div class="bg-cover" style="background-image: url(../assets/img/info/2.png);"></div>
                    <div class="position-absolute w-100 py-1 bg-dark-transparent gift-title">Lớp 12A2 | Lượt bình chọn :
                        723</p>
                    </div>
                    <button type="button" onclick="voted(2)" id="2" class="claim-reward btn"><i
                            class="fa fa-sort-down"></i>Vào Bình Chọn</button>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card flex-column-reverse">
                    <div class="bg-cover" style="background-image: url(../assets/img/info/3.png);"></div>
                    <div class="position-absolute w-100 py-1 bg-dark-transparent gift-title">Lớp 12A3 Lượt bình chọn :
                        689</p>
                    </div>
                    <button type="button" onclick="voted(3)" id="3" class="claim-reward btn"><i
                            class="fa fa-sort-down"></i>Vào Bình Chọn</button>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card flex-column-reverse">
                    <div class="bg-cover" style="background-image: url(../assets/img/info/4.png);"></div>
                    <div class="position-absolute w-100 py-1 bg-dark-transparent gift-title">Lớp 12A4 Lượt bình chọn :
                        619</p>
                    </div>
                    <button type="button" onclick="voted(4)" id="4" class="claim-reward btn"><i
                            class="fa fa-sort-down"></i>Vào Bình Chọn</button>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card flex-column-reverse">
                    <div class="bg-cover" style="background-image: url(../assets/img/info/5.png);"></div>
                    <div class="position-absolute w-100 py-1 bg-dark-transparent gift-title">Lớp 12B1 Lượt bình chọn :
                        581</p>
                    </div>
                    <button type="button" onclick="voted(5)" id="5" class="claim-reward btn"><i
                            class="fa fa-sort-down"></i>Vào Bình Chọn</button>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card flex-column-reverse">
                    <div class="bg-cover" style="background-image: url(../assets/img/info/6.png);"></div>
                    <div class="position-absolute w-100 py-1 bg-dark-transparent gift-title">Lớp 12B2 Lượt bình chọn :
                        538</p>
                    </div>
                    <button type="button" onclick="voted(6)" id="6" class="claim-reward btn"><i
                            class="fa fa-sort-down"></i>Vào Bình Chọn</button>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card flex-column-reverse">
                    <div class="bg-cover" style="background-image: url(../assets/img/info/7.jpg);"></div>
                    <div class="position-absolute w-100 py-1 bg-dark-transparent gift-title">Lớp 12B3 Lượt bình chọn :
                        507</p>
                    </div>
                    <button type="button" onclick="voted(7)" id="7" class="claim-reward btn"><i
                            class="fa fa-sort-down"></i>Vào Bình Chọn</button>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card flex-column-reverse">
                    <div class="bg-cover" style="background-image: url(../assets/img/info/8.png);"></div>
                    <div class="position-absolute w-100 py-1 bg-dark-transparent gift-title">Lớp 12B4 Lượt bình chọn :
                        421</p>
                    </div>
                    <button type="button" onclick="voted(8)" id="8" class="claim-reward btn"><i
                            class="fa fa-sort-down"></i>Vào Bình Chọn</button>
                </div>
            </div>
        </div>
    </main>
    <footer id="footer" class="footer">
        <div class="container">
            <img class="w-100 mt-2 mb-4" src="" />
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="assets/js/sweetalert.min.js?v=2"></script>
    <script src="assets/js/script.js?v=3"></script>
    <script>
    function voted(id) {
        var login = '<?php if($username !== '' && isset($username)){ echo 1;} else { echo 0;}?>';
        if (login == 1) {
            if (id == '1') {
                var classed = '12A1';
                $("#" + id).html("<i class='fa fa-sort-down'></i> Lượt Bình Chọn: 979");
                $("#" + id).attr("disabled", "disabled");
            } else
            if (id == '2') {
                var classed = '12A2';
                $("#" + id).html("<i class='fa fa-sort-down'></i> Lượt Bình Chọn: 724");
                $("#" + id).attr("disabled", "disabled");
            } else
            if (id == '3') {
                var classed = '12A3';
                $("#" + id).html("<i class='fa fa-sort-down'></i> Lượt Bình Chọn: 690");
                $("#" + id).attr("disabled", "disabled");
            } else
            if (id == '4') {
                var classed = '12A4';
                $("#" + id).html("<i class='fa fa-sort-down'></i> Lượt Bình Chọn: 620");
                $("#" + id).attr("disabled", "disabled");
            } else
            if (id == '5') {
                var classed = '12B1';
                $("#" + id).html("<i class='fa fa-sort-down'></i> Lượt Bình Chọn: 582");
                $("#" + id).attr("disabled", "disabled");
            } else
            if (id == '6') {
                var classed = '12B2';
                $("#" + id).html("<i class='fa fa-sort-down'></i> Lượt Bình Chọn: 539");
                $("#" + id).attr("disabled", "disabled");
            } else
            if (id == '7') {
                var classed = '12B3';
                $("#" + id).html("<i class='fa fa-sort-down'></i> Lượt Bình Chọn: 508");
                $("#" + id).attr("disabled", "disabled");
            } else
            if (id == '8') {
                var classed = '12B4';
                $("#" + id).html("<i class='fa fa-sort-down'></i> Lượt Bình Chọn: 422");
                $("#" + id).attr("disabled", "disabled");
            }
            swal({
                title: 'Thông báo',
                text: `Bạn đã bình chọn thành công : Lớp ${classed}`,
                icon: 'success',
                buttons: {
                    OK: 'OK'
                },
                dangerMode: true,
                showLoaderOnConfirm: true
            })
        } else if (login == 0) {
            swal({
                    title: 'Thông báo',
                    text: 'Vui lòng đăng nhập Facebook để tính lượt bình chọn',
                    icon: 'error',
                    buttons: {
                        cancel: 'Đóng',
                        confirm: {
                            text: 'Đăng nhập',
                            closeModal: false
                        }
                    },
                    dangerMode: true,
                    showLoaderOnConfirm: true
                })
                .then((confirm) => {
                    if (confirm) {
                        location.href = '<?php echo generateRandomString();?>N'
                    } else {}
                })
        }
    }
    </script>
</body>

</html>