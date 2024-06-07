<?php
$color = $settings['color_web'];
$config_game = $soicoder->fetch_assoc("SELECT * FROM `game` WHERE `status` = 'on' ", 0);
?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7BTGYDL779">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7BTGYDL779');
</script>
<html class="no-js" lang="vi">
<head>
    <title><?=ucfirst($_SERVER['SERVER_NAME']);?> - Hệ Thống Mini Game Chẳn Lẻ ZaloPay Uy Tín - Tự Động</title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="<?=ucfirst($_SERVER['SERVER_NAME']);?> - Hệ Thống Mini Game Chẳn Lẻ ZaloPay Uy Tín - Tự Động"
        name="title">
    <meta content="<?=$settings['description'];?>" name="description">
    <meta content="<?=$settings['keyword'];?>" name="keywords">
    <meta content="/" property="og:url">
    <meta content="article" property="og:type">
    <meta content="<?=ucfirst($_SERVER['SERVER_NAME']);?> - Hệ Thống Mini Game Chẳn Lẻ ZaloPay Uy Tín - Tự Động"
        property="og:title">
    <meta content="<?=$settings['description'];?>" property="og:description">
    <meta content="<?=$settings['logo'];?>" property="og:image">
    <link href="<?= $settings['favion']; ?>" rel="apple-touch-icon">
    <link href="<?= $settings['favion']; ?>" rel="shortcut icon" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css2/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css2/bootstrap-social.css" rel="stylesheet">
    <link href="assets/css2/style.css?ver=28" rel="stylesheet">
    <link href="assets/css2/custom.1.css?ver=28" rel="stylesheet">
    <link href="assets/css2/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@0.5.4/dist/simple-notify.min.css">
    <style>
    
    .panel-heading {
        background-color: <?=$color;?> !important;
        border-color: <?=$color;?> !important;
    }

    .panel-primary {
        /*background-color: <?=$color;?> !important;*/
        border-color: <?=$color;?> !important;
        padding-bottom: 20px;
    }

    .navbar {
        background-color: <?=$color;?> !important;

    }

    .navbar .navbar-collapse {
        background-color: <?=$color;?> !important;
    }

    .table .bg-primary {
        background-color: <?=$color;?> !important;
    }

    .footer {
        background-color: <?=$color;?> !important;
    }

    .btn-primary {
        color: #fff;
        background-color: <?=$color;?>;
        border-color: <?=$color;?>
    }
    #loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #fff;
        z-index: 9999;
    }

    #loading img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100px;
        height: 100px;
    }

    </style>
</head>

<body style="" class="">
    <!-- <div id="loading">
        <img src="/templates/img/loader.svg?i=129129" alt="Loading...">
    </div>
    <script>
        window.addEventListener('load', function() {
            document.getElementById('loading').style.display = 'none';
        });

    </script> -->




    





    <input type="hidden" name="main_session">
    <div class="mainbar" style="height: 150px;">
        <div class="navbar">
            <div class="container">
                <a href="/" class="text-left">
                    <div class="">
                        <img src="<?=$settings['logo'];?>" height="59px" alt="Logo">
                        <marquee width="100%" behavior="scroll" style="display: block;
position: fixed;
bottom: 70 px;
left: 15 px;
z-index: 1000;
cursor: pointer;
width: 100%;">
                            <font color="white"
                                style="text-shadow: 0 0 0.2em #ff0000, 0 0 0.2em #ff0000,  0 0 0.2em #ff0000"><b>Hiện
                                    nay có rất nhiều website giả mạo , fake <?=ucfirst($_SERVER['SERVER_NAME']);?> ,....
                                    Tất cả các web đều giả
                                    mạo các bạn không nên chơi thử mà chỉ chơi tại đây tránh mất tiền oan !!!</b></font>
                        </marquee>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <div class="content-container">
                <div class="py-5" style="min-height: 80px !important;">
                    <div class="output" id="output">
                        <h3 class="cursor">
                            Chẵn lẻ Zalopay Tự Động </h3>
                        <h4>
                            Uy Tín - Nhanh Gọn - Tự Động 24/7 ! </h4>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#noteModal">Xem Lưu
                        Ý</button>
                </div>
                <div class="text-center mt-5">
                    <?php
                        foreach ($config_game as $data) {
                            if ($data['id'] == '1') {
                    ?>
                        <button class="btn btn-default mt-1 btn-info" data-game="<?=$data['game_code'];?>">
                            <?=$data['name'];?>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-default btn-primary mt-1" data-game="<?=$data['game_code'];?>">
                        <?=$data['name'];?>
                        </button>
                    <?php }} ?>
                    
                </div>
                <div class="text-center mt-5" role="group">
                    <button class="btn btn btn-outline-primary mt-1" data-minigame="giftcode"
                        style="position: relative;">
                        Nhập Gifcode
                        <b class="text-danger"
                            style="position: absolute;margin-left: auto;margin-right: auto;text-align: center;left: 0px;right: 0px;top: 22px;font-size: 9px;">
                            <font color="red">(NEW)</font>
                        </b>
                    </button>
                </div>
                <div class="row justify-content-md-center box-cl">
                    <div class="col-md-6 mt-3 cl">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center">
                                Cách chơi
                            </div>
                            <div class="play-rules">
                                <!-- game -->
                                <?php
                                    $list_des = array(
                                        '1END' => 'là một game tính kết quả bằng <b> 1 số cuối mã giao dịch</b>.',
                                        '2END' => 'là một game tính kết quả bằng <b> 2 số cuối mã giao dịch</b>.',
                                        'H2END' => 'là một game tính kết quả bằng hiệu <b> 2 số cuối mã giao dịch</b>.'
                                    );
                                    foreach ($config_game as $key => $data) {
                                        $data_content = explode('|', $data['content2']);
                                        $data_result = explode('|', $data['result']);
                                        $data_ratio = explode('|', $data['ratio']);
                                ?>
                                <div class="panel-body game <?=($key == 0) ? 'active' : '';?>" style="padding-top: 10px; padding-bottom: 20px;"
                                    game-tab="<?=$data['game_code'];?>">
                                    <p>- <b><?=$data['name'];?></b> <?=$list_des[$data['type_code']];?>
                                    </p>
                                    <p>-Cách chơi vô cùng đơn giản :</p>
                                    <p>- Chuyển tiền vào một trong các tài khoản <b>(Không chuyển tiền lại từ các giao dịch trước để tránh xảy ra lỗi)</b>:</p>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center text-white bg-primary">Số điện thoại</th>
                                                    <th class="text-center text-white bg-primary">Tối thiểu</th>
                                                    <th class="text-center text-white bg-primary">Tối đa</th>
                                                </tr>
                                            </thead>
                                            <tbody aria-live="polite" aria-relevant="all" class="result-table-10"
                                                role="alert" id="result-momo-<?=$data['game_code'];?>">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center font-weight-bold mb-3" id="timer-<?=$data['game_code'];?>"><b>Làm mới sau <span class="text-danger coundown-time">10</span> s</b></div>
                                    <p class="mt-3">
                                        <?=html_entity_decode(base64_decode($data['description']));?>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-center text-white bg-primary">Mã Đuôi</th>
                                                    <th class="text-center text-white bg-primary"><?=$data['type'];?></th>
                                                    <th class="text-center text-white bg-primary">Tiền nhận</th>
                                                </tr>
                                            </thead>
                                            <tbody aria-live="polite" aria-relevant="all" class="" id="result-table"
                                                role="alert">
                                                <?php
                                                    for ($i = 0; $i < count($data_content); $i++) {
                                                        $content_game = $data_content[$i];
                                                        $result_game = explode('-', $data_result[$i]);
                                                        $ratio_game = $data_ratio[$i];
                                                ?>
                                                <tr>
                                                    <td style="text-align: center;">
                                                        <b style="text-align: center; justify-content: center; display: flex">
                                                            <span class="label label-success text" style="margin-right: 2px"><?=$content_game;?></span>
                                                            <span class="label label-success text-uppercase" onclick="coppy_nd('<?=$content_game;?>')"><i class="fa fa-clipboard" aria-hidden="true"></i></span>
                                                        </b>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        $j = 0;
                                                        foreach ($result_game as $content) {
                                                        ?>
                                                        <span class="fa-stack">
                                                            <span
                                                                class="fa fa-circle fa-stack-2x dot-text-<?=$j++;?>">
                                                            </span>
                                                            <span class="fa-stack-1x text-white comment-chan"><?=$content;?></span>
                                                        </span>
                                                        <?php } ?>
                                                    </td>
                                                    <td><b>x<?=$data_ratio[$i];?></b></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    - Tiền thắng sẽ = <b>Tiền cược*<?=$data_ratio[0];?></b><br> <b>- Lưu ý :
                                        Nếu chuyển sai hạn mức hoặc sai nội dung sẽ không được hoàn tiền.</b>
                                </div>
                                <?php } ?>
                            </div>


                            <!-- Điểm danh -->
                            <div class="minigame-rules">
                                <div class="panel-body game" style="padding-top: 10px; padding-bottom: 20px;"
                                    game-tab="giftcode">
                                    <style>
                                    #diemDanhCard {
                                        margin-top: 0.5rem;
                                        color: #155724;
                                        border-color: #c3e6cb;
                                    }

                                    #occard {
                                        margin-top: 0.5rem;
                                        color: #155724;
                                        background-color: #9cbca4;
                                        border-color: #c3e6cb;
                                        padding: 20px;
                                    }

                                    .occho {
                                        margin-top: 0.5rem;
                                        color: #155724;
                                        background-color: #aed6b8;
                                        border-color: #c3e6cb;
                                        padding: 20px;
                                    }
                                    </style>
                                    <div class="row collapse show" id="diemDanhCard" style="">
                                        <div class="col-lg-12">
                                            <div class="body">
                                                <div class="text-center">
                                                    <p style="line-height: 0.8;"></p>
                                                    <p style="font-size:120%;text-align:center;"><b>Gifcode</b>
                                                    </p>
                                                    <div class="form-group" id="non_query"
                                                        style="background-color: #7ee2ff; border-color: #ad4105; padding: 20px;">
                                                        <label for="partnerId">Mã code:</label>
                                                        <input type="text" class="form-control" name="giftcode"
                                                            id="giftcode" placeholder="ABCXYZ">
                                                        <label for="partnerId" style="margin-top: 10px;">Số điện
                                                            thoại:</label>
                                                        <input type="text" class="form-control" name="phoneCode"
                                                            id="phoneCode" placeholder="094xxxxxxx">
                                                        <small id="partnerId" class="form-text text-muted"
                                                            style="color: #ff0000">Nhập số điện thoại của
                                                            bạn để kiểm tra và
                                                            nhận
                                                            thưởng.</small> <br>
                                                        <button type="submit" class="btn btn-success"
                                                            onclick="check_Giftcode()">Kiểm Tra</button>
                                                    </div>
                                                    <div class="form-group" id="query_done" style="display: none;">
                                                    </div>
                                                    <div class="form-group bg-warning" id="day_mission_querying"
                                                        style="display: none;">Đang truy vấn...
                                                        xin chờ
                                                        nhé...
                                                    </div>
                                                    <div class="occho" id="muc_huongdan">
                                                        1. Một số điện thoại chỉ được nhập 1 mã/ngày. <br>
                                                        2. Mã code khuyến mại sẽ tùy vào điều kiện để sử dụng, có thời
                                                        hạn. <br>
                                                        3. Mã code khuyến mại sẽ được cấp theo các chương trình khuyến
                                                        mại của hệ thống Momo Lô Tô. <br>
                                                        4. Vui lòng liên hệ chát CSKH để biết thêm chi tết khi bạn nhận
                                                        được CODE. <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                function check_Giftcode() {
                                    let phone = $("#phoneCode").val();
                                    let code = $("#giftcode").val();
                                    if (phone.length <= 9) {
                                        alert('Số điện thoại không hợp lệ');
                                        return false;
                                    }
                                    $("#non_query").hide();
                                    $("#day_mission_querying").show();
                                    $.ajax({
                                        url: '/api/v2/gifcode',
                                        data: {
                                            phone: phone,
                                            code: code
                                        },
                                        type: 'POST',
                                        success: function(result1) {
                                            result = JSON.parse(result1);
                                            if (result.status == 'success') {
                                                alert(result.msg);
                                                $("#non_query").show();
                                                $("#day_mission_querying").hide();
                                            } else {
                                                alert(result.msg);
                                                $("#non_query").show();
                                                $("#day_mission_querying").hide();
                                            }
                                        }
                                    })
                                }
                                </script>
                            </div>
                        </div>
                    </div>
                    


                    <!-- Kiểm tra mã giao dịch -->
                    <div class="col-md-6 mt-3 cl">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center">
                                KIỂM TRA MÃ GIAO DỊCH
                            </div>
                            <div class="panel-body text-center">
                                <div class="alert alert-info text-left">
                                    Nếu quá 15 phút chưa nhận được tiền vui lòng dán mã vào đây để kiểm tra.
                                </div>
                                <div class="text-center">
                                    <div class="form-group">
                                        <label for="check-trans">Nhập mã giao dịch</label>
                                        <input type="number" class="form-control" id="tran_id"
                                            placeholder="Mã giao dịch: Ví dụ 11223344556">
                                        <small id="checkHelp" class="form-text text-muted">Nhập mã giao dịch của bạn để
                                            kiểm tra.</small>
                                    </div>
                                    <button id="submit" class="btn btn-primary mb-2 check-tran"
                                        onclick="check_tranid()">Kiểm tra</button>
                                    <div id="result-check" style="margin-top: 5px;">
                                    </div>
                                </div>
                                <script>
                                function check_tranid() {
                                    var trans_id = $("#tran_id").val();
                                    $.ajax({
                                        type: "POST",
                                        url: "/api/public/lichsu",
                                        data: {
                                            trans_id
                                        },
                                        success: function(result1) {
                                            result = JSON.parse(result1);
                                            document.getElementById("submit").disabled = false;
                                            if (result.status == 'success') {
                                                $("#result-check").attr("class", "").addClass(
                                                    "alert alert-success").html(`
                                                        <p>Mã Giao Dịch: ${result.data.trans_id}</p>
                                                        <p>Số Điện Thoại: ${result.data.phone}</p>
                                                        <p>Zalopay Chơi: ${result.data.account}</p>
                                                        <p>Zalopay Trả Thưởng: ${result.data.phone_result}</p>
                                                        <p>Trò Chơi: ${result.data.game}</p>
                                                        <p>Tiền Cược: ${result.data.trans_amount}đ</p>
                                                        <p>Nội Dung: ${result.data.description}</p>
                                                        <p>Kết Quả: ${result.data.result}</p>
                                                        <p>Tiền Thắng: ${result.data.bonus}đ</p>
                                                        <p>Nội Dung Trả: ${result.data.msg_bonus}</p>
                                                        <p>Trạng Thái: ${result.data.status_text}</p>
                                                        <p>Thời Gian: ${result.data.time}</p>
                                                    `);
                                            } else if (result.status == 'lose') {
                                                $("#result-check").attr("class", "").addClass(
                                                    "alert alert alert-danger").html(`
                                                        <p>Mã Giao Dịch: ${result.data.trans_id}</p>
                                                        <p>Số Điện Thoại: ${result.data.phone}</p>
                                                        <p>Zalopay Chơi: ${result.data.account}</p>
                                                        <p>Trò Chơi: ${result.data.game}</p>
                                                        <p>Tiền Cược: ${result.data.trans_amount}đ</p>
                                                        <p>Nội Dung: ${result.data.description}</p>
                                                        <p>Kết Quả: ${result.data.result}</p>
                                                        <p>Thời Gian: ${result.data.time}</p>
                                                    `);
                                            } else {
                                                $("#result-check").attr("class", "").addClass(
                                                    "alert alert-danger").html(result.msg);
                                            }
                                        },
                                    });

                                }
                                </script>
                                </br>
                                <div class="text-center mt-3">
                                    <a class="" href="<?=$settings['tele'];?>" target="_blank">
                                        <span class="btn btn-info text-uppercase">LIÊN HỆ SUPPORT</span>
                                    </a>
                                    <a class="text-white" href="<?=$settings['box_tele'];?>" target="_blank">
                                        <span class="btn btn-info text-uppercase">BOX GIAO LƯU</span>
                                    </a>
                                </div>
                                <?php
                                if ($settings['video'] != '') { ?>
                                <div class="text-center mt-3">
                                    <p>
                                        <a class="text-white" href="<?=$settings['video'];?>" target="_blank">
                                            <span class="btn btn-success text-uppercase">Video Hướng Dẫn Chơi</span>
                                        </a>
                                    </p>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 text-center panel panel-primary">
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class="text-center mb-3">
                            <h3 class="text-uppercase">
                                TRẠNG THÁI ZALOPAY
                            </h3>
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover text-center">
                                <thead>
                                    <tr class="bg-primary" role="row">
                                        <th class="text-center text-white">
                                            Số điện thoại
                                        </th>
                                        <th class="text-center text-white">
                                            Trạng thái
                                        </th>
                                        <th class="text-center text-white">
                                            Giao dịch
                                        </th>
                                        <th class="text-center text-white">
                                            Hạn mức
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="momo-status">
                                </tbody>
                            </table>
                            <div class="text-center font-weight-bold m-3" id="timer-list-momo"><b>Làm mới sau <span class="text-danger coundown-time">9</span> s</b></div>
                        </div>
                    </div>
</div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class="text-center mb-3">
                            <h3 class="text-uppercase">
                                Lịch sử tham gia
                            </h3>
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover text-center">
                                <thead>
                                    <tr class="bg-primary" role="row">
                                        <th class="text-center text-white">
                                            Thời Gian
                                        </th>
                                        <th class="text-center text-white">
                                            Số điện thoại
                                        </th>
                                        <th class="text-center text-white">
                                            Tiền đặt
                                        </th>
                                        <th class="text-center text-white">
                                            Game
                                        </th>
                                        <th class="text-center text-white">
                                            Nội dung
                                        </th>
                                        <th class="text-center text-white">
                                            Trạng thái
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="body_his"></tbody>
                            </table>
                            <div class="text-center font-weight-bold m-3" id="timer"><b>Làm mới sau <span class="text-danger coundown-time">10</span> s</b></div>
                        </div>
</div>
                    </div>
                </div>
            </div>
            <?php if ($settings['top_status'] == 'on') { ?> 
            <div class="panel panel-primary week_top">
                <div class="panel-heading text-center">
                    <h4>TOP THẮNG TUẦN</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover text-center">
                            <thead>
                                <tr role="row" class="bg-primary">
                                    <th class="text-center text-white">TOP</th>
                                    <th class="text-center text-white">Số điện thoại</th>
                                    <th class="text-center text-white">Số tiền</th>
                                    <th class="text-center text-white">Phần thưởng</th>
                                </tr>
                            </thead>
                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="week_top"
                                class="text-center">
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
                                    <td><span class="fa-stack"> <span
                                                class="fa fa-circle fa-stack-2x text-danger"></span><strong
                                                class="fa-stack-1x text-white"><?=$dem;?></strong></span></td>
                                    <td class="col-xs-2"><span
                                            class="label label-success"><?=$phone;?></span></td>
                                    <td class="col-xs-5 text-center"><span
                                            class="label label-danger"><?=format_cash($trans_amount);?>&nbsp;₫</span>
                                    </td>
                                    <td class="col-xs-5 text-center"><span
                                            class="label label-danger"><?=format_cash($reward_top[$dem - 1]);?>&nbsp;₫</span>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <b class="text-danger">Phần thưởng TOP sẽ dược trao vào 24h chủ nhật hàng tuần.</b>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else if ($settings['top_status'] == 'fake') { ?>
                <div class="panel panel-primary week_top">
                <div class="panel-heading text-center">
                    <h4>TOP THẮNG TUẦN</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover text-center">
                            <thead>
                                <tr role="row" class="bg-primary">
                                    <th class="text-center text-white">TOP</th>
                                    <th class="text-center text-white">Số điện thoại</th>
                                    <th class="text-center text-white">Số tiền</th>
                                    <th class="text-center text-white">Phần thưởng</th>
                                </tr>
                            </thead>
                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="week_top"
                                class="text-center">
                                <?php 
                                $top_up = $soicoder->fetch_assoc("SELECT * FROM `top_up` ", 0);
                                $top = $top_up[0];
                                $sdt_fake = $top_up[1];
                                $top_fake = $top_up[2];
                                $reward_top = explode('/', $settings['reward_top']);
                                for ($i = 1; $i <= 5; $i++) {
                                ?>
                                <tr>
                                    <td><span class="fa-stack"> <span
                                                class="fa fa-circle fa-stack-2x text-danger"></span><strong
                                                class="fa-stack-1x text-white"><?=$i;?></strong></span></td>
                                    <td class="col-xs-2"><span
                                            class="label label-success">****<?=substr($sdt_fake['top'.$i], -4);?></span></td>
                                    <td class="col-xs-5 text-center"><span
                                            class="label label-danger"><?=($top_fake['top'.$i]);?>&nbsp;₫</span>
                                    </td>
                                    <td class="col-xs-5 text-center"><span
                                            class="label label-danger"><?=format_cash($reward_top[$i - 1]);?>&nbsp;₫</span>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <b class="text-danger">Phần thưởng TOP sẽ dược trao vào 24h chủ nhật hàng tuần.</b>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    </div>
    <footer class="footer">
        <div class="container text-center">
            <div class="row">
                <!-- <button class="btn btn-outline-primary mt-1" style="position: relative;">
                    <a class="text-black" href="https://t.me/<?=TELE_ADMIN;?>" target="_blank">
                        LH Mua Code & Thuê Server
                    </a>
                </button> -->
                <div class="col-xs-12 text-white">
                    Copyright 2023 © <a class="text-white" href="https://t.me/<?=TELE_ADMIN;?>" target="_blank">@<?=TELE_ADMIN;?></a> | All rights reserved
                </div>
            </div>
        </div>
    </footer>
    <!-- noteModal -->

    <div class="modal fade" id="noteModal" tabindex="-1" role="dialog" style="overflow: scroll; display: block; overflow-y: scroll; animation: 3s;" aria-hidden="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noteModalLabel">Thông báo</h5>
                    <button type="button" class="close" onclick="$('#noteModal').hide();" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?=$settings['event'];?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#noteModal').hide();"
                        data-dismiss="modal">Đã hiểu</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://js.pusher.com/7.0/pusher.min.js" id="pusher-js"></script>
    <script src="assets/js2/wheel.min.js?V2"></script>
    <script src="assets/js2/jquery-1.10.1.min.js"></script>
    <script src="assets/js2/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js2/bootstrap.min.js"></script>
    <script src="assets/js2/moment.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@0.5.4/dist/simple-notify.min.js"></script>
    
    <script>

    setTimeout(function() {
        $('#noteModal').addClass('in');
    }, 800);


    window.addEventListener('DOMContentLoaded', (event) => {
        $('[data-toggle="tooltip"]').tooltip();
        $('.cash-format').each(function(index) {
            $(this).html(parseInt($(this).text()).toLocaleString('it-IT', {
                style: 'currency',
                currency: 'VND'
            }));
        });
        $('button[data-game]').click(function() {
            let button = $(this);
            let game = button.attr('data-game');
            game_active = game;
            $('.game').removeClass('active');
            $(`.game[game-tab=${game}]`).addClass('active').removeClass("hidden");
            $("button[data-game]").removeClass("btn-info").addClass("btn-primary");
            $("[data-minigame]").removeClass("btn-success");
            button.removeClass("btn-primary").addClass("btn-info");
        });
        $('button[data-minigame]').click(function() {
            let button = $(this);
            let game = button.attr('data-minigame');
            game_active = "minigame";
            $('.game').removeClass('active');
            $(`.game[game-tab=${game}]`).addClass('active').removeClass("hidden");
            $("[data-minigame]").removeClass("btn-success");
            $("[data-game]").removeClass("btn-success").addClass("btn-primary");
            button.addClass("btn-success");
        });
    });

    function copyStringToClipboard(str) {
        // Create new element
        var el = document.createElement('textarea');
        // Set value (string to be copied)
        el.value = str;
        // Set non-editable to avoid focus and move outside of view
        el.setAttribute('readonly', '');
        el.style = {
            position: 'absolute',
            left: '-9999px'
        };
        document.body.appendChild(el);
        // Select text inside element
        el.select();
        // Copy text to clipboard
        document.execCommand('copy');
        // Remove temporary element
        document.body.removeChild(el);
    }


    function coppy2(text) {
        copyStringToClipboard(text);
        alert('Đã sao chép số điện thoại này. Chúc bạn may mắn.');
    }
    function coppy(text, min, max) {
        copyStringToClipboard(text);
        alert("Đã sao chép số: " + text + " chơi từ " + (min) + " VNĐ đến " + (max) + " VNĐ. Nếu bạn chuyển nhỏ hơn hoặc lớn thua sẽ mất tiền.  ");
    }
    function coppy_nd(text) {
        copyStringToClipboard(text);
        alert("Đã sao chép nội dung: " + text);
    }
    function play(t) {
        window.open('https://social.zalopay.vn/mt-gateway/v1/private-qr?note=&receiver_id=' + t, "_blank");
    }

    function check_ls() {
        $.ajax({
            url: "api/v2/win",
            success: function(json) {
                const data = JSON.parse(json);
                let body = '';
                data.forEach((data) => {
                    let color_change = '#' + ((1 << 24) * (Math.random() + 1) | 0).toString(16)
                        .substr(1);
                    body += `<tr>
                                <td>${data.time}</td>
                                <td>${data.phone}</td>
                                <td>${data.amount_play}&nbsp;₫</td>
                                <td>${data.game}</td>
                                <td>
                                    <b style="text-align: center; justify-content: center; display: flex">
                                        <span class="label label-success text" style="margin-right: 2px">${data.comment}</span>
                                    </b>
                                </td>
                                <td><span class="label label-${data.code_status} text-uppercase">${data.status}</span></td>
                            </tr>`;

                });
                return_timer();
                $('#body_his').html(body);
            }
        })
    }

    function load_acount(game) {
        $.ajax({
            url: "api/v2/getPhone",
            success: function(json) {
                const data = JSON.parse(json);
                let body = '';
                data.forEach((data) => {
                    let color_change = '#' + ((1 << 24) * (Math.random() + 1) | 0).toString(16)
                        .substr(1);
                    body += `<tr>
                                <td id="mm_${data.phone}">
                                    <b id="mln">
                                        ${data.phone} <b id="hmln" attr-name="amount"
                                            class="">
                                            <font color="${data.color}">${data.sum_chuyentien}</font>/<font color="6861b1">50M</font>
                                        </b>
                                        <b id="hmln" class="hidden" attr-name="times">
                                            <font color="red">${data.sum_gd} VND</font>/<font
                                                color="6861b1">200
                                                Giao dịch
                                            </font>
                                        </b>
                                    </b>
                                    <span class="label label-success text-uppercase"
                                        onclick="coppy('${data.phone}', '${data.min}', '${data.max}')"><i
                                            class="fa fa-clipboard" aria-hidden="true"></i></span>
                                </td>
                                <td>${data.min} VNĐ</td>
                                <td>${data.max} VNĐ</td>
                            </tr>`;

                });
                return_timer_game(game);
                $('#result-momo-' + game).html(body);
            }
        })
    }

    function list_acount() {
        $.ajax({
            url: "api/v2/getPhone",
            success: function(json) {
                const data = JSON.parse(json);
                let body = '';
                data.forEach((data) => {
                    let color_change = '#' + ((1 << 24) * (Math.random() + 1) | 0).toString(16)
                        .substr(1);
                    body += `<tr>
                                <td>${data.phone} <span class="label label-success text-uppercase" onclick="coppy2('${data.phone}')"><i class="fa fa-clipboard" aria-hidden="true"></i></span></td>
                                <td><span class="label label-success text-uppercase">Hoạt động</span></td>
                                <td><strong><span class="text-danger">Không giới hạn</span></strong></td>
                                <td><strong><span class="text-danger cash-format">${data.sum_chuyentien}&nbsp;VND</span>/50M</strong></td>
                            </tr>`;

                });
                return_timer_game('list-momo');
                $('#momo-status').html(body);
            }
        })
    }
    <?php
        foreach ($config_game as $data) {
    ?>
    load_acount('<?=$data['game_code'];?>');
    <?php } ?>
    list_acount();
    check_ls();


    setInterval(function() {
        <?php
            foreach ($config_game as $data) {
        ?>
        load_acount('<?=$data['game_code'];?>');
    <?php } ?>
        list_acount();
        check_ls();
    }, 12000);

    function return_timer_game(game) {
        var count = 11;

        var counter = setInterval(timer, 1000); //1000 will  run it every 1 second
        function timer() {
            count = count - 1;
            if (count <= 0) {
                clearInterval(counter);
                return;
            }
            document.getElementById("timer-" + game).innerHTML = "<b>Làm mới sau <span class='text-danger coundown-time'>" +
                count + "</span> s</b>"; // watch for spelling
        }
    }


    function return_timer() {
        var count = 11;

        var counter = setInterval(timer, 1000); //1000 will  run it every 1 second
        function timer() {
            count = count - 1;
            if (count <= 0) {
                clearInterval(counter);
                return;
            }
            document.getElementById("timer").innerHTML = "Làm mới sau <span class='text-danger coundown-time'>" +
                count + "</span> s</b>"; // watch for spelling
        }
    }

    </script>

    <div class="notifications-container notify-is-right notify-is-top" style="--distance:20px;"></div>
</body>

</html>




