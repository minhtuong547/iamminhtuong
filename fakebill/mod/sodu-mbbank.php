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
              <h6 class="mb-0">Fake Số Dư Chuyển Tiền: <b style="color:#00e3cc;">MB Bank</b>
                </h6>
              </div>
            </div>
          </li>
          <form id="td-mbbank" method="POST">
            <input name="forbank" value="mbbank" hidden="">
            <div id="name" class="row mb-3">
              <label class="col-sm-3 col-form-label" for="trongthao">Tên của bạn</label>
              <div class="col-sm-9">
                <input type="text" id="name" name="name" class="form-control" required placeholder="Tên chủ tài khoản">
              </div>
            </div>
            <div id="stk" class="row mb-3">
              <label class="col-sm-3 col-form-label" for="trongthao">STK của bạn</label>
              <div class="col-sm-9">
                <input type="number" id="stk" name="stk" class="form-control" required placeholder="Số tài khoản của bạn">
              </div>
            </div>
            <div id="sodu" class="row mb-3">
              <label class="col-sm-3 col-form-label" for="trongthao">Số dư</label>
              <div class="col-sm-9">
                <input type="number" id="sodu" name="sodu" class="form-control" required placeholder="Số dư">
              </div>
            </div>
            <div class="row mb-3" id="point">
              <label class="col-sm-3 col-form-label" for="trongthao">Điểm thưởng</label>
              <div class="col-sm-9">
                <input type="number" id="point" name="point" class="form-control" placeholder="Điểm thưởng">
              </div>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary waves-effect waves-light">Tạo số dư</button>
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
    $('#td-mbbank').submit(function(e) {
        e.preventDefault();
        var submitButton = $(this).find('button[type="submit"]');
        showToastrNotification('info', 'Đang tạo số dư, đợi xíu nhen...', 'Thông báo');
        submitButton.html('Đang fake số dư...').prop('disabled', true);
        var randomDelay = Math.floor(Math.random() * (2000 - 1000 + 1)) + 1000;
        setTimeout(function() {
            var formData = $('#td-mbbank').serialize();
            $.ajax({
                type: 'POST',
                url: 'ajax/sodu-mbbank.php',
                data: formData,
                success: function(response) {
                    $('#creator-success').html('');
                    $('#download-img').html('');
                    $('#done-fakebill-td').html('');
                    $('#creator-success').html('<br/><p class="alert alert-success mb-3">Đã tạo ảnh fake số dư thành công!</p>');
                    $('#download-img').html('<a href="data:image/jpeg;base64,' + response +'" download="sodu-mbbank.jpg" class="btn btn-success">Tải Xuống</a><br/><br/>');
                    var image = $('<img>').attr('src', 'data:image/jpeg;base64,' + response);
                    $('#done-fakebill-td').append(image);
                    showToastrNotification('success', 'Tạo thành công', 'Thông báo');
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