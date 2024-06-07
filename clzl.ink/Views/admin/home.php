<?php session_start(); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/header.php'); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/navbar.php'); ?>
<?php
// ngày
$time_today = strtotime('today');
$his_today = $soicoder->fetch_assoc("SELECT SUM(`trans_amount`),SUM(`bonus`) FROM `history` WHERE (time >= '$time_today' AND `status` <> 'wrong' AND `status` <> 'wrong_content') ", 1);
$send_today = $soicoder->fetch_assoc("SELECT SUM(`amount`) FROM `chuyen_tien` WHERE (time >= '$time_today') ", 1);
$win_today = $soicoder->fetch_assoc("SELECT COUNT(*) FROM `history` WHERE (time >= '$time_today' AND `result` = 'win') ", 1);
$loss_today = $soicoder->fetch_assoc("SELECT COUNT(*) FROM `history` WHERE (time >= '$time_today' AND `result` <> 'win' AND `status` <> 'wrong' AND `status` <> 'wrong_content') ", 1);

$list_user_day = $soicoder->fetch_assoc("SELECT DISTINCT `phone` FROM `history` WHERE time >= '$time_today' ", 0);
// echo "SELECT COUNT(*) FROM `history` WHERE (time >= '$time_today' AND `result` <> 'win' AND `status` <> 'wrong' AND `status` <> 'wrong') ";

// tháng
$date = date_create(date('Y-m-01'));
$date->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
$time_month = $date->format('U');
$his_month = $soicoder->fetch_assoc("SELECT SUM(`trans_amount`),SUM(`bonus`) FROM `history` WHERE (time >= '$time_month' AND `status` <> 'wrong' AND `status` <> 'wrong_content') ", 1);
$send_month = $soicoder->fetch_assoc("SELECT SUM(`amount`) FROM `chuyen_tien` WHERE (time >= '$time_month') ", 1);
$win_month = $soicoder->fetch_assoc("SELECT COUNT(*) FROM `history` WHERE (time >= '$time_month' AND `result` = 'win') ", 1);
$loss_month = $soicoder->fetch_assoc("SELECT COUNT(*) FROM `history` WHERE (time >= '$time_month' AND `result` <> 'win' AND `status` <> 'wrong' AND `status` <> 'wrong_content') ", 1);


// all
$win_all = $soicoder->fetch_assoc("SELECT COUNT(*) FROM `history` WHERE `result` = 'win' ", 1);
$loss_all = $soicoder->fetch_assoc("SELECT COUNT(*) FROM `history` WHERE (`result` <> 'win' AND `status` <> 'wrong' AND `status` <> 'wrong_content') ", 1);


$list_user = $soicoder->fetch_assoc("SELECT DISTINCT `phone` FROM `history` ", 0);

$sum = $list = $soicoder->fetch_assoc("SELECT SUM(`balance`) FROM `zalopays` ", 1);

$sum_error = $list = $soicoder->fetch_assoc("SELECT COUNT(*) FROM `history` WHERE (status = 'wait' OR status = 'wait_tt') ", 1);
?>
<main class="container">
    <div class="mainbar"></div>
    <h3 class="text-white text-center">Tổng Quan</h3>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body jumbotron">
                <div style="overflow: auto; height: 350px;" id="_logSystem">
                    <div class="content__inner">
                        <div class="content__ant content__card__border">
                            <div class="content__card__body">
                                <div class="content__card__body">
                                    <h3>Lịch Sử Hoạt Động Code</h3>
                                </div>
                                <div class="content__card__body">
                                    <p>Ngày Triển Khai Code: 15/01/2023</p>
                                    <p>Ngày Hoàn Thành Code V0: 14/02/2023</p>
                                    <p>Ngày Hoàn Thành Code V1: 01/03/2023 (thêm kiểm tra dòng tiền + check mã giao dịch, nội dung không cần nhập sđt)</p>
                                    <p>Ngày Hoàn Thành Code V2: 15/03/2023 (update theme, các setting, theme cấu hình trả thưởng khác số)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content__inner">
                        <div class="content__ant content__card__border">
                            <div class="content__card__body">
                                <div class="content__card__body">
                                    <h3>Thông Báo</h3>
                                </div>
                                <div class="content__card__body">
                                    <p>1. Mọi thắc mắc về lỗi server hoặc thuê server liên hệ tele: @<?=TELE_ADMIN;?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content__inner">
                        <div class="content__ant content__card__border">

                            <div class="content__card__body">
                                <h3>Lưu Ý</h3>
                            </div>
                            <div class="content__card__body">
                                <p>1. Nên Sài Cron 10s/1 lần</p>
                                <p>2. Link Cron Trả Thưởng: <b id="cron">https://<?=$_SERVER['SERVER_NAME'];?>/api/zalopay/cron</b> <a onclick="copy('#cron')"><i class="fa fa-copy"></i></a></p>
                            </div>
                        </div>
                    </div>
                    <div class="content__inner">
                        <div class="content__ant content__card__border">
                            <div class="content__card__body">
                                <div class="content__card__body">
                                    <h3>Hạn Sử Dụng</h3>
                                </div>
                                <div class="content__card__body">
                                    <p><?=TIME;?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3 class="text-white text-center">Ngày <?= date('d/n/Y'); ?>
        <span class="hand change-time" data-id="_revenueDay"><i class="fas fa-calendar-alt"></i></span>
    </h3>
    <div class="row row-cards moneyDay">
        <div class="col-sm-12 col-lg-3 col-md-6">
            <div class="card card-img-holder text-default">
                <div class="row">
                    <div class="col-4">
                        <div class="card-img-absolute circle-icon bg-danger align-items-center text-center shadow-danger">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="fas fa-exclamation-triangle fs-30 text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="error"><?=$sum_error['COUNT(*)'];?></span>
                            </h2>
                            <h5 class="font-weight-normal mb-0">Tổng Lỗi</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3 col-md-6">
            <div class="card card-img-holder text-default bg-color">
                <div class="row">
                    <div class="col-3">
                        <div class="circle-icon bg-primary text-center align-self-center shadow-primary">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="far fa-money-bill fs-30  text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="receipt"><?= format_cash($his_today['SUM(`trans_amount`)']); ?></span>đ</h2>
                            <h5 class="font-weight-normal mb-0">Tổng Nhận</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3 col-md-6">
            <div class="card card-img-holder text-default">
                <div class="row">
                    <div class="col-3">
                        <div class="card-img-absolute circle-icon bg-secondary align-items-center text-center shadow-secondary">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="far fa-satellite-dish fs-30 text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="minus"><?= format_cash($his_today['SUM(`bonus`)']); ?></span>đ
                            </h2>
                            <h5 class="font-weight-normal mb-0">Tổng Chi</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3 col-md-6">
            <div class="card card-img-holder text-default">
                <div class="row">
                    <div class="col-3">
                        <div class="card-img-absolute circle-icon bg-info align-items-center text-center shadow-info">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="far fa-heart-rate fs-30 text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="earning"><?= format_cash(($his_today['SUM(`trans_amount`)']) - $his_today['SUM(`bonus`)']); ?></span>đ</h2>
                            <h5 class="font-weight-normal mb-0">Doanh Thu</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cards betDay">
        <div class="col-sm-12 col-lg-3 col-md-6">
            <div class="card card-img-holder text-default">
                <div class="row">
                    <div class="col-4">
                        <div class="card-img-absolute circle-icon bg-warning align-items-center text-center shadow-warning">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="fas fa-money-bill fs-30 text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="refund"><?=number_format($sum['SUM(`balance`)']);?></span>
                            </h2>
                            <h5 class="font-weight-normal mb-0">Tổng Số Dư</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3 col-md-6">
            <div class="card card-img-holder text-default bg-color">
                <div class="row">
                    <div class="col-4">
                        <div class="circle-icon bg-success text-center align-self-center shadow-success">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="fas fa-badge-check fs-30  text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="win"><?= format_cash($win_today['COUNT(*)']);?></span></h2>
                            <h5 class="font-weight-normal mb-0">Tổng Thắng</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3 col-md-6">
            <div class="card card-img-holder text-default">
                <div class="row">
                    <div class="col-4">
                        <div class="card-img-absolute circle-icon bg-gray align-items-center text-center shadow-gray">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="fas fa-window-close fs-30 text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="won"><?=format_cash($loss_today['COUNT(*)']);?></span></h2>
                            <h5 class="font-weight-normal mb-0">Tổng Thua</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3 col-md-6">
            <div class="card card-img-holder text-default">
                <div class="row">
                    <div class="col-4">
                        <div class="card-img-absolute circle-icon bg-danger align-items-center text-center shadow-danger">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="fas fa-exclamation-triangle fs-30 text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="error"><?=count($list_user_day);?></span></h2>
                            <h5 class="font-weight-normal mb-0">Tổng Số Người Chơi</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <h3 class="text-white text-center">Tháng <?=date('m/Y');?>
        <span class="hand change-time" data-id="_revenueMonth"><i class="fas fa-calendar-alt"></i></span>
    </h3>
    <div class="row row-cards moneyMonth">
        <div class="col-sm-12 col-lg-4 col-md-6">
            <div class="card card-img-holder text-default bg-color">
                <div class="row">
                    <div class="col-3">
                        <div class="circle-icon bg-primary text-center align-self-center shadow-primary">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="far fa-money-bill fs-30  text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="receipt"><?= format_cash($his_month['SUM(`trans_amount`)']); ?></span>đ</h2>
                            <h5 class="font-weight-normal mb-0">Tổng Nhận</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 col-md-6">
            <div class="card card-img-holder text-default">
                <div class="row">
                    <div class="col-3">
                        <div class="card-img-absolute circle-icon bg-secondary align-items-center text-center shadow-secondary">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="far fa-satellite-dish fs-30 text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="minus"><?= format_cash($his_month['SUM(`bonus`)']); ?></span>đ
                            </h2>
                            <h5 class="font-weight-normal mb-0">Tổng Chi</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 col-md-6">
            <div class="card card-img-holder text-default">
                <div class="row">
                    <div class="col-3">
                        <div class="card-img-absolute circle-icon bg-info align-items-center text-center shadow-info">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="far fa-heart-rate fs-30 text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="earning"><?= format_cash(($his_month['SUM(`trans_amount`)']) - ($his_month['SUM(`bonus`)'])); ?></span>đ</h2>
                            <h5 class="font-weight-normal mb-0">Doanh Thu</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cards betMonth">
    <div class="col-sm-12 col-lg-3 col-md-6">
            <div class="card card-img-holder text-default bg-color">
                <div class="row">
                    <div class="col-4">
                        <div class="circle-icon bg-success text-center align-self-center shadow-success">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="fas fa-badge-check fs-30  text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="win"><?=$win_all['COUNT(*)'];?></span></h2>
                            <h5 class="font-weight-normal mb-0">Tổng Thắng</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3 col-md-6">
            <div class="card card-img-holder text-default">
                <div class="row">
                    <div class="col-4">
                        <div class="card-img-absolute circle-icon bg-gray align-items-center text-center shadow-gray">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="fas fa-window-close fs-30 text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="won"><?=$loss_all['COUNT(*)'];?></span></h2>
                            <h5 class="font-weight-normal mb-0">Tổng Thua</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3 col-md-6">
            <div class="card card-img-holder text-default">
                <div class="row">
                    <div class="col-4">
                        <div class="card-img-absolute circle-icon bg-danger align-items-center text-center shadow-danger">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="fas fa-exclamation-triangle fs-30 text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="error"><?=count($list_user);?></span></h2>
                            <h5 class="font-weight-normal mb-0">Tổng Số Người Chơi</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3 col-md-6">
            <div class="card card-img-holder text-default">
                <div class="row">
                    <div class="col-4">
                        <div class="card-img-absolute circle-icon bg-warning align-items-center text-center shadow-warning">
                            <img src="../templates/img/circle.svg" style="margin-left: 0px;" class="card-img-absolute">
                            <i class="fas fa-undo-alt fs-30 text-white mt-4"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body p-4">
                            <h2 class="mb-3"><span class="refund">0</span>
                            </h2>
                            <h5 class="font-weight-normal mb-0">Tổng Hoàn Tiền</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <img src="https://i.imgur.com/ORGB1aM.png" alt="" style="width: 30px">
                        Lịch Sử Đăng Nhập
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table
                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                            <thead class="badge-primary text-white">
                                <tr>
                                    <th>STT</th>
                                    <th class="text-white">Đường Dẫn</th>
                                    <th class="text-white">IP</th>
                                    <th class="text-white">Thời Gian</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $list = $soicoder->fetch_assoc("SELECT * FROM `log_admin` ORDER BY id desc LIMIT 10", 0);
                                if (count($list) == 0) { ?>
                                    <tr>
                                        <td colspan="24">
                                            <div class="text-center">
                                                <img src="https://i.imgur.com/1Ss076i.png">
                                                <p class="font-weight-bold">Không tìm thấy dữ liệu...</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } else { 
                                foreach ($list as $data) { ?>
                                    <tr>
                                        <td><?= $data['id']; ?></td>
                                        <td style="text-align: center"><?= $data['path']; ?></td>
                                        <td style="text-align: center"><?= $data['ip']; ?></td>
                                        <td style="text-align: center"><?= date('H:i:s d/m/Y', $data['time']); ?></td>
                                    </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-3">
                        <ul class="pagination-container">
                            <li class="page-item page-prev disabled" >
                                <a class="page-link"
                                    href="/adminPanel/block-player?page=1">Prev</a>
                            </li>
                            <li >
                                <a class="page-link"
                                    href="/adminPanel/block-player?page=2">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalTime" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thay Đổi Thời Gian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="get">
                        <input type="hidden" name="_revenueDay" value="2023-01-13">
                        <input type="hidden" name="_revenueMonth" value="2023-01">
                        <div class="form-group">
                            <label for="" class="form-label">Chọn ngày</label>
                            <input type="date" id="_revenueTime" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gray" data-dismiss="modal">Đóng</button>
                    <button class="btn btn-primary">Gửi</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</main>
<script>
function copy(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    alert("Sao Chép Thành Công");
    $temp.remove();
}
</script>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/footer.php'); ?>