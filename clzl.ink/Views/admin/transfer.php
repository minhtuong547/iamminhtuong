<?php session_start();?>
<?php require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/header.php';?>
<?php require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/navbar.php';?>
<main class="container">
    <div class="mainbar"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <img src="https://i.imgur.com/fcT9NGa.png" alt="" style="width: 30px">
                        Chuyển Tiền
                    </h3>
                </div>
                <div class="card-body">
                    <form action="/api/zalopay/sendmoney" method="post">
                        <div class="form-group">
                            <label for="" class="form-label">Số Điện Thoại</label>
                            <select class="form-control" name="account">
                                <option>Chọn danh sách Zalopay</option>
                                <?php
                                $list = $soicoder->fetch_assoc("SELECT `id`, `phone`,`balance` FROM `zalopays`", 0);
                                foreach ($list as $data) { ?>
                                    <option value="<?= $data['phone']; ?>"><?= $data['phone']; ?> (<?=is_numeric($data['balance']) ? number_format($data['balance']) : 0;?>đ)</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Người Nhận</label>
                            <input type="text" name="receiver" class="form-control"
                                placeholder="Nhập số điện thoại người nhận">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Số Tiền</label>
                            <input type="number" name="amount" class="form-control"
                                placeholder="Nhập số tiền cần chuyển">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Nội Dung</label>
                            <input type="text" name="comment" class="form-control"
                                placeholder="Nhập nội dung cần chuyển">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Mật Khẩu Zalopay</label>
                            <input type="text" name="password" class="form-control"
                                placeholder="Nhập mật khẩu zalopay">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-exchange" aria-hidden="true"></i> Chuyển Tiền</button>
                        </div>
                    </form>
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
                        Lịch Sử Chuyển Tiền
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
                                    <th></th>
                                    <!-- <th class="text-white">ID</th> -->
                                    <th class="text-white">Mã Giao Dịch</th>
                                    <th class="text-white">Zalopay Chuyển</th>
                                    <th class="text-white">Zalopay Nhận</th>
                                    <th class="text-white">Số Tiền</th>
                                    <th class="text-white">Nội Dung</th>
                                    <th class="text-white">Số Dư Cuối</th>
                                    <th class="text-white">Trạng Thái</th>
                                    <th class="text-white">Thời Gian</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $history = $soicoder->fetch_assoc("SELECT * FROM `chuyen_tien` WHERE `type_gd` = 'sendmoney' ORDER BY id desc", 0);
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
                                    foreach ($history as $data) {
                                        ?>
                                    <tr>
                                        <td><?= $data['id']; ?></td>
                                        <td style="text-align: center"><?= $data['tranId']; ?></td>
                                        <td><?= $data['ownerNumber']; ?></td>
                                        <td><?= $data['partnerId']; ?></td>
                                        
                                        <td><?= format_cash($data['amount']); ?>đ</td>
                                        <td style="text-align: center"><?= $data['comment']; ?></td>
                                        <td style="text-align: center"><?= format_cash($data['balance']); ?></td>
                                        <td style="text-align: center">
                                            <pre><?= $data['message']; ?></pre>
                                        </td>
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
</main>
<?php require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/footer.php';?>