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
                <h6 class="mb-0"><b style="color:#00e3cc;">Fake Biến Động Số Dư Ngân Hàng</b>
                </h6>
              </div>
            </div>
          </li>
          <form id="td-bdsd" method="POST">
            <input name="bank" value="bdsd" hidden="">
              <div class="space-y-4 mb-8">
                                    <!-- Company Name -->
                                     <label class="block text-sm font-medium mb-1" for="bank">Biến động của ngân hàng <span class="text-rose-500">*</span></label>
                                            <select id="bank" class="form-select w-full" name="bank" onchange="chonBank()">
                                            <option value="">Ngân hàng fake biến động số dư</option>
                                            <option value="agribank" int='type,time,sotien,soducuoi,noidung,stk,soducuoi'>Agribank</option>
                                            <option value="acb" int='type,time,sotien,soducuoi,noidung,stk,soducuoi'>ACB Bank</option>
                                            <option value="vietinbank" int='type,time,sotien,soducuoi,noidung,stk,soducuoi'>Vietinbank</option>
                                            <option value="tpbank" int='type,time,sotien,soducuoi,noidung,stk,soducuoi'>Tpbank</option>
                                        </select>
                                         <div class="mt-3" id="type">
                                           <select class="form-control" name="type">
                                               <option value="out">Trừ tiền</option>
                                               <option value="in">Cộng tiền</option>
                                               
                                           </select>
                                    </div>
            <div class="flex-1" id="stk">
                         <label class="block text-sm font-medium mb-1" for="stk">STK của bạn<span class="text-rose-500">*</span></label>
                                            <input name="stk"  class="form-control mb-1 mt-1 w-full" placeholder="" type="text">
                                    </div>
                                    <!-- City and Postal Code -->
                                    <div class="flex space-x-4">
                                      
                                        
                                    <div class="flex-1" id="sotien">
                                            <label class="block text-sm font-medium mb-1" for="sotiengd">Số tiền giao dịch<span class="text-rose-500">*</span></label>
                                            <input name="sotien"  class="form-control mb-1 mt-1 w-full" type="number" placeholder="Ví dụ: 10000" type="text">
                                    </div>
                                         <div class="flex-1" id="soducuoi">
                                            <label class="block text-sm font-medium mb-1" for="soducuoi">Số dư cuối<span class="text-rose-500">*</span></label>
                                            <input name="soducuoi"  class="form-control mb-1 mt-1 w-full" type="number" placeholder="Ví dụ: 100000" type="text">
                                    </div>  
                                    </div>
                                  
                                    <div class="flex space-x-4">
                                         <div class="flex-1" id="time">
                                            <label class="block text-sm font-medium mb-1" for="time">Thời gian<span class="text-rose-500">*</span></label>
                                            <input name="time" placeholder="Ví dụ: 14:58 Thứ Ba 25/07/2023" value="<?php date_default_timezone_set('Asia/Ho_Chi_Minh');echo date('d/m/Y - H:i:s');?>"  class="form-control mb-1 mt-1 w-full" type="text">
                                    </div>
                                       <div class="flex-1" id="noidung">
                                            <label class="block text-sm font-medium mb-1" for="noidung">Nội dung chuyển khoản<span class="text-rose-500">*</span></label>
                                            <textarea type="text" id="noidung" name="noidung" required class="form-control" placeholder="Nhập nội dung CK"></textarea>
                                    </div>
                                </div>
                            <br>
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
    $('#td-bdsd').submit(function(e) {
        e.preventDefault();
        var submitButton = $(this).find('button[type="submit"]');
        submitButton.html('Đang fake bill...').prop('disabled', true);
        showToastrNotification('info', 'Đang tạo bill...', 'Thông báo');
        var randomDelay = Math.floor(Math.random() * (2000 - 1000 + 1)) + 1000;
        setTimeout(function() {
            var formData = $('#td-bdsd').serialize();
            $.ajax({
                type: 'POST',
                url: 'ajax/biendong.php',
                data: formData,
                success: function(response) {
                    $('#creator-success').html('');
                    $('#download-img').html('');
                    $('#done-fakebill-td').html('');
                    $('#creator-success').html('<br/><p class="alert alert-success mb-3">Đã tạo ảnh biến động thành công!</p>');
                    $('#download-img').html('<a href="data:image/jpeg;base64,' + response + '" download="bdsd-minhtuong.jpg" class="btn btn-success">Tải Bill Xuống</a><br/><br/>');
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