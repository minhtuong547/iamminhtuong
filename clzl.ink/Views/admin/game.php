<?php session_start(); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/header.php'); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/navbar.php'); ?>
<style>
    .form-control {
        color: #333;
        opacity: 1;
    }
</style>
<main class="container">
    <div class="mainbar"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <img src="../assets/images/photos/result-reward.png" alt="" style="width: 30px"> Quản Lý Trả
                        Thưởng
                    </h3>
                    <div class="card-options">
                        <form action="" method="get" id="formPage">
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
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row gutters-xs">
                            <div class="col">
                                <input type="text" name="search" class="form-control" value=""
                                    placeholder="Nhập nội dung tìm kiếm....">
                            </div>
                            <span class="col-auto">
                                <button class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                                <a href="../adminPanel/reward" class="btn btn-light text-danger">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                    </form>
                    
                    <div class="table-responsive table-mousewheel mb-3">
                        <table
                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                            <thead class="badge-primary text-white">
                                <tr>
                                    <th class="text-white">Trò Chơi</th>
                                    <th class="text-white">Hiển Thị</th>
                                    <th class="text-white">Nội Dung</th>
                                    <th class="text-white">Không Nội Dung</th>
                                    <th class="text-white">Kết Quả</th>
                                    <th class="text-white">Tỉ Lệ</th>
                                    <th class="text-white">Mô Tả</th>
                                    <th class="text-white">Loại</th>
                                    <th class="text-white">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $list = $soicoder->fetch_assoc("SELECT * FROM `game`", 0);
                                foreach ($list as $data) {
                                ?>
                                <tr class="edit-one" data-id="<?=$data['game_code'];?>">
                                    <td class="gameType"><span class="badge badge-info"><?=$data['name'];?></span></td>
                                    <td style="text-align: center">
                                        <input class="form" type="checkbox" onclick="active_<?=$data['game_code'];?>()"
                                            <?=($data['status'] == 'on') ? "checked" : "";?>>
                                    </td>
                                    <td class="content-reward"><input class="form-control text-center" id="content-<?=$data['game_code'];?>" value="<?=$data['content'];?>"></td>
                                    <td class="content-reward"><input class="form-control text-center" id="content2-<?=$data['game_code'];?>" value="<?=$data['content2'];?>"></td>
                                    <td class="numberTLS"><input class="form-control text-center" id="result-<?=$data['game_code'];?>" value="<?=$data['result'];?>"></td>
                                    <td class="amount"><input class="form-control text-center" id="ratio-<?=$data['game_code'];?>" value="<?=$data['ratio'];?>"></td>
                                    <td class="description"><textarea id="description-<?=$data['game_code'];?>" class="form-control text-center" rows="3"><?=base64_decode($data['description']);?></textarea></td>
                                    <td class="resultType"><span class="badge badge-success"><?=$data['type'];?></span></td>
                                    <td>
                                        <span class="input-group-btn ml-2">
                                            <button type="button" class="btn btn-sm btn-primary" onclick="save_<?=$data['game_code'];?>('CL')" id="button_<?=$data['game_code'];?>">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        </span>
                                    </td>
                                </tr>
                                <script>
                                    function save_<?=$data['game_code'];?>() {
                                        var content = $("#content-<?=$data['game_code'];?>").val();
                                        var content2 = $("#content2-<?=$data['game_code'];?>").val();
                                        var result = $("#result-<?=$data['game_code'];?>").val();
                                        var ratio = $("#ratio-<?=$data['game_code'];?>").val();
                                        var description = $("#description-<?=$data['game_code'];?>").val();
                                        $.ajax({
                                            type: "POST",
                                            url: "/api/game/edit",
                                            data: {
                                                type: "edit",
                                                id: "<?=$data['id'];?>",
                                                content: content,
                                                content2: content2,
                                                result: result,
                                                ratio: ratio,
                                                description: description
                                            },
                                            dataType: "json",
                                            success: function(res) {
                                                if (res.success) {
                                                    alert(res.message);
                                                    // $("#getotp").html('Nhận Otp');
                                                } else {
                                                    alert(res.message);
                                                    // $("#getotp").html('Nhận Otp');
                                                }
                                            },
                                            error: function(err) {
                                                console.log(err);
                                            },
                                        });
                                        // }
                                    }
                                    function active_<?=$data['game_code'];?>() {
                                        $.ajax({
                                            type: "POST",
                                            url: "/api/game/edit",
                                            data: {
                                                type: "active",
                                                id: "<?=$data['id'];?>"
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
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addReward" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Kết Quả Trả Thưởng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="formReward" method="POST">
                        <div class="alert alert-warning">
                            <b>Lưu ý:</b>
                            <p>Nếu muốn tạo kết quả trả thưởng kiểu loại như tổng 3 số hoặc hiệu 3 số hoặc
                                tổng....<br>Thì đặt count_bao nhiêu
                                số cuối hoặc minus_bao nhiêu số cuối.<br><b>Example:</b> count_3 bằng tổng 3 số cuối của
                                giao dịch, minus_3 là hiệu 3 số cuối của giao dịch.</p>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Trò Chơi</label>
                            <select name="gameType" class="form-control">
                                <option value="CL_Game">Chẳn Lẻ - CL_Game</option>
                                <option value="TX_Game">Tài Xỉu - TX_Game</option>
                                <option value="CL2_Game">CL TX 2 - CL2_Game</option>
                                <option value="1/3_Game">1 Phần 3 - 1/3_Game</option>
                                <option value="Lo_Game">Lô - Lo_Game</option>
                                <option value="H3_Game">H3 - H3_Game</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Nội Dung</label>
                            <input type="text" name="content" class="form-control" placeholder="Nội dung chuyển tiền">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Kết Quả</label>
                            <textarea name="numberTLS" class="form-control"
                                placeholder="Mỗi kết quả cách nhau bằng dấu '-', ví dụ 1 - 2 - 3">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Tiền Thưởng</label>
                            <input type="text" name="amount" class="form-control"
                                placeholder="Nhập số tiền thưởng khi thắng ( tiền cược x tiền thưởng )">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Loại</label>
                            <input type="text" name="resultType" class="form-control"
                                placeholder="end là số cuối, count_ là tổng bao nhiêu số cuối, minus_ là hiệu bao nhiêu số cuối">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gray" data-dismiss="modal">Đóng</button>
                    <button class="btn btn-primary">Thêm</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/footer.php'); ?>