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
                        Kiểm Tra Mã Giao Dịch
                    </h3>
                </div>
                <div class="card-body">
                    <form action="/api/zalopay/check_mgd" method="post">
                        <div class="form-group">
                            <label for="" class="form-label">Số Điện Thoại</label>
                            <select class="form-control" name="account">
                                <option>Chọn danh sách Zalopay</option>
                                <?php
                                $list = $soicoder->fetch_assoc("SELECT `id`, `phone`,`balance` FROM `zalopays` LIMIT 1000", 0);
                                foreach ($list as $data) { ?>
                                    <option value="<?= $data['phone']; ?>"><?= $data['phone']; ?> (<?= format_cash($data['balance']); ?>đ)</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Người Nhận</label>
                            <input type="text" name="tranId" class="form-control"
                                placeholder="Nhập Mã Giao Dịch">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-exchange" aria-hidden="true"></i> Kiểm Tra</button>
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
                        Kết Quả
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
                                    <th>ID</th>
                                    <th class="text-white">Mã Giao Dịch</th>
                                    <th class="text-white">Zalopay Chuyển</th>
                                    <th class="text-white">Loại</th>
                                    <th class="text-white">Số Tiền</th>
                                    <th class="text-white">Nội Dung</th>
                                    <th class="text-white">Thời Gian</th>
                                    <th class="text-white">Trạng Thái</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (isset($_SESSION['check_mgd'])) { ?>
                                    <tr>
                                        <td style="text-align: center"><?= $_SESSION['check_mgd']['id']; ?></td>
                                        <td style="text-align: center"><?= $_SESSION['check_mgd']['trans_id']; ?></td>
                                        <td style="text-align: center"><?= $_SESSION['check_mgd']['partnerId']; ?></td>
                                        <td style="text-align: center"><?= $_SESSION['check_mgd']['type']; ?></td>
                                        <td style="text-align: center"><?= format_cash($_SESSION['check_mgd']['trans_amount']); ?>đ</td>
                                        <td style="text-align: center"><?= $_SESSION['check_mgd']['comment']; ?></td>
                                        <td style="text-align: center"><?= date('H:i:s d/m/Y', $_SESSION['check_mgd']['time']); ?></td>
                                        <td style="text-align: center">
                                            <pre><?= $_SESSION['check_mgd']['status']; ?></pre>
                                        </td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="24">
                                            <div class="text-center">
                                                <img src="https://i.imgur.com/1Ss076i.png">
                                                <p class="font-weight-bold">Không tìm thấy dữ liệu...</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
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