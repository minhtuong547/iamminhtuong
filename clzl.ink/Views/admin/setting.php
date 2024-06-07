<?php session_start(); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/header.php'); ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/navbar.php'); ?>
<?php
// cài đặt chung
$setting = $soicoder->fetch_assoc("SELECT * FROM `settings` ", 1);
?>
<main class="container">
    <div class="mainbar"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><img src="https://i.imgur.com/3a27lK5.png" alt="" style="width: 30px">
                        Cài Đặt Hệ Thống</h3>
                    
                </div>
                <div class="card-body">
                    <form action="/api/settings/genaral" method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Website</label>
                                    <select name="status" class="form-control">
                                        <?php if ($setting['status'] == 'on') { ?>                                          
                                            <option value="on">Hoạt Động</option>
                                            <option value="off">Bảo Trì</option>
                                        <?php } else { ?>
                                            <option value="off">Bảo Trì</option>
                                            <option value="on">Hoạt Động</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Theme</label>
                                    <select name="theme" class="form-control">
                                        <?php if ($setting['theme'] == '1') { ?>                                          
                                            <option value="1">Theme 1</option>
                                            <option value="2">Theme 2</option>
                                            <option value="3">Theme 3</option>
                                        <?php } else if ($setting['theme'] == '2') { ?>
                                            <option value="2">Theme 2</option>
                                            <option value="1">Theme 1</option>
                                            <option value="3">Theme 3</option>
                                        <?php } else { ?>
                                            <option value="3">Theme 3</option>
                                            <option value="2">Theme 2</option>
                                            <option value="1">Theme 1</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Màu Website (Áp Dụng Cho Theme 2)</label>
                                    <input type="color" name="color_web" value="<?= $setting['color_web']; ?>" class="form-control" placeholder="#1982923">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Thống Kê Tháng</label>
                                    <select name="noti_status" class="form-control">
                                        <?php if ($setting['noti_status'] == 'on') { ?>                                          
                                            <option value="on">Thực Tế Của Zalopay</option>
                                            <option value="off">Theo Hệ Thống</option>
                                        <?php } else { ?>
                                            <option value="off">Theo Hệ Thống</option>
                                            <option value="on">Thực Tế Của Zalopay</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">TOP Tuần</label>
                                    <select name="top_status" class="form-control">
                                        <?php if ($setting['top_status'] == 'on') { ?>                                          
                                            <option value="on">Hiển Thị</option>
                                            <option value="off">Tạm Ẩn</option>
                                            <option value="fake">Fake</option>

                                        <?php } else if ($setting['top_status'] == 'fake'){ ?>
                                            <option value="fake">Fake</option>
                                            <option value="on">Hiển Thị</option>
                                            <option value="off">Tạm Ẩn</option>
                                        <?php } else { ?>
                                            <option value="off">Tạm Ẩn</option>
                                            <option value="on">Hiển Thị</option>
                                            <option value="fake">Fake</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Nhiệm Vụ Ngày</label>
                                    <select name="dmiss_status" class="form-control">
                                        <?php if ($setting['dmiss_status'] == 'on') { ?>                                          
                                            <option value="on">Hiển Thị</option>
                                            <option value="off">Tạm Ẩn</option>
                                        <?php } else { ?>
                                            <option value="off">Tạm Ẩn</option>
                                            <option value="on">Hiển Thị</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Hạn Mức Bơm<small>(Loại Trả Thưởng Tùy Chọn)</small></label>
                                    <input type="text" name="limit_send" value="<?= $setting['limit_send']; ?>" class="form-control" placeholder="Ví dụ 1000000">
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Mô Tả Bên Dưới (Áp Dụng Cho Theme 1)</label>
                                    <select name="des_status" class="form-control">
                                        <?php if ($setting['des_status'] == 'on') { ?>                                          
                                            <option value="on">Hiển Thị</option>
                                            <option value="off">Tạm Ẩn</option>
                                        <?php } else { ?>
                                            <option value="off">Tạm Ẩn</option>
                                            <option value="on">Hiển Thị</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Loại Login Zalo</label>
                                    <select name="type_login" class="form-control">
                                        <?php if ($setting['type_login'] == 'app') { ?>                                          
                                            <option value="app">Login App</option>
                                            <option value="web">Login Web</option>
                                        <?php } else { ?>
                                            <option value="web">Login Web</option>
                                            <option value="app">Login App</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Tên Website</label>
                                    <input type="text" name="nameweb" value="<?= $setting['nameweb']; ?>" class="form-control" placeholder="Tên của trang web, ví dụ: CLMM.VN">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Icon Website</label>
                                    <input type="text" name="favion" value="<?= $setting['favion']; ?>" class="form-control" placeholder="Icon của trang web">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Tiêu Đề</label>
                                    <input type="text" name="description" value="<?= $setting['description']; ?>" class="form-control" placeholder="Tiêu đề của trang web">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Logo Website</label>
                                    <input type="text" name="logo" value="<?= $setting['logo']; ?>" class="form-control" placeholder="Icon của trang web">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Video Hướng Dẫn (xóa link để ẩn)</label>
                                    <input type="text" name="video" value="<?= $setting['video']; ?>" class="form-control" placeholder="Nhập Video Hướng Dẫn">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Keywords</label>
                                    <input type="text" name="keyword" value="<?= $setting['keyword']; ?>" class="form-control" placeholder="Từ khóa tìm kiếm của trang web">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">List Nội Dung Trả Thưởng(Cách Nhau Dấu ,)</label>
                                    <input type="text" name="content" value="<?= $setting['content']; ?>" class="form-control" placeholder="Nhập nội dung trả thưởng">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Telegram Support</label>
                                    <input type="text" name="tele" value="<?= $setting['tele']; ?>" class="form-control" placeholder="Telegram Support">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Telegram Box</label>
                                    <input type="text" name="box_tele" value="<?= $setting['box_tele']; ?>" class="form-control" placeholder="Nhập Telegram Box">
                                </div>
                            </div>
                            
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Giới Hạn Giao Dịch Ngày</label>
                                    <input type="text" name="limit_gd" value="<?= $setting['limit_gd']; ?>" class="form-control" placeholder="Giới hạn giao dịch trong ngày">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Giới hạn Số Tiền Giao Dịch (Ngày)</label>
                                    <input type="text" name="limit_monney_day" value="<?= $setting['limit_monney_day']; ?>" class="form-control" placeholder="Nhập nội dung để phân biệt khi rút tiền">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Giới hạn Số Tiền Giao Dịch (Tháng)</label>
                                    <input type="text" name="limit_monney_month" value="<?= $setting['limit_monney_month']; ?>" class="form-control" placeholder="Nhập nội dung để phân biệt khi rút tiền">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Thưởng Top Tuần</label>
                                    <input type="text" name="reward_top" value="<?= $setting['reward_top']; ?>" class="form-control" placeholder="Cách nhau dấu /">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Kết Quả Sai Nội Dung</label>
                                    <input type="text" name="wrong_content_result" value="<?= $setting['wrong_content_result']; ?>" class="form-control" placeholder="Thua Do Sai Nội Dung,...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Kết Quả Sai Min/Max</label>
                                    <input type="text" name="wrong_result" value="<?= $setting['wrong_result']; ?>" class="form-control" placeholder="Thua Do Sai Min/Max,...">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Nội Dung Bảo Trì</label>
                                    <input type="text" name="maintenance_content" value="<?= $setting['maintenance_content']; ?>" class="form-control" placeholder="Web tạm bảo trì để zalo quét số">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Nội Dung Thông Báo</label>
                                    <textarea id="texteditor" name="event" class="form-control" placeholder="Nhập nội dung thông báo modal popup"><?= $setting['event']; ?></textarea>
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
<script src="//cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'texteditor' );
</script>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/footer.php'); ?>