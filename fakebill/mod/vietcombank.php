<?php require_once('../include/head.php'); ?>
<?php require_once('../include/nav.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card" style="max-width: 1000px; margin: auto;">
    <div class="card-body">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <li class="d-flex mb-4 pb-1">
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Fake Bill Chuyển Tiền: <b style="color:#00e3cc;">Vietcombank</b>
                </h6>
              </div>
            </div>
          </li>
          <form id="td-vietcombank" method="POST">
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label" for="thanhdieudeptrai">STK nhận</label>
              <div class="col-sm-9">
                <input type="number" id="stk" name="stk" required="" class="form-control" placeholder="Số tài khoản người nhận">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label" for="thanhdieudeptrai">Tên người nhận</label>
              <div class="col-sm-9">
                <input type="text" id="name_nhan" name="name_nhan" required="" class="form-control" placeholder="Tên người nhận">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label" for="thanhdieudeptrai">Số tiền chuyển</label>
              <div class="col-sm-9">
                <input type="number" id="amount" name="amount" required="" class="form-control" placeholder="Ví dụ: 100000">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label" for="thanhdieudeptrai">Nội dung chuyển khoản</label>
              <div class="col-sm-9">
                <textarea type="text" id="noidung" name="noidung" required class="form-control" placeholder="chuyển tiền"></textarea>
              </div>
            </div>
            <div class="row mb-3" id="magiaodichx">
              <label class="col-sm-3 col-form-label" for="thanhdieudeptrai">Mã giao dịch</label>
              <div class="col-sm-9">
                <input type="text" id="magiaodich" name="magiaodich" class="form-control" placeholder="Mã giao dịch" value="<?php echo(rand(1000000000,10000000000));?>">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label" for="thanhdieudeptrai">Thời gian chuyển tiền</label>
              <div class="col-sm-9">
                <input type="text" id="time1" name="time1" required="" class="form-control" placeholder="Time" value="<?php echo $now;?>">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label" for="thanhdieudeptrai">Giờ chuyển</label>
              <div class="col-sm-9">
                <input type="text" id="giochuyen" name="giochuyen" required="" class="form-control" placeholder="Giờ chuyển khoản" value="<?php date_default_timezone_set('Asia/Ho_Chi_Minh');echo date('H:i');?>">
              </div>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary waves-effect waves-light">Tạo bill (miễn phí)</button>
            </div>
          </form>
        </div>
        <div id="creator-success"></div>
        <div id="download-img"></div>
        <div id="done-fakebill-td"></div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    $('#td-vietcombank').submit(function(e) {
        e.preventDefault();
        var submitButton = $(this).find('button[type="submit"]');
        submitButton.html('Đang fake bill...').prop('disabled', true);
        showToastrNotification('info', 'Đang tạo bill...', 'Thông báo');
        var randomDelay = Math.floor(Math.random() * (2000 - 1000 + 1)) + 1000;
        setTimeout(function() {
            var formData = $('#td-vietcombank').serialize();
            $.ajax({
                type: 'POST',
                url: 'ajax/vietcombank.php',
                data: formData,
                success: function(response) {
                    $('#creator-success').html('');
                    $('#download-img').html('');
                    $('#done-fakebill-td').html('');
                    $('#creator-success').html('<br/><p class="alert alert-success mb-3">Đã tạo ảnh fake-bill thành công!</p>');
                    $('#download-img').html('<a href="data:image/jpeg;base64,' + response + '" download="bill-vietcom.jpg" class="btn btn-success">Tải Bill Xuống</a><br/><br/>');
                    var image = $('<img>').attr('src', 'data:image/jpeg;base64,' + response);
                    $('#done-fakebill-td').append(image);
                    showToastrNotification('success', 'Tạo thành công <3', 'Thông báo');
                    submitButton.html('thành công, nhấn để tạo lại').prop('disabled', false);
                },
                error: function(error) {
                    console.log(error);
                    showToastrNotification('error', 'Tạo thất bại...', 'Thông báo');
                    submitButton.html('Tạo bill (miễn phí)').prop('disabled', false);
                }
            });
        }, randomDelay);
    });
});
</script>
<?php require_once('../include/foot.php'); ?>