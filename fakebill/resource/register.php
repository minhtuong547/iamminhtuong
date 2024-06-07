<?php require_once('../include/head.php'); ?>
<?php require_once('../include/nav.php'); ?>
<style>.Blob {
  background: black;
  border-radius: 15%;
  height: 50px;
  width: 50px; 
  box-shadow: 0 1px 7px rgb(231, 231, 231);
}</style>
<div class="position-relative">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
 <div class="card"style="max-width: 500px; margin: auto;">
            <!-- Logo -->
            <div class="app-brand justify-content-center mt-5">
              <a href="/" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
<img alt="logo" class="Blob" src="https://i.pinimg.com/564x/f4/f0/92/f4f09248fd82293a709b96ea1e3d7692.jpg">
                </span>
                <span class="app-brand-text demo text-heading fw-bold">TrongThao</span>
              </a>
            </div>
            <!-- /Logo -->

            <div class="card-body mt-2">
              <h4 class="mb-2">Chào mừng đến với TrongThao 👋</h4>
              <p class="mb-4">Đăng kí tài khoản của bạn</p>
               <form id="formAuthentication" class="mb-3" action="" method="POST">
                   <div class="form-floating form-floating-outline mb-3">
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Địa chỉ email"
                    autofocus />
                  <label for="email">Email</label>
                </div>
                <div class="form-floating form-floating-outline mb-3">
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Tên tài khoản"
                    autofocus />
                  <label for="username">Username</label>
                </div>
                <div class="mb-3">
                  <div class="form-password-toggle">
                    <div class="input-group input-group-merge">
                      <div class="form-floating form-floating-outline">
                        <input type="password" id="password" class="form-control" name="password"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          aria-describedby="password" />
                        <label for="password">Mật khẩu</label>
                      </div>
                      <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                    </div>
                  </div>
                </div>
              
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Đăng kí</button>
                </div>
              </form>

              <p class="text-center">
                <span>Đã có tài khoản?</span>
                <a href="login">
                  <span>đăng nhập</span>
                </a>
              </p>

       
            </div>
          </div>
</div>
 </div>
      </div>
    </div>
<?php require_once('../include/foot.php'); ?>