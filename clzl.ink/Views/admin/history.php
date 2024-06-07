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
                        <img src="https://i.imgur.com/WOPeUbU.png" alt="" style="width: 30px">
                        Lịch Sử Giao Dịch
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
                                <input type="text" id="search-input" class="form-control" placeholder="Nhập nội dung tìm kiếm....">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-mousewheel mb-3">
                        <table
                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                            <thead class="badge-primary text-white">
                                <tr>
                                    <th></th>
                                    <th class="text-white">SĐT nhận</th>
                                    <th class="text-white">SĐT gửi</th>
                                    <th class="text-white">Mã giao dịch</th>
                                    <th class="text-white">Comment</th>
                                    <th class="text-white">Số tiền chơi</th>
                                    <th class="text-white">Số tiền nhận</th>
                                    <th class="text-white">Status</th>
                                    <th class="text-white">Số Dư Sau GD</th>
                                    <th class="text-white">Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $status = empty($_GET['status']) ? "ALL" : check_string($_GET['status']);
                            if ($status == "ALL") {
                                $list = $soicoder->fetch_assoc("SELECT * FROM `history` ORDER BY trans_time desc LIMIT 1000", 0);
                            } else {
                                $list = $soicoder->fetch_assoc("SELECT * FROM `history` WHERE (status = 'wait' OR status = 'wait_tt') ORDER BY id desc LIMIT 1000", 0);
                            }
                            if (count($list) ==  0) {
                                ?>
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
                                ?>
                                <tr>
                                    <td style="text-align: center"><b><?= $data['id']; ?></b></td>
                                    <td style="text-align: center"><?= $data['account']; ?></td>
                                    <td style="text-align: center"><?= $data['phone']; ?></td>
                                    <td style="text-align: center"><a id="trans_<?= $data['trans_id']; ?>" href="/<?=config_admin;?>/history/more?trans_id=<?= $data['trans_id']; ?>" title="Nhấn để xem chi tiết"><?= $data['trans_id']; ?></a> <a onclick="copy('#trans_<?= $data['trans_id']; ?>')"><i class="fa fa-copy"></i></a></td>
                                    <td style="text-align: center"><input class="form-control text-center" value="<?= $data['description']; ?>"></td>
                                    <td style="text-align: center"><?= format_cash($data['trans_amount']); ?>đ</td>
                                    <td style="text-align: center"><?= is_numeric($data['bonus']) ? format_cash($data['bonus']) : 0; ?>đ (x<?= $data['amount_game']; ?><?= ($data['phone_result'] == 'undefined') ? '' : ' - '.$data['phone_result']; ?>)</td>
                                    <td style="text-align: center"><?php if ($data['result'] == 'win' && $data['status'] == 'done') { echo '<span class="badge light badge-success">Đã Trả Thưởng</span>'; } else if ($data['status'] == 'wrong') { echo '<span class="badge light badge-warning">Sai Min Max</span>'; } else if ($data['status'] == 'waiting') { echo '<span class="badge light badge-warning">Đang Xử Lý</span>'; } else if ($data['status'] == 'block') { echo '<span class="badge light badge-warning">Win + Block</span>'; } else if ($data['status'] == 'wait_tt') { echo '<span class="badge light badge-dark">'.$data['status_text'].'</span>'; } else if ($data['status'] == 'wrong_content') { echo '<span class="badge light badge-info">Sai Nội Dung</span>'; } else if ($data['status'] == 'late') { echo '<span class="badge light badge-warning">Số Đã Tắt Hoặc Chưa Đăng Nhập</span>'; } else if ($data['status_text'] !== 'success') { echo '<span class="badge light badge-danger">Lỗi</span>';} else { echo '<span class="badge light badge-danger">Thua</span>'; } ?></td>
                                    <td style="text-align: center"><?= $data['status'] == 'done' ? format_cash($data['balance_snapshot'] - $data['bonus']) : format_cash($data['balance_snapshot']); ?>đ</td>
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
    <div class="modal fade" id="modalRework" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Trả Thưởng Giao Dịch <b id="transId" class="text-primary">#</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="formRework">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Mã Giao Dịch</label>
                            <input type="text" name="transId" class="form-control" readonly="true">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Số Điện Thoại</label>
                            <select name="phone" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-gray" data-dismiss="modal">Đóng</button>
                        <button class="btn btn-primary">Thực Hiện</button>
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
</script>
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