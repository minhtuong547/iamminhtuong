<?php session_start(); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/header.php'); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/navbar.php'); ?>
<?php

if (isset($_GET['perPage']) && is_numeric($_GET['perPage']) && $_GET['perPage'] > 0 && $_GET['perPage'] % 10 == 0) {
    $limit = $_GET['perPage'];
    $list = $soicoder->fetch_assoc("SELECT DISTINCT `phone` FROM `history` LIMIT ".$limit." ", 0);
} else {
    $list = $soicoder->fetch_assoc("SELECT DISTINCT `phone` FROM `history` ", 0);
}
// print_r($list);
?>
<main class="container">
    <div class="mainbar"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <img src="https://i.imgur.com/RUxn41Q.png" alt="" style="width: 30px">
                        Danh Sách Người Chơi
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
                    <div class="table-responsive mb-3">
                        <table
                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                            <thead class="badge-primary text-white">
                                <tr>
                                    <th>STT</th>
                                    <th class="text-white">Số Điện Thoại</th>
                                    <th class="text-white">Tổng Cược</th>
                                    <th class="text-white">Tổng Thắng</th>
                                    <th class="text-white">Lợi Nhuận</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($list) ==  0) {
                                ?>
                                <tr>
                                    <td colspan="12">
                                        <div class="text-center">
                                            <img src="https://i.imgur.com/1Ss076i.png">
                                            <p class="font-weight-bold">Không tìm thấy dữ liệu...</p>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                } else {
                                $i = 1;
                                foreach ($list as $data) {
                                    $phone = $data['phone'];
                                    $month = $soicoder->fetch_assoc("SELECT SUM(`trans_amount`),SUM(`bonus`) FROM `history` WHERE `trans_amount` >= 0 AND `time` >= '" . (time() - 2600640) . "' AND `phone` =  '" . $phone . "' ORDER BY trans_amount desc", 1);
                                ?>
                                <tr>
                                    <td style="text-align: center"><?= $i++; ?></td>
                                    <td style="text-align: center"><?= $phone; ?></td>
                                    <td style="text-align: center"><?= format_cash($month['SUM(`trans_amount`)']); ?>đ</td>
                                    <td style="text-align: center"><?= format_cash($month['SUM(`bonus`)']); ?>đ</td>
                                    <td style="text-align: center"><?= format_cash($month['SUM(`trans_amount`)'] - $month['SUM(`bonus`)']); ?>đ</td>
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-3">
                        <ul class="pagination-container">
                            <li class="page-item page-prev disabled" >
                                <a class="page-link"
                                    href="/adminPanel/player?page=1">Prev</a>
                            </li>
                            <li >
                                <a class="page-link"
                                    href="/adminPanel/player?page=2">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/footer.php'); ?>