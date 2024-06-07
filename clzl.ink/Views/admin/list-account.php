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
                        <img src="../assets/images/photos/list-account.png" alt="" style="width: 30px">
                        Đổi Mật Khẩu
                    </h3>
                </div>
                <div class="card-body">
                    <form action="/api/settings/change_pass" method="post">
                        <div class="form-group">
                            <label for="" class="form-label">Mật Khẩu Cũ</label>
                            <input type="password" name="oldpass" class="form-control"
                                placeholder="Mật Khẩu Cũ">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Mật Khẩu Mới</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Mật Khẩu Mới">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Nhập Lại Mật Khẩu Mới</label>
                            <input type="password" name="newpassword" class="form-control"
                                placeholder="Nhập Lại Mật Khẩu Mới">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-exchange" aria-hidden="true"></i> Đổi Mật Khẩu Ngay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/footer.php'); ?>