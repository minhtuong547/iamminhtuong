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
    <link rel="stylesheet" href="./templates/css/app.css">
    <link rel="stylesheet" href="./templates/css/cutom.css">
    <link rel="stylesheet" href="./templates/plugins/notify/css/jquery.growl.css">
    <link rel="stylesheet" href="./templates/css/richtext.css">
    <link rel="stylesheet" href="./templates/plugins/select2/select2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

<body>
    <style>
    .admin-navbar .nav-link {
        padding: 0.60rem 2.3rem !important;
    }
    </style>
    <div id="global-loader"></div>
    <div class="page">
        <div class="page-main">
            <div class="header">
                <div class="container">
                    <div class="d-flex">
                        <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse"
                            data-target="#headerMenuCollapse">
                            <span class="header-toggler-icon"></span>
                        </a>
                        <div class=""><img src="<?=$settings['logo'];?>" height="40px" alt="Logo" /></div>
                    </div>
                </div>
            </div>
            <div class="admin-navbar sticky" id="headerMenuCollapse">
                <div class="container">
                    <ul class="nav">
                        <li class="nav-item with-sub">
                            <a class="nav-link" href="../">
                                <i class="fas fa-home"></i>
                                <span>Trang Chủ</span>
                            </a>
                        </li>
                        <li class="nav-item with-sub">
                            <a class="nav-link scroll-to" href="#how_to_play"><i class="fa fa-gamepad"></i>
                                <span>Cách Chơi</span>
                            </a>
                        </li>
                        <li class="nav-item with-sub">
                            <a class="nav-link scroll-to" href="#history_win"><i class="fa fa-history"></i>
                                <span>Lịch Sử Thắng</span>
                            </a>
                        </li>
                        <li class="nav-item with-sub">
                            <a class="nav-link scroll-to" href="#check_transaction"><i class="fa fa-search"></i>
                                <span>Kiểm Tra Giao Dịch</span>
                            </a>
                        </li>
                        <?php if ($settings['top_status'] == 'on') { ?> 
                        <li class="nav-item with-sub">
                            <a class="nav-link scroll-to" href="#top_tuan"><i class="fa fa-trophy"></i>
                                <span>Đua TOP</span>
                            </a>
                        </li>
                        <?php }
                        if (TELE_ADMIN != '') {
                        ?>
                        <li class="nav-item with-sub">
                            <a class="nav-link scroll-to" href="https://t.me/<?=TELE_ADMIN;?>"><i class="fa fa-users"></i>
                                <span>Thuê Sever LH</span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <main class="container">
                <div class="mainbar"></div>

                <body class="" style="">
                    <marquee width="100%" behavior="scroll" style="display: block;
                 position: fixed;
                 bottom: 70 px;
                 left: 15 px;
                 z-index: 1000;
                 cursor: pointer;
                  width: 100%;">
                        <font color="white"
                            style="text-shadow: 0 0 0.2em #ff0000, 0 0 0.2em #ff0000,  0 0 0.2em #ff0000"><b>Chào mừng
                                các con vợ đến với <?=$_SERVER['SERVER_NAME'];?>. Các con vợ chỉ nên chơi ở website <?=$_SERVER['SERVER_NAME'];?> uy tín nhất
                                thị trường để tránh mất tiền oan. </b></font>
                        </font>
                    </marquee>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="content text-center">
                                <h2><b><?=$_SERVER['SERVER_NAME'];?></b> Đỉnh cao Minigame ZaloPay thanh toán nhanh chóng</h2>
                                <div class="row justify-content-center mb-3" id="list-game">
                                    <?php
                                $list = $soicoder->fetch_assoc("SELECT * FROM `game` WHERE `status` = 'on'", 0);
                                foreach ($list as $data) {
                                ?>
                                    <div style="padding: 5px">
                                        <button class="btn btn-primary games" data-name="<?=$data['name'];?>"
                                            data-description="<?=$data['description'];?>"
                                            data-type="<?=$data['game_code'];?>_Game"><b><?=$data['name'];?></b>
                                        </button>
                                    </div>
                                <?php } ?>
                                </div>
                                <div class="row justify-content-center">
                                    <!-- <div style="padding: 5px">
                                        <button class="btn btn-outline-danger" data-toggle="modal"
                                            data-target="#modalMuster"><b><i class="fas fa-user-crown"></i> Điểm
                                                Danh</b></button>
                                    </div> -->
                                    <?php
                                    if ($settings['dmiss_status'] == 'on') { ?>
                                    <div style="padding: 5px">
                                        <a class="btn btn-outline-danger scroll-to" href="#mission_day"><b><i
                                                    class="fas fa-tasks"></i> Nhiệm Vụ Ngày</b></a>
                                    </div>
                                    <?php } ?>
                                    <div style="padding: 5px">
                                        <button class="btn btn-outline-danger" data-toggle="modal"
                                            data-target="#modalNoti"><b><i class="fas fa-user-crown"></i> Thông
                                                báo</b></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <sections id="how_to_play">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="content h-100">
                                    <h3 id="gameName">Cách Chơi</h3>
                                    <div class="alert alert-warning" role="alert">
                                        <b>Chú ý 🔞:</b> Mini game chỉ dành cho người <b>trên 18 tuổi</b>.
                                    </div>
                                    <p>Chuyển tiền vào 1 trong các tài khoản ZaloPay sau:</p>
                                    <div class="table-responsive mb-3">
                                        <table
                                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                                            <thead class="badge-primary text-white">
                                                <tr>
                                                    <th class="text-white">Số điện thoại</th>
                                                    <th class="text-white">Tối thiểu</th>
                                                    <th class="text-white">Tối đa</th>
                                                    <th class="text-white">Trạng thái</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablePhone"></tbody>
                                        </table>
                                    </div>
                                    <p id="gameNoti"></p>
                                    <div class="table-responsive mb-3">
                                        <table
                                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                                            <thead class="badge-primary text-white">
                                                <tr>
                                                    <th class="text-white">Nội dung</th>
                                                    <th class="text-white">Kết quả</th>
                                                    <th class="text-white">Tỉ lệ</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableReward"></tbody>
                                        </table>
                                    </div>
                                    <div class="text-center mb-3">
                                        <div class="d-inline-flex align-items-center justify-content-center">
                                            <h5 class="mx-2 my-0"><span class="badge badge-success">Tiền thưởng</span>
                                            </h5>
                                            <b>=</b>
                                            <h5 class="mx-2 my-0"><span class="badge badge-secondary">Tiền đặt</span>
                                            </h5>
                                            <b>x</b>
                                            <h5 class="mx-2 my-0"><span class="badge badge-secondary">Tỉ lệ</span></h5>
                                        </div>
                                    </div>
                                    <div class="alert alert-success" role="alert">
                                        <p>Chỉ chuyển vào số tài khoản đang hiện trên web và có tình trạng là
                                            <span class="badge badge-success">Hoạt động</span>.
                                            Không chuyển vào số dùng để trả thưởng.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="content h-100">
                                    <h3>Lưu ý</h3>
                                    <div class="alert alert-warning" role="alert">
                                        <div>Nội dung chuyển khoản không phân biệt in hoa, thường. Nội dung phải đúng
                                            với quy định của trò chơi.</div>
                                        <div><b>Kiểm tra chính xác số điện thoại mà bạn sắp chuyển có tình trạng là
                                                <span class="badge badge-success">Hoạt động</span> không, nếu tình trạng
                                                là <span class="badge badge-danger">Bảo trì</span> vui lòng chuyển vào
                                                số khác.</b></div>
                                        <div>Chuyển nhầm hạn mức, sai nội dung, số <span class="badge badge-danger">Bảo
                                                trì</span>&nbsp;sẽ không được hoàn.</div>
                                    </div>
                                    <div class="table-responsive mb-3">
                                        <table
                                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                                            <thead class="badge-primary text-white">
                                                <tr>
                                                    <th class="text-white">Số điện thoại</th>
                                                    <th class="text-white">Tên tài khoản</th>
                                                    <th class="text-white">Hạn mức</th>
                                                    <th class="text-white">Số lần</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableThongKe"></tbody>
                                        </table>
                                    </div>
                                    <div class="alert alert-warning" role="alert">
                                        <p>Sau thời gian 1 - 2 phút nếu bạn vẫn chưa nhận được tiền thưởng, vui lòng
                                            nhắn
                                            tin hỗ trợ, chúng tôi sẽ xử lý gấp cho bạn. Hoặc bạn có thể kiểm tra trạng
                                            thái
                                            Mã giao dịch.</p>
                                    </div>
                                    <div class="text-center mb-3">
                                        <a target="_blank" href="<?= $settings['tele']; ?>" class="badge badge-primary p-2"><i
                                                class="fa fa-users" aria-hidden="true"></i>Liên Hệ Support</a>
                                        <a target="_blank" href="<?= $settings['box_tele']; ?>"
                                            class="badge badge-info p-2"><i class="fa fa-users"
                                                aria-hidden="true"></i>Box Giao Lưu</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </sections>
                    <sections id="history_win">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="content">
                                    <h3 class="text-center card-title">
                                        <img src="/templates/img/history.png" style="width: 30px"> <b>Lịch Sử
                                            Thắng</b>
                                    </h3>
                                    <div class="table-responsive">
                                        <table
                                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                                            <thead class="badge-primary text-white">
                                                <tr>
                                                    <th class="text-white">Thời gian</th>
                                                    <th class="text-white">Số điện thoại</th>
                                                    <th class="text-white">Tiền cược</th>
                                                    <th class="text-white">Tiền thưởng</th>
                                                    <th class="text-white">Trò chơi</th>
                                                    <th class="text-white">Nội dung</th>
                                                    <th class="text-white">Kết quả</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableHistory">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </sections>
                    
                    <sections id="check_transaction">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="content">
                                    <h3 class="text-center card-title">
                                        <img src="/templates/img/search.png" style="width: 30px"> <b>Kiểm Tra Mã Giao Dịch</b>
                                    </h3>
                                    <p class="text-center">Kiểm tra mã giao dịch bị lỗi chưa nhận được tiền</p>
                                    <?php
                                    if ($settings['video'] != '') { ?>
                                    <a target="_blank" href="<?= $settings['video']; ?>"
                                        class="badge badge-info p-2"><i class="fa fa-users" aria-hidden="true"></i> Video hướng dẫn</a>
                                        <?php } ?>
                                    <div id="check_mgd">
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-md-5">
                                                <input type="number" class="form-control" id="check_tranid"
                                                    placeholder="Nhập mã giao dịch bị lỗi">
                                            </div>
                                        </div>
                                        <div class="text-center mb-3">
                                            <button class="btn btn-primary" onclick="check_tranid()"><i class="fas fa-search"></i> Kiểm tra</button>
                                        </div>
                                    </div>
                                    <div class="alert alert-warning text-center">
                                        Nếu bạn chuyển sai hạn mức tối thiểu và tối đa của trò chơi hoặc sai nội dung,
                                        hệ
                                        thống không hỗ trợ hoàn tiền!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </sections>
                    <?php if ($settings['top_status'] == 'on') { ?> 
                    <sections id="top_tuan">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="content">
                                    <h3 class="text-center card-title">
                                        <img src="/templates/img/cup.png" style="width: 30px">
                                        <b>Đua Top Đại Gia Tuần</b>
                                        <img src="/templates/img/cup.png" style="width: 30px">
                                    </h3>
                                    <div class="table-responsive mb-3">
                                        <table
                                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                                            <thead class="badge-primary text-white">
                                                <tr>
                                                    <th class="text-white">#</th>
                                                    <th class="text-white">Số điện thoại</th>
                                                    <th class="text-white">Tiền thắng</th>
                                                    <th class="text-white">Phần thưởng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                $time_week = strtotime("this week 00:00:00");
                                                $list = $soicoder->fetch_assoc("SELECT DISTINCT `phone` FROM `history` ", 0);
                                                $i = 1;
                                                $list_top = [];
                                                $reward_top = explode('/', $settings['reward_top']);
                                                foreach ($list as $data) {
                                                    $phone = $data['phone'];
                                                    // echo "SELECT SUM(`trans_amount`) FROM `history` WHERE `trans_amount` >= 0 AND `bonus` >= 0 AND `time` >= '" . $time_week . "' AND `phone` =  '" . $phone . "' ORDER BY 'SUM(`trans_amount`)' desc";
                                                    $topreal = $soicoder->fetch_assoc("SELECT SUM(`trans_amount`) FROM `history` WHERE `trans_amount` >= 0 AND `time` >= '" . $time_week . "' AND `phone` =  '" . $phone . "' ORDER BY 'SUM(`trans_amount`)' desc", 1);
                                                    $list_top[$phone] = $topreal['SUM(`trans_amount`)'];
                                                }
                                                arsort($list_top);
                                                $dem = 0;
                                                foreach ($list_top as $phone => $trans_amount) {
                                                    $dem++;
                                                    if ($dem > 5) {break;}
                                                ?>
                                                <tr>
                                                    <td><b><?=$dem;?></b></td>
                                                    <td><?=$phone;?></td>
                                                    <td><?=format_cash($trans_amount);?></td>
                                                    <td><span class="text-success">+ <?=format_cash($reward_top[$dem - 1]);?></span></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="alert alert-secondary text-center">
                                        Đua TOP bắt đầu từ 0h00 và chốt lúc 23h50 cùng ngày.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </sections>
                    <?php } ?>
                    <?php if ($settings['des_status'] == 'on') { ?>    
                    <div class="panel-body text-center">
                        <div class="alert alert-info text-left">
                            <p><strong>Chẵn lẻ ZaloPay</strong><span style="font-weight: 400;"> là một loại trò chơi giải
                                    trí, Có thể giúp bạn kiếm tiền nhanh chóng chỉ sau vài thao tác trên
                                    ZaloPay.&nbsp;</span></p>
                            <p><span style="font-weight: 400;">Chẵn lẻ ZaloPay thuộc loại trò chơi cá cược và hiện đang khá
                                    là phổ biến trong giới trẻ hiện nay bởi tính minh bạch, xanh chín của nó.</span><a
                                    href="../"><span style="font-weight: 400;"> Chơi chẵn lẻ trên ZaloPay</span></a><span
                                    style="font-weight: 400;"> (CLZLP) là trò chơi cá cược chuyển tiền dựa trên mã giao
                                    dịch kết thúc trong Ví ZaloPay.</span></p>
                            <p><span style="font-weight: 400;">Các bạn sẽ có những lựa chọn chẵn hoặc lẻ, tài hoặc xỉu
                                    để điền vào nội dung lúc chuyển khoản.&nbsp;</span></p>
                            <p><span style="font-weight: 400;">Nếu đoán đúng, các bạn sẽ nhận được tiền từ hệ thống tự
                                    động chuyển khoản lại ngay sau đó 1- 2s. Số tiền thưởng sẽ bằng số tiền cược nhân
                                    với tỉ lệ cược do website quy định. Nếu dự đoán sai, các bạn sẽ bị mất số tiền đã
                                    đặt cược.</span></p>
                            <h3><strong>Một vài lưu ý sơ lược về Chẵn Lẻ ZaloPay (Viết tắt là CLZLP) mà bạn cần biết
                                    đến:</strong></h3>
                            <ul>
                                <li style="font-weight: 400;" aria-level="1"><strong>Số bình thường:</strong><span
                                        style="font-weight: 400;"> (Tốc độ trả thưởng là 1s) là số đang hiển thị ở trên
                                        web, </span><strong>Mỗi ZaloPay sẽ có 150 lần trả thưởng và 48 triệu/1
                                        ngày</strong><span style="font-weight: 400;">. Khi đạt đến ngưỡng mức trong ngày
                                        web sẽ tắt đi và bật số mới.</span></li>
                            </ul>
                            <p><span style="font-weight: 400;">GIẢI THÍCH CÁC TRẠNG THÁI KHI CÁC BẠN SỬ DỤNG TÍNH NĂNG
                                    CHECK MÃ:</span></p>
                            <ul>
                                <li style="font-weight: 400;" aria-level="1"><strong>Mã giao dịch đang được xử lý vui
                                        lòng đợi 30s-60s: </strong><span style="font-weight: 400;">Lỗi này do tài khoản
                                        ZaloPay bị lag bạn chỉ cần đợi vài phút hệ thống sẽ tự đổi số khác và thanh toán
                                        cho bạn</span></li>
                                <li style="font-weight: 400;" aria-level="1"><strong>Lỗi xử lí:</strong><span
                                        style="font-weight: 400;">&nbsp; Nếu đang chơi khi check mã hệ thống báo bị lỗi
                                        này thì đừng lo, do ZaloPay đó bị lỗi, bạn hãy liên hệ ADMIN thanh toán cho bạn,
                                        Không việc gì phải lo lắng cả nhé.</span></li>
                                <li style="font-weight: 400;" aria-level="1"><strong>Nhận thưởng quá lâu:</strong><span
                                        style="font-weight: 400;"> Khuyến khích các bạn chơi khi gặp bất kể vấn đề gì về
                                        thanh toán vui lòng: </span><strong>“Liên hệ admin góc phải ” </strong><span
                                        style="font-weight: 400;">(Lưu ý: Phải đọc kỹ luật chơi và check mã trước khi
                                        báo lỗi, Vì hiện tại web chạy rất mượt đa phần các bạn báo lỗi ở đây là do Nhầm
                                        lẫn chơi A - B không có 0 và 9 nhưng khi ra 0 hoặc 9 thì các bạn lại nghĩ rằng
                                        mình thắng và đi báo lỗi @@)</span></li>
                            </ul>
                            <h3><strong>Những điểm mạnh lợi ích khi bạn chơi Chẵn lẻ ZaloPay (CLZLP):</strong></h3>
                            <ul>
                                <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Là loại
                                        mini game với lối chơi cực kỳ đơn giản, dễ hiểu , kiếm tiền ăn triệu mỗi
                                        ngày</span></li>
                                <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Nhận thưởng
                                        nhanh chỉ khoảng tầm 1- 2 giây tối đa</span></li>
                                <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Là game
                                        xanh chín nhất trong các loại game cá cược, dự đoán số</span></li>
                                <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Có thể chơi
                                        mọi lúc, mọi nơi, chỉ cần bạn có tài khoản ZaloPay là chơi được video phía dưới màn
                                        hình</span></li>
                                <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Cho bạn cảm
                                        giác hấp dẫn gây cấn khi chơi game tạo cảm giác mạnh thể thao mạo hiểm phiên bản
                                        online nhập vai</span></li>
                            </ul>
                            <h3><strong>Khuyết điểm game Chẵn lẻ ZaloPay (CLZLP):</strong></h3>
                            <ul>
                                <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Là thể loại
                                        game chơi mới nên chưa phổ biến rộng rãi</span></li>
                                <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Người chơi
                                        thể loại game chẵn lẻ ZaloPay đa phần là dân buôn và dân game thủ</span></li>
                                <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Nhiều
                                        website lừa đảo tạo ra nhưng không trả thưởng cho người chơi.</span></li>
                            </ul>
                            <h3><strong>Hướng dẫn chơi chẵn lẻ tài xỉu bằng tài khoản ZaloPay:</strong></h3>
                            <ul>
                                <li style="font-weight: 400;" aria-level="1"><strong>Bước 1:</strong><span
                                        style="font-weight: 400;"> Các bạn truy cập vào trang chủ website
                                        <b><?=$_SERVER['SERVER_NAME'];?></b>, ngay phía dưới logo có các thể loại game "Chẵn lẻ", "Chẵn lẻ
                                        2", "Tài xỉu", "Tài xỉu 2", "1 phần 3", "H3", “Lô”,...; ae ấn
                                        chọn 1 trong số các game đó để chơi, ví dụ: Chẵn lẻ.</span></li>
                                <li style="font-weight: 400;" aria-level="1"><strong>Bước 2:</strong><span
                                        style="font-weight: 400;"> Sau khi ấn chọn game chẵn lẻ, thì bên dưới sẽ hiển
                                        thị hướng dẫn chơi và các sđt nhận tiền cược. ae chọn coppy 1 ZaloPay bất kỳ trong
                                        các số đó, và lưu ý ngay bên cạnh các sđt đó có ghi mức cược tối thiểu, và cược
                                        tối đa mà ae có thể cược. như hiện tại đối với </span><strong>trò chẵn lẻ
                                        ZaloPay</strong><span style="font-weight: 400;"> thì mức cược</span><strong> Tối
                                        thiểu và Tối đa là bạn hãy xem ở bảng cách chơi
                                <li style="font-weight: 400;" aria-level="1"><strong>Bước 3:</strong><span
                                        style="font-weight: 400;"> Sau khi coppy SĐT, ae xem kỹ nội dung chuyển tương
                                        đương với sự lựa chọn, dự đoán của ae cho số cuối của mã giao dịch.</span></li>
                            </ul>
                            <ul>
                                <li aria-level="1"><strong>CHẴN LẺ</strong></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 400;" aria-level="1"><strong>(A):</strong><span
                                        style="font-weight: 400;"> 2 - 4 - 6 - 8</span></li>
                                <li style="font-weight: 400;" aria-level="1"><strong>(B):</strong><span
                                        style="font-weight: 400;"> 1 - 3 - 5 - 7</span></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 400;" aria-level="2"><strong>Thưởng:</strong><span
                                        style="font-weight: 400;"> </span><strong> X Tiền đặt cược ở bảng cách
                                        chơi</strong></li>
                            </ul>
                            <ul>
                                <li aria-level="1"><strong>CHẴN LẺ 2</strong></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 400;" aria-level="1"><strong>(A2):</strong><span
                                        style="font-weight: 400;"> 0 - 2 - 4 - 6 - 8</span></li>
                                <li style="font-weight: 400;" aria-level="1"><strong>(B2):</strong><span
                                        style="font-weight: 400;"> 1 - 3 - 5 - 7 - 9</span></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 400;" aria-level="2"><strong>Thưởng:</strong><span
                                        style="font-weight: 400;"> </span><strong> X Tiền đặt cược ở bảng cách
                                        chơi</strong></li>
                            </ul>

                            <ul>
                                <li aria-level="1"><strong>TÀI XỈU</strong></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 400;" aria-level="1"><strong>Tài (W):</strong><span
                                        style="font-weight: 400;"> 5 - 6 - 7 - 8</span></li>
                                <li style="font-weight: 400;" aria-level="1"><strong>Xỉu (Q):</strong><span
                                        style="font-weight: 400;"> 1 - 2 - 3 - 4</span></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 400;" aria-level="2"><strong>Thưởng:</strong><span
                                        style="font-weight: 400;"> </span><strong> X Tiền đặt cược ở bảng cách
                                        chơi</strong></li>
                            </ul>

                            <ul>
                                <li aria-level="1"><strong>TÀI XỈU 2</strong></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 400;" aria-level="1"><strong>Tài (W2):</strong><span
                                        style="font-weight: 400;"> 5 - 6 - 7 - 8 - 9</span></li>
                                <li style="font-weight: 400;" aria-level="1"><strong>Xỉu (Q2):</strong><span
                                        style="font-weight: 400;"> 0 - 1 - 2 - 3 - 4</span></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 400;" aria-level="2"><strong>Thưởng:</strong><span
                                        style="font-weight: 400;"> </span><strong> X Tiền đặt cược ở bảng cách
                                        chơi</strong></li>
                            </ul>

                            <ul>
                                <li aria-level="1"><strong>1 PHẦN 3</strong></li>
                            </ul>

                            <ul>
                                <li style="font-weight: 400;" aria-level="1"><strong>(N1):</strong><span
                                        style="font-weight: 400;"> 1 2 3</span></li>
                                <li style="font-weight: 400;" aria-level="1"><strong>(N2):</strong><span
                                        style="font-weight: 400;"> 4 5 6</span></li>
                                <li style="font-weight: 400;" aria-level="1"><strong>(N3):</strong><span
                                        style="font-weight: 400;"> 7 8 9</span><strong>&nbsp;</strong></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 400;" aria-level="2"><strong>Thưởng:</strong><span
                                        style="font-weight: 400;"> </span><strong> X Tiền đặt cược ở bảng cách
                                        chơi</strong></li>
                            </ul>


                            <p><strong>NGOÀI RA WEB CÒN RẤT NHIỀU MINI GAME KHÁC CỦA CLZLP ANH EM CÓ THỂ THAM KHẢO TRỰC
                                    TIẾP Ở TRÊN WEB, ĐÂY LÀ WEB CHƠI CHẴN LẺ ZaloPay UY TÍN (CLZLP) VÀ TRAO THƯỞNG NHANH
                                    NHẤT HIỆN TẠI</strong></p>

                            <p><strong>Ví dụ:</strong><span style="font-weight: 400;"> Bạn dự đoán số cuối mã giao dịch
                                    ZaloPay khả năng sẽ là số lẻ, Bạn chọn (B) thì coppy SĐT bất kỳ trong dãy SĐT bên trên
                                    rồi vào mục chuyển tiền trên ZaloPay, bạn muốn cược 100k phần nội dung chuyển khoản bạn
                                    gõ chữ B và ấn chuyển khoản.&nbsp;</span></p>
                            <p><span style="font-weight: 400;">Sau khi chuyển khoản xong, Bạn hãy xem mã giao dịch của
                                    bill chuyển khoản đó là gì, số cuối của mã giao dịch đó là chẵn hay lẻ, ví dụ nó là
                                    số 3, thì là lẻ mà bạn chọn B thì đợi khoảng 1 - 2s.</span></p>
                            <p><span style="font-weight: 400;">Bên hệ thống sẽ tự động chuyển lại với số tiền là 100k x
                                    2,35 = 235.000đ, Nếu số cuối mã giao dịch không về như bạn nghĩ thì bạn mất số tiền
                                    cược đó.</span></p>
                            <h4><strong>Cách nhận thưởng “NHIỆM VỤ NGÀY”:</strong></h4>
                            <p><span style="font-weight: 400;">Đây là phần mục thưởng lộc cho bạn mỗi khi
                                </span><strong>chơi chẵn lẻ ZaloPay</strong><span style="font-weight: 400;"> trên website.
                                    Khi chơi đủ số tiền (ko cần biết thắng thua), ae hãy nhập số điện thoại của ae vào
                                    để kiểm tra đã chơi bao nhiêu.&nbsp;</span></p>
                            <h3><strong>Một số lưu ý cần thiết khi chơi chẵn lẻ ZaloPay :</strong></h3>
                            <ul>
                                <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Nội dung
                                        chuyển không phân biệt in hoa, thường. Nếu chuyển sai hạn mức hoặc sai nội dung,
                                        hoặc chuyển nhầm số bảo trì, vui lòng sử dụng chức năng “</span><strong>KIỂM TRA
                                        MÃ GIAO DỊCH</strong><span style="font-weight: 400;">” (Nhập mã giao dịch và SỐ
                                        ĐIỆN THOẠI của web mà bạn đã đánh) sau đó bấm hoàn tiền để được nhận lại tiền
                                        chơi</span></li>
                                <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Số ZaloPay
                                        nhận tiền thường xuyên được cập nhật, vì thế trước khi chơi hãy vào web để lấy
                                        đúng số, tránh bank nhầm.</span></li>
                                <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Chế độ
                                        "Chẵn lẻ" không tính số đuôi 0 và 9. Muốn có cả 2 thì bạn chọn qua chế độ "Chẵn
                                        lẻ 2" để chơi.</span></li>
                                <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Chế độ "Tài
                                        xỉu" không tính số đuôi 0 và 9. Muốn có cả 2 thì bạn chọn qua chế độ "Tài xỉu 2"
                                        để chơi.</span></li>
                                <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Nếu bạn
                                        chiến thắng, vui lòng chờ từ 10 - 30 giây hệ thống sẽ tự động chuyển trả thưởng
                                        cho bạn.</span><code></code></li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="mainbar"></div>
            </main>
        </div>
    </div>
    <!-- Modal DiemDanh -->
    <div class="modal fade" id="modalMuster" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Điểm Danh Nhận Quà Miễn Phí</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Số điện thoại</label>
                        <div class="row gutters-xs">
                            <div class="col">
                                <input type="number" name="phoneMuster" class="form-control"
                                    placeholder="Nhập số điện thoại cần điểm danh..">
                            </div>
                            <span class="col-auto">
                                <button class="btn btn-outline-danger" id="btnMuster" data-toggle="tooltip"
                                    data-placement="top" title="" data-original-title="Điểm danh">
                                    <i class="fas fa-user-crown"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="table-responsive mb-3">
                        <table
                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                            <thead class="badge-primary text-white">
                                <tr>
                                    <th class="text-center text-white" colspan="2">Điểm Danh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Mã phiên</b></td>
                                    <td><b class="text-info" id="muster-session">#524141</b></td>
                                </tr>
                                <tr>
                                    <td><b>Thưởng</b></td>
                                    <td><span class="text-danger">1,000đ - 10,000đ</span></td>
                                </tr>
                                <tr>
                                    <td><b>Tổng</b></td>
                                    <td><span class="text-warning"><b id="muster-count">0</b> người</span></td>
                                </tr>
                                <tr>
                                    <td><b>Thắng phiên trước</b></td>
                                    <td id="muster-winner">0926***653</td>
                                </tr>
                                <tr>
                                    <td><b>Tổng thưởng</b></td>
                                    <td><span class="text-info" id="muster-bonus">0đ</span></td>
                                </tr>
                                <tr>
                                    <td><b>Thời gian</b></td>
                                    <td><span class="text-primary"><b id="muster-time">0</b> giây</span></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mb-3">
                        <table
                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                            <thead class="badge-primary text-white">
                                <tr>
                                    <th class="text-center text-white">Mã Phiên</th>
                                    <th class="text-center text-white">Tổng</th>
                                    <th class="text-center text-white">Số điện thoại</th>
                                    <th class="text-center text-white">Số tiền nhận</th>
                                </tr>
                            </thead>
                            <tbody id="historyMuster"></tbody>
                        </table>
                    </div>
                    <div class="alert alert-warning" role="alert">- Mỗi phiên quà các bạn có 10 phút để điểm danh. <br>
                        - Số điện thoại điểm danh phải chơi mini game trên hệ thống ít nhất 1 lần trong ngày. Không giới
                        hạn số lần điểm
                        danh trong ngày. <br>
                        - Khi hết thời gian, người may mắn sẽ nhận được số tiền của phiên đó. <br>
                        - Game <b>Điểm danh miễn phí</b> chỉ hoạt động từ <b>7h - 24h</b></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                    <b>Bản Quyền © <?=$_SERVER['SERVER_NAME'];?></b> 
                    <script>
                    document.write(new Date().getFullYear())
                    </script> -
                    <script>
                    document.write(new Date().getFullYear() + 2)
                    </script>
                </div>
            </div>
        </div>
    </footer>
    <a href="#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>
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
    <script type="text/javascript">
    let appKey = "191c77877fff3f414680";
    </script>
    <script src="/templates/js/love.js?u=<?=time();?>"></script>
    <script src="/templates/js/main.js?u=<?=time();?>"></script>

    <!-- Modal Jackpot -->
    <div class="modal fade" id="modalJackpot" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">JACKPOT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <h6><strong>Bước 1:</strong> Đăng ký tham gia</h6>
                        <div class="form-jackpot mb-2">
                            <div class="message"></div>
                            <div class="form-group">
                                <label class="form-label">Số điện thoại</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="phone"
                                        placeholder="Nhập số điện thoại...">
                                    <div class="input-group-append"></div>
                                </div>
                                <div class="mt-2 d-none jackpot-time"
                                    style="border: 2px dashed rgb(195, 230, 203); padding: 10px; border-radius: 5px;">
                                    Thời gian đăng ký nổ hũ: <strong></strong>
                                </div>
                            </div>
                            <p> Để tham gia chức năng này, bạn cần nhập số điện thoại của bạn chơi vào mục bên trên, sau
                                đó ấn nút <strong class="text-danger">Tham gia</strong>, (Để hủy thì làm lại tương tự).
                            </p>
                        </div>
                        <h6><strong>Bước 2:</strong> Hình thức trả thưởng</h6>
                        <p>- Khi tham gia, mỗi khi bạn chiến thắng sẽ bị trừ
                            <strong class="text-danger"><span>999đ</span></strong> cho
                            vào Quỹ Hũ.
                        </p>
                        <p>- Nếu bạn có đuôi số mã giao dịch là: <br>
                            <span class="jackpot-numbers">
                                <strong class="text-danger">1111</strong>
                                <strong class="text-danger">2222</strong>
                                <strong class="text-danger">3333</strong>
                                <strong class="text-danger">4444</strong>
                                <strong class="text-danger">5555</strong>
                                <strong class="text-danger">6666</strong>
                                <strong class="text-danger">7777</strong>
                                <strong class="text-danger">8888</strong>
                                <strong class="text-danger">9999</strong>
                            </span> thì bạn sẽ nhận được toàn bộ số tiền trong hũ
                        </p>
                        <p>- Nếu bạn nổ hũ, vui lòng chờ hệ thống sẽ tự động thanh toán vào tài khoản của bạn.</p>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                            <thead class="badge-primary text-white">
                                <tr>
                                    <th class="text-center text-white">Thời gian</th>
                                    <th class="text-center text-white">Số điện thoại</th>
                                    <th class="text-center text-white">Số tiền nhận</th>
                                </tr>
                            </thead>
                            <tbody id="historyJackpot"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        historyJackpot();
    })
    </script>
    <!-- Modal Notification -->
    <div class="modal fade" id="modalNoti" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= $settings['event']; ?>
                </div>
                                <div class="modal-footer">
                    <button type="button" onclick="playAudio()" class="btn btn-primary btn-block btn-read" data-dismiss="modal">Đã
                        đọc</button>
                        <audio id="myAudio">
                      <source src="./nhac2.mp3" type="audio/mpeg">
                    </audio>
                </div>
            </div>
        </div>
    </div>
    <script>  
    function playAudio() {
  var audio = document.getElementById("myAudio");
  audio.play();}
  </script>
    <script type="text/javascript">

    $(document).ready(function() {
        let isRead = localStorage.getItem('isRead');

        if (isRead) {
            let now = Date.now();

            if (now >= isRead) {
                localStorage.clear('isRead');
                isRead = null;
            }
        }

        if (!isRead) {
            $('#modalNoti').modal('show')
        }

        $('.btn-read').click(function(e) {
            let now = Date.now();
            localStorage.setItem('isRead', now + 3600 * 1000)
        })
    })
    </script>
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi tiết giao dịch <b id="detailTransId"
                            class="text-primary">#27628912804</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table
                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                            <thead class="badge-primary text-white">
                                <th class="text-center text-white" colspan="2">Thông tin giao dịch</th>
                            </thead>
                            <tbody id="tableDetails"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-refund d-none">Hoàn tiền</button>
                    <button type="button" class="btn btn-gray" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        let isRead = localStorage.getItem('isRead');

        if (isRead) {
            let now = Date.now();

            if (now >= isRead) {
                localStorage.clear('isRead');
                isRead = null;
            }
        }

        if (!isRead) {
            $('#modalNoti').modal('show')
        }

        $('.btn-read').click(function(e) {
            let now = Date.now();
            localStorage.setItem('isRead', now + 3600 * 1000)
        })
    });

    function check_tranid() {
        var trans_id = $("#check_tranid").val();
        $.ajax({
            type: "POST",
            url: "/api/public/lichsu",
            data: {
                trans_id
            },
            success: function(result1) {
                result = JSON.parse(result1);
                if (result.status == 'success') {
                    alert(result.msg);
                } else {
                    alert(result.msg);
                }
            },
        });

    }

    </script>

    