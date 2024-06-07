<?php session_start(); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/header.php'); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/navbar.php'); ?>
<?php
if (isset($_GET['action'])) {
    $id = $_GET['action'];
    $value = $_GET['value'];
    if ($value == 'done') {
        $soicoder->update("history", array(
            'status' => 'done',
            'status_text' => 'Đã Thanh Toán Tay'
        ), "`id` = '$id' ");
    } else if ($value == 'wait_next') {
        $soicoder->update("history", array(
            'status' => 'wait_auto',
            'status_text' => 'Đợi Thanh Toán Vào Hôm Sau'
        ), "`id` = '$id' ");
    } else {
        echo '<script type="text/javascript">alert("Thanh Toán Ngay Tạm Thời Lỗi");setTimeout(function(){ location.href = "/'.config_admin.'/history-error" },500);</script>';
        die;
    }
    echo '<script type="text/javascript">alert("Chỉnh Sửa Thành Công");setTimeout(function(){ location.href = "/'.config_admin.'/history-error" },500);</script>';
    die;
}
?>
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
                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center" style="margin-bottom: 50px">
                            <thead class="badge-primary text-white">
                                <tr>
                                    <th>STT</th>
                                    <th class="text-white">SĐT nhận</th>
                                    <th class="text-white">SĐT gửi</th>
                                    <th class="text-white">Mã giao dịch</th>
                                    <th class="text-white">Comment</th>
                                    <th class="text-white">Số tiền chơi</th>
                                    <th class="text-white">Số tiền nhận</th>
                                    <th class="text-white">Loại Lỗi</th>
                                    <th class="text-white">Actions</th>
                                    <th class="text-white">Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $list = $soicoder->fetch_assoc("SELECT * FROM `history` WHERE (status = 'wait' OR status = 'wait_tt') ORDER BY id desc", 0);
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
                                    
                                    <td style="text-align: center"><?= $data['trans_id']; ?></td>
                                    <td style="text-align: center"><?= $data['description']; ?></td>
                                    <td style="text-align: center"><?= format_cash($data['trans_amount']); ?>đ</td>
                                    <td style="text-align: center"><?= is_numeric($data['bonus']) ? format_cash($data['bonus']) : 0; ?>đ (x<?= $data['amount_game']; ?>)</td>
                                    <td style="text-align: center"><?= $data['status_text']; ?></td>
                                    <td class="table__actions dropdown">
                                        <p role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg viewBox="64 64 896 896" focusable="false" data-icon="setting" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                <path d="M924.8 625.7l-65.5-56c3.1-19 4.7-38.4 4.7-57.8s-1.6-38.8-4.7-57.8l65.5-56a32.03 32.03 0 009.3-35.2l-.9-2.6a443.74 443.74 0 00-79.7-137.9l-1.8-2.1a32.12 32.12 0 00-35.1-9.5l-81.3 28.9c-30-24.6-63.5-44-99.7-57.6l-15.7-85a32.05 32.05 0 00-25.8-25.7l-2.7-.5c-52.1-9.4-106.9-9.4-159 0l-2.7.5a32.05 32.05 0 00-25.8 25.7l-15.8 85.4a351.86 351.86 0 00-99 57.4l-81.9-29.1a32 32 0 00-35.1 9.5l-1.8 2.1a446.02 446.02 0 00-79.7 137.9l-.9 2.6c-4.5 12.5-.8 26.5 9.3 35.2l66.3 56.6c-3.1 18.8-4.6 38-4.6 57.1 0 19.2 1.5 38.4 4.6 57.1L99 625.5a32.03 32.03 0 00-9.3 35.2l.9 2.6c18.1 50.4 44.9 96.9 79.7 137.9l1.8 2.1a32.12 32.12 0 0035.1 9.5l81.9-29.1c29.8 24.5 63.1 43.9 99 57.4l15.8 85.4a32.05 32.05 0 0025.8 25.7l2.7.5a449.4 449.4 0 00159 0l2.7-.5a32.05 32.05 0 0025.8-25.7l15.7-85a350 350 0 0099.7-57.6l81.3 28.9a32 32 0 0035.1-9.5l1.8-2.1c34.8-41.1 61.6-87.5 79.7-137.9l.9-2.6c4.5-12.3.8-26.3-9.3-35zM788.3 465.9c2.5 15.1 3.8 30.6 3.8 46.1s-1.3 31-3.8 46.1l-6.6 40.1 74.7 63.9a370.03 370.03 0 01-42.6 73.6L721 702.8l-31.4 25.8c-23.9 19.6-50.5 35-79.3 45.8l-38.1 14.3-17.9 97a377.5 377.5 0 01-85 0l-17.9-97.2-37.8-14.5c-28.5-10.8-55-26.2-78.7-45.7l-31.4-25.9-93.4 33.2c-17-22.9-31.2-47.6-42.6-73.6l75.5-64.5-6.5-40c-2.4-14.9-3.7-30.3-3.7-45.5 0-15.3 1.2-30.6 3.7-45.5l6.5-40-75.5-64.5c11.3-26.1 25.6-50.7 42.6-73.6l93.4 33.2 31.4-25.9c23.7-19.5 50.2-34.9 78.7-45.7l37.9-14.3 17.9-97.2c28.1-3.2 56.8-3.2 85 0l17.9 97 38.1 14.3c28.7 10.8 55.4 26.2 79.3 45.8l31.4 25.8 92.8-32.9c17 22.9 31.2 47.6 42.6 73.6L781.8 426l6.5 39.9zM512 326c-97.2 0-176 78.8-176 176s78.8 176 176 176 176-78.8 176-176-78.8-176-176-176zm79.2 255.2A111.6 111.6 0 01512 614c-29.9 0-58-11.7-79.2-32.8A111.6 111.6 0 01400 502c0-29.9 11.7-58 32.8-79.2C454 401.6 482.1 390 512 390c29.9 0 58 11.6 79.2 32.8A111.6 111.6 0 01624 502c0 29.9-11.7 58-32.8 79.2z">
                                                </path>
                                            </svg>
                                        </p>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <ul style="z-index: 10000;">
                                                <li class="dropdown-item">
                                                    <p data-toggle="modal" data-target="#exampleModal">
                                                        <p><a href="?action=<?= $data['id']; ?>&value=done">Đã Thanh Toán</a></p>
                                                    </p>
                                                </li>
                                                <li class="dropdown-item">
                                                    <p data-toggle="modal" data-target="#exampleModal">
                                                        <p><a href="/api/zalopay/payback?id=<?= $data['id']; ?>">Thanh Toán Ngay</a></p>
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
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
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/footer.php'); ?>