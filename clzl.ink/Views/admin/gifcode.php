<?php session_start(); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/header.php'); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/navbar.php'); ?>
<main class="container">
    <div class="mainbar"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <!-- <img src="https://i.imgur.com/ORGB1aM.png" alt="" style="width: 30px"> -->
                        Danh Sách Gifcode
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
                                    <button type="button" class="btn btn-sm btn-primary action-block hand" data-toggle="modal" data-target="#addBlock">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </span>
                            </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="get">
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
                                    <a href="../adminPanel/block-player" class="btn btn-light text-danger">
                                        <i class="fas fa-times-circle"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive mb-3">
                        <table
                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                            <thead class="badge-primary text-white">
                                <tr>
                                    <th>STT</th>
                                    <th class="text-white">Code</th>
                                    <th class="text-white">Zalopay Trả Thưởng</th>
                                    <th class="text-white">Số Tiền Nhận</th>
                                    <th class="text-white">Tổng Tiền Đã Phát</th>
                                    <th class="text-white">Số Người Nhập</th>
                                    <th class="text-white">Thời gian Tạo</th>
                                    <td> Edit</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $list = $soicoder->fetch_assoc("SELECT * FROM `code` ORDER BY id desc LIMIT 1000", 0);
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
                                        <td style="text-align: center"><?= $data['id']; ?></td>
                                        <td style="text-align: center"><?= $data['code']; ?></td>
                                        <td style="text-align: center"><?= $data['zalopay_reward']; ?></td>
                                        <td style="text-align: center"><?= format_cash($data['money']); ?>đ</td>
                                        <td style="text-align: center"><?= format_cash($data['money'] * $data['entered']); ?>đ</td>
                                        <td style="text-align: center"><?= $data['entered']; ?>/<?= $data['limit_import']; ?></td>
                                        <td style="text-align: center"><?php if ($data['status'] == 'on') {
                                                                            echo "Hoạt Động";
                                                                        } else {
                                                                            echo "Đã Tắt";
                                                                        } ?></td>
                                        <td>
                                        <span class="input-group-btn ml-2">
                                            <button type="button" class="btn btn-sm btn-danger" onclick="delete_<?=$data['id'];?>()" id="button_<?=$data['id'];?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </span>
                                    </td>
                                    </tr>
                                    <script>
                                        function delete_<?=$data['id'];?>() {
                                            $.ajax({
                                                type: "POST",
                                                url: "/api/event/gifcode",
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <img src="https://i.imgur.com/WOPeUbU.png" alt="" style="width: 30px">
                        Lịch Sử Nhận Code
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
                            </span>
                        </div>
                    </div>
                    </form>
                    <div class="table-responsive table-mousewheel mb-3">
                        <table
                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                            <thead class="badge-primary text-white">
                                <tr>
                                    <th>STT</th>
                                    <th class="text-white">Code</th>
                                    <th class="text-white">Zalopay Nhận</th>
                                    <th class="text-white">Zalopay Trả Thưởng</th>
                                    <!-- <th class="text-white">Ngày</th> -->
                                    <th class="text-white">Số Tiền Nhận</th>
                                    <th class="text-white">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $history = $soicoder->fetch_assoc("SELECT * FROM `code_his` ORDER BY id desc LIMIT 500", 0);
                                if (count($history) == 0) { ?>
                                    <tr>
                                        <td colspan="24">
                                            <div class="text-center">
                                                <img src="https://i.imgur.com/1Ss076i.png">
                                                <p class="font-weight-bold">Không tìm thấy dữ liệu...</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } else {
                                    foreach ($history as $data) {
                                        ?>
                                    <tr>
                                        <td><?= $data['id']; ?></td>
                                        <td style="text-align: center"><?= $data['code']; ?></td>
                                        <td style="text-align: center"><?= $data['phone']; ?></td>
                                        <td style="text-align: center"><?= $data['zalopay_reward']; ?></td>
                                        <!-- <td style="text-align: center"><?= $data['day']; ?></td> -->
                                        <td style="text-align: center"><?= format_cash($data['money']); ?>đ</td>
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
                                    href="/adminPanel/history?page=1">Prev</a>
                            </li>
                            <li >
                                <a class="page-link"
                                    href="/adminPanel/history?page=2">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addBlock" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-code" aria-hidden="true"></i> Thêm Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formzalopay" method="POST" action="/api/event/gifcode">
                        <input type="hidden" name="type" value="add">
                        <div class="form-group">
                            <label for="" class="form-label">Số Điện Thoại</label>
                            <select class="form-control" name="zalopay_reward">
                                <option>Zalopay Thanh Toán</option>
                                <?php
                                $list = $soicoder->fetch_assoc("SELECT `id`, `phone`,`balance` FROM `zalopays` LIMIT 1000", 0);
                                foreach ($list as $data) { ?>
                                    <option value="<?= $data['phone']; ?>"><?= $data['phone']; ?> (<?=is_numeric($data['balance']) ? number_format($data['balance']) : 0;?>đ)</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Mã Code</label>
                            <input type="text" class="form-control" name="code" placeholder="Nhập Code" style="text-align: inherit" />
                        </div>
                        <div class="form-group">
                            <label for="name">Số Tiền Mỗi Người Nhận Khi Nhập Code</label>
                            <input type="text" class="form-control" name="money" placeholder="1000000" style="text-align: inherit" />
                        </div>
                        <div class="form-group">
                            <label for="name">Giới Giạn Số Người Nhập Code</label>
                            <input type="text" class="form-control" name="limit_import" placeholder="10" style="text-align: inherit" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-gray" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary" id="btnBlock">Thêm Ngay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/footer.php'); ?>