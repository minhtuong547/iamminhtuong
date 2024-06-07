<?php session_start(); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/header.php'); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/navbar.php'); ?>
<main class="container">
    <div class="mainbar"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><img src="https://i.imgur.com/QxyXPDQ.png" alt="" style="width: 30px">
                        Quản Lý Tài Khoản Zalopay </h3>
                    <div class="card-options">
                        <form action="" id="formPage" method="get">
                            <div class="input-group">
                                <select name="perPage" class="form-control form-control-sm"
                                    onchange="$('#formPage').submit();">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="500">500</option>
                                    <option value="1000">1000</option>
                                </select>
                                <span class="input-group-btn ml-2">
                                    <button type="button" class="btn btn-sm btn-primary action-zalopay" data-toggle="modal" data-target="#addzalopay">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <?php $sum = $list = $soicoder->fetch_assoc("SELECT SUM(`balance`) FROM `zalopays` ", 1); ?>
                        <span class="badge badge-primary p-3">Tổng: <?=number_format($sum['SUM(`balance`)']);?> vnđ</span>
                        <button type="button" class="badge badge-success p-3" style="border: none;"><a  href="/api/zalopay/reload_balance" style="text-decoration: none; color:#fff;">Cập Nhật Số Dư</a></button>
                        <button type="button" class="badge badge-danger p-3 action-zalopay" style="border: none;" data-toggle="modal" data-target="#Instruct">
                            Hướng Dẫn
                        </button>
                    </div>
                    <div class="form-group">
                        <div class="row gutters-xs">
                            <div class="col">
                                <input type="text" id="search-input" class="form-control" placeholder="Nhập nội dung tìm kiếm....">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-mousewheel mb-3">
                        <table
                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                            <thead class="badge-primary text-white">
                                <tr>
                                    <th>STT</th>
                                    <th class="text-white">Số Điện Thoại</th>
                                    <th class="text-white">Hiển Thị</th>
                                    <!-- <th class="text-white">Auto</th> -->
                                    <th class="text-white">Số Dư</th>
                                    <th class="text-white">Tên Tài Khoản</th>
                                    <th class="text-white">Số Lần</th>
                                    <th class="text-white">Chuyển Ngày</th>
                                    <th class="text-white">Nhận Ngày</th>
                                    <th class="text-white">Chuyển Tháng</th>
                                    <th class="text-white">Nhận Tháng</th>
                                    <th class="text-white">Cược Min</th>
                                    <th class="text-white">Cược Max</th>
                                    <?php if ($settings['type_reward'] == 'option') { ?>
                                        <th class="text-white">Số Zalopay Thanh Toán</th>
                                        <th class="text-white">Hạn Mức Chuyển Tiền</th>
                                        <th class="text-white">Số Tiền Chuyển</th>
                                    <?php } ?>
                                    <th class="text-white">Trạng Thái</th>
                                    <th class="text-white">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $list = $soicoder->fetch_assoc("SELECT * FROM `zalopays` ORDER BY id desc LIMIT 1000", 0);
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
                                foreach ($list as $data) {
                                    // ngày
                                    $info_phone = $soicoder->fetch_assoc("SELECT SUM(`trans_amount`) FROM `history` WHERE `date` = '" . date('d/m/Y') . "' AND `account` =  '" . $data['phone'] . "'", 1);
                                    $info_chyen = $soicoder->fetch_assoc("SELECT SUM(`bonus`),COUNT(*) FROM `history` WHERE `bonus` > 0 AND `date` = '" . date('d/m/Y') . "' AND `account` =  '" . $data['phone'] . "'", 1);
                                    $info_chuyentien = $soicoder->fetch_assoc("SELECT SUM(`amount`),COUNT(*) FROM `chuyen_tien` WHERE `date_time` = '" . date('d/m/Y') . "' AND `ownerNumber` =  '" . change_phone($data['phone']) . "'", 1);
                                    $level = $info_phone['SUM(`trans_amount`)']; // tổng số tiền nhận trong ngày
                                    $sum_gd = $info_chyen['COUNT(*)'] + $info_chuyentien['COUNT(*)']; // tổng số giao dịch chuyển trong ngày
                                    $sum_chuyentien = $info_chuyentien['SUM(`amount`)'] + $info_chyen['SUM(`bonus`)']; // tổng số tiền chuyển trong ngày
                                    // tháng
                                    $time_month = strtotime('first day of this month');
                                    $info_phone_month = $soicoder->fetch_assoc("SELECT SUM(`trans_amount`) FROM `history` WHERE `time` >= '" . $time_month . "' AND `account` =  '" . $data['phone'] . "'", 1);
                                    $info_chyen_month = $soicoder->fetch_assoc("SELECT SUM(`bonus`) FROM `history` WHERE `bonus` > 0 AND `date` = '" . $time_month . "' AND `account` =  '" . $data['phone'] . "'", 1);
                                    $level_month = $info_phone_month['SUM(`trans_amount`)']; // tổng số tiền nhận trong ngày
                                    $info_chuyentien_month = $soicoder->fetch_assoc("SELECT SUM(`amount`) FROM `chuyen_tien` WHERE `date_time` = '" . $time_month . "' AND `ownerNumber` =  '" . change_phone($data['phone']) . "'", 1);
                                    $sum_chuyentien_month = $info_chuyentien_month['SUM(`amount`)'] + $info_chyen_month['SUM(`bonus`)']; // tổng số tiền chuyển trong ngày
                                ?>
                                <tr class="edit-one" data-id="63c031544e1be7605973fcd8">
                                    <td class="stt"><?=$data['id'];?></td>
                                    <td class="phone"><?=$data['phone'];?></td>
                                    <td style="text-align: center">
                                        <input class="form" type="checkbox" id="active"
                                            onclick="active(<?= $data['id']; ?>)"
                                            <?=($data['pay'] == 'on') ? "checked" : "";?>>
                                    </td>
                                    <!-- <td style="text-align: center">
                                        <input class="form" type="checkbox" id="auto"
                                            onclick="auto(<?= $data['id']; ?>)"
                                            <?=($data['auto'] == 'on') ? "checked" : "";?>>
                                    </td> -->
                                    <td class="balance"><?=is_numeric($data['balance']) ? number_format($data['balance']) : 0;?> VNĐ</td>
                                    <td class="name"><?=$data['name'];?></td>
                                    <td><?= $sum_gd; ?>/<?=$settings['limit_gd'];?> Lần</td>
                                    <td><?= format_cash($sum_chuyentien); ?>đ/<?=($settings['limit_monney_day']/1000000);?>M</td>
                                    <td><?= format_cash($level); ?>đ</td>
                                    <td><?= ($settings['noti_status'] == 'on') ? format_cash($data['ex_mon']) : format_cash($sum_chuyentien_month); ?>đ/<?=($settings['limit_monney_month']/1000000);?>M</td>
                                    <td><?= ($settings['noti_status'] == 'on') ? format_cash($data['receive_mon']) : format_cash($level_month); ?>đ</td>
                                    <td>
                                        <input class="form-control text-center" id="min-<?=$data['id'];?>" value="<?=$data['min'];?>">
                                    </td>
                                    <td>
                                        <input class="form-control text-center" id="max-<?=$data['id'];?>" value="<?=$data['max'];?>">
                                    </td>
                                    <?php if ($settings['type_reward'] == 'option') {
                                        $loadDATA =  $soicoder->fetch_assoc("SELECT * FROM `zalopays` WHERE `phone` = '" . $data['reward'] . "' LIMIT 1 ", 1);
                                        ?>
                                        <td>
                                        <select class="form-control" id="reward-<?=$data['id'];?>">
                                            <option value="<?=$data['reward'];?>"><?=$data['reward'];?> (<?=is_numeric($loadDATA['balance']) ? number_format($loadDATA['balance']) : 0;?>đ)</option>
                                            <?php
                                            $list_reward = $soicoder->fetch_assoc("SELECT `id`, `phone`,`balance` FROM `zalopays` WHERE `phone` <> '".$data['reward']."' LIMIT 1000", 0);
                                            foreach ($list_reward as $data_reward) {
                                                ?>
                                                <option value="<?= $data_reward['phone']; ?>"><?= $data_reward['phone']; ?> (<?=is_numeric($data_reward['balance']) ? number_format($data_reward['balance']) : 0;?>đ)</option>
                                            <?php } ?>
                                        </select>
                                        </td>
                                        <td>
                                            <input class="form-control text-center" id="limit_send-<?=$data['id'];?>" value="<?=$data['limit_send'];?>">
                                        </td>
                                        <td>
                                            <input class="form-control text-center" id="money_send-<?=$data['id'];?>" value="<?=$data['money_send'];?>">
                                        </td>
                                    <?php } ?>
                                    <td class="errorDesc"><span class="badge badge-success"><?=$data['errorDesc'];?></span></td>
                                    <td>
                                        <span class="input-group-btn ml-2">
                                            <button type="button" class="btn btn-sm btn-primary" onclick="save_<?=$data['id'];?>()" id="button_<?=$data['id'];?>">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="delete_<?=$data['id'];?>()" id="button_<?=$data['id'];?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </span>
                                    </td>
                                </tr>
                                <script>
                                    function save_<?=$data['id'];?>() {
                                        <?php if ($settings['type_reward'] == 'option') { ?>
                                        var reward = $("#reward-<?=$data['id'];?>").val();
                                        <?php } ?>
                                        var min = $("#min-<?=$data['id'];?>").val();
                                        var max = $("#max-<?=$data['id'];?>").val();
                                        $.ajax({
                                            type: "POST",
                                            url: "/api/zalopay/edit",
                                            data: {
                                                type: "edit",
                                                id: "<?=$data['id'];?>",
                                                <?php if ($settings['type_reward'] == 'option') { ?>
                                                reward: reward,
                                                <?php } ?>
                                                min: min,
                                                max: max
                                            },
                                            dataType: "json",
                                            success: function(res) {
                                                if (res.success) {
                                                    alert(res.message);
                                                    location.reload();
                                                } else {
                                                    alert(res.message);
                                                }
                                            },
                                            error: function(err) {
                                                console.log(err);
                                            },
                                        });
                                        // }
                                    }
                                    function delete_<?=$data['id'];?>() {
                                        $.ajax({
                                            type: "POST",
                                            url: "/api/zalopay/edit",
                                            data: {
                                                type: "delete",
                                                id: "<?=$data['id'];?>"
                                            },
                                            dataType: "json",
                                            success: function(res) {
                                                if (res.success) {
                                                    alert(res.message);
                                                } else {
                                                    alert(res.message);
                                                }
                                            },
                                            error: function(err) {
                                                console.log(err);
                                            },
                                        });
                                        // }
                                    }
                                </script>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-3">
                        <ul class="pagination-container">
                            <li class="page-item page-prev disabled" >
                                <a class="page-link"
                                    href="/admin/zalopay?page=1">Prev</a>
                            </li>
                            <li >
                                <a class="page-link"
                                    href="/admin/zalopay?page=2">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Instruct" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hướng Dẫn & Lưu Ý</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="momo__card__info">
                        <div class="momo__card__info__notify">
                            <p>
                                - Cài đặt kiểu trả thưởng và kiểu thống kê nhận/chuyển tháng trong "Cài Đặt Hệ Thống"
                            </p>
                            <p>
                                - <b style="color:red;">Login</b> (bấm vào dấu "+" góc trên bên phải, khi login các bill trước đó sẽ không được thanh toán)
                            </p>
                            <p>
                                - <b style="color:red;">Cập Nhật Số Dư</b> (Cập nhật trạng thái zalopay, số dư và tổng nhận/chuyển trong tháng)
                            </p>
                            <p>
                                - <b style="color:red;">Bật hoạt động</b> (bật cron thanh toán và hiển thị)
                            </p>
                            <p>
                                - <b style="color:red;">Tắt hoạt động</b> (reset lại thời gian login, khi bật số lại các bill trước đó sẽ không được thanh toán)
                            </p>
                            <p>
                                - <b style="color:red;">Auto</b> (hiển thị số hoặc dự bị)
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-gray" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addzalopay" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Tài Khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formzalopay" method="POST" action="/api/zalopay/login">
                        <input type="hidden" name="type_login" value="<?=$settings['type_login'];?>">
                        <div class="form-group">
                            <label for="" class="form-label">Số Điện Thoại</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" maxlength="10">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Mật Khẩu</label>
                            <input type="text" name="password" class="form-control" placeholder="Nhập mật khẩu">
                        </div>
                        <?php
                        if ($settings['type_login'] == 'app') { ?>
                            <div class="form-group">
                                <label for="" class="form-label">OTP</label>
                                <input type="text" name="otp" class="form-control" placeholder="Nhập mã otp">
                            </div>
                        <?php } else { ?>
                            <div class="form-group">
                                <label for="" class="form-label">Cookie Zalo</label>
                                <!-- <input type="text" name="cookie" class="form-control" placeholder="Nhập cookie web"> -->
                                <textarea name="cookie" class="form-control" rows="3" placeholder="Nhập cookie web"></textarea>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-gray" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" data-action="otp">Đăng Nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<script>
    // Lấy dữ liệu từ bảng
    var tableData = document.querySelectorAll("table tbody tr");
    // Lấy nội dung của ô tìm kiếm
    var searchInput = document.getElementById("search-input");

    // Sự kiện tìm kiếm khi người dùng nhập vào ô tìm kiếm
    searchInput.addEventListener("input", function() {
        // Lấy giá trị tìm kiếm
        var searchValue = this.value.toLowerCase();

        // Lọc dữ liệu trong bảng dựa trên giá trị tìm kiếm
        var filteredData = Array.from(tableData).filter(function(tr) {
        var trData = tr.innerText.toLowerCase();
        return trData.indexOf(searchValue) !== -1;
        });

        // Hiển thị dữ liệu đã lọc
        tableData.forEach(function(tr) {
        tr.style.display = "none";
        });
        filteredData.forEach(function(tr) {
        tr.style.display = "table-row";
        });
    });
    function active(id) {
        $.ajax({
            type: "POST",
            url: "/api/zalopay/edit",
            data: {
                type: "active",
                id: id
            },
            dataType: "json",
            success: function(res) {
                if (res.success) {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            },
            error: function(err) {
                console.log(err);
            },
        });
    }

    function view(id) {
        $.ajax({
            url: '/api/zalopay/edit?type=view&id=' + id + '',
            success: function(d) {
                alert(d);
            }
        });
    }

    function auto(id) {
        $.ajax({
            type: "POST",
            url: "/api/zalopay/edit",
            data: {
                type: "auto",
                id: id
            },
            dataType: "json",
            success: function(res) {
                if (res.success) {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            },
            error: function(err) {
                console.log(err);
            },
        });
    }
</script>
<script>
    function getotp() {
        $("#getotp").html('<i class="fas fa-spinner fa-spin"></i>Vui Lòng Chờ');
        var phone = $("#phone").val();
        $.ajax({
            type: "POST",
            url: "/api/zalopay/sendopt",
            data: {
                phone
            },
            dataType: "json",
            success: function(res) {
                if (res.success) {
                    alert(res.message);
                    $("#getotp").html('Nhận Otp');
                } else {
                    alert(res.message);
                    $("#getotp").html('Nhận Otp');
                }
            },
            error: function(err) {
                console.log(err);
            },
        });
        // }
    }
</script>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/footer.php'); ?>