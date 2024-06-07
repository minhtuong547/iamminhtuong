<?php session_start(); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/header.php'); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/navbar.php'); ?>
<?php
// top
$top_up = $soicoder->fetch_assoc("SELECT * FROM `top_up` ", 0);
$top = $top_up[0];
$sdt_fake = $top_up[1];
$top_fake = $top_up[2];

?>
<main class="container">
    <div class="mainbar"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <img src="https://i.imgur.com/ORGB1aM.png" alt="" style="width: 30px">
                        Top Tuần
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
                    <div class="text-center mb-3">
                        <p>Mốc Đầu Tuần: <?php
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $time_week = strtotime("this week 00:00:00");
                            echo date('H:i:s d/m/Y', $time_week);
                        ?>
                        </p>
                    </div>
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
                                    <th class="text-white">Top</th>
                                    <th class="text-white">Số Điện Thoại</th>
                                    <th class="text-white">Tổng Chơi</th>
                                    <th class="text-white">Thưởng</th>
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
                                    if ($topreal['SUM(`trans_amount`)'] == 0) { continue; }
                                    $list_top[$phone] = $topreal['SUM(`trans_amount`)'];
                                }
                                arsort($list_top);
                                $dem = 0;
                                foreach ($list_top as $phone => $trans_amount) {
                                    $dem++;
                                    if ($dem > 5) {break;}
                                    ?>
                                    <tr>
                                        <td style="text-align: center"><?= $i++; ?></td>
                                        <td style="text-align: center"><?=$phone;?></td>
                                        <td style="text-align: center"><?=format_cash($trans_amount);?> đ</td>
                                        <td style="text-align: center"><?=format_cash($reward_top[$dem - 1]);?> đ</td>
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

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><img src="https://i.imgur.com/ORGB1aM.png" alt="" style="width: 30px">
                        Top Fake</h3>
                </div>
                <div class="card-body"> 
                    <form action="/api/settings/top_fake" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Top 1</label>
                                    <input type="text" name="sdt1" class="form-control" placeholder="037656115" value="<?= $sdt_fake['top1']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Top 2</label>
                                    <input type="text" name="sdt2" class="form-control" placeholder="082654234" value="<?= $sdt_fake['top2']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Top 3</label>
                                    <input type="text" name="sdt3" class="form-control" placeholder="092853652" value="<?= $sdt_fake['top3']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Top 4</label>
                                    <input type="text" name="sdt4" class="form-control" placeholder="085685654" value="<?= $sdt_fake['top4']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Top 5</label>
                                    <input type="text" name="sdt5" class="form-control" placeholder="095625458" value="<?= $sdt_fake['top5']; ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tiền chơi Top 1</label>
                                    <input type="text" name="top1" class="form-control" placeholder="5,000,000" value="<?= $top_fake['top1']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Tiền chơi Top 2</label>
                                    <input type="text" name="top2" class="form-control" placeholder="5,001,000" value="<?= $top_fake['top2']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Tiền chơi Top 3</label>
                                    <input type="text" name="top3" class="form-control" placeholder="3,000,000" value="<?= $top_fake['top3']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Tiền chơi Top 4</label>
                                    <input type="text" name="top4" class="form-control" placeholder="2,000,000" value="<?= $top_fake['top4']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Tiền chơi Top 5</label>
                                    <input type="text" name="top5" class="form-control" placeholder="1,000,000" value="<?= $top_fake['top5']; ?>" />
                                </div>
                            </div>
                            
                        
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-block btn-primary">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</main>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/footer.php'); ?>