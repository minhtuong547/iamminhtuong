  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
    <div class="layout-container">
      <!-- Navbar -->
      <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="container-xxl">
          <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
            <a href="./" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <span style="color: var(--bs-primary)">
                  <img alt="" width="50" height="50" src="https://files.catbox.moe/2yy19g.png"/>
                </span>
              </span>
              <span class="app-brand-text demo menu-text fw-bold">Đinh Minh Tướng  </span>
            </a>
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
              <i class="mdi mdi-close align-middle"></i>
            </a>
          </div>
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="mdi mdi-menu mdi-24px"></i>
            </a>
          </div>
          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- Language -->
              <li class="nav-item dropdown-language dropdown me-1 me-xl-0">
                <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" href="./" data-bs-toggle="dropdown">
                  <i onclick="window.location.href='./';" class="mdi mdi-home mdi-24px"></i>
                </a>
              </li>
              <!--/ Language -->
              <!-- Style Switcher -->
               <li class="nav-item dropdown-style-switcher dropdown me-1 me-xl-0">
                  <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow waves-effect waves-light" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="mdi mdi-24px mdi-weather-sunny"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" data-theme="light">
                        <span class="align-middle"><i class="mdi mdi-weather-sunny me-2"></i>Light</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" data-theme="dark">
                        <span class="align-middle"><i class="mdi mdi-weather-night me-2"></i>Dark</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" data-theme="system">
                        <span class="align-middle"><i class="mdi mdi-monitor me-2"></i>System</span>
                      </a>
                    </li>
                  </ul>
                </li>
               <li class="nav-item dropdown-style-switcher dropdown me-1 me-xl-0">
                  <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow waves-effect waves-light" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <img alt="logo" class="Blob" src="https://i.pinimg.com/564x/f4/f0/92/f4f09248fd82293a709b96ea1e3d7692.jpg">
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                        <a class="dropdown-item waves-effect" href="/">
                        <i class="mdi mdi-logout me-2"></i>
<span class="align-middle">Đăng xuất</span>
 </a>
                    </li>
                  </ul>
                </li>
              <!-- / Style Switcher-->    
            </ul>
          </div>
        </div>
      </nav>
      <div class="layout-page">
        <div class="content-wrapper">
          <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
            <div class="container-xxl d-flex h-100">
              <ul class="menu-inner">
                <!-- Dashboards -->
                <li class="menu-item">
                  <a href="./" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                    <div data-i18n="Home Page">Trang chủ</div>
                  </a>
                </li>
                <li class="menu-item">
                    <a data-bs-toggle="modal" data-bs-target="#modalLong" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-currency-usd"></i>
                    <div data-i18n="Topup">Bảng giá</div>
                  </a>
                </li>
              </ul>
            </div>
          </aside>
          <!-- / Menu -->
          <div class="modal fade" id="modalLong" tabindex="-1" aria-labelledby="modalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLongTitle">Bảng giá</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="nav-align-top">
                    <ul class="nav nav-pills mb-3" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">Fake Bill</button>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                        <div class="table-responsive text-nowrap mt-4">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Bank</th>
                                <th>Giá tiền</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>SHB</td>
                                <td>free/bill</td>
                              </tr>
                              <tr>
                                <td>PVcombank</td>
                                <td>free/bill</td>
                              </tr>
                              <tr>
                                <td>Momo</td>
                                <td>free/bill</td>
                              </tr>
                              <tr>
                                <td>TPBank</td>
                                <td>free/bill</td>
                              </tr>
                              <tr>
                                <td>MBBank</td>
                                <td>free/bill</td>
                              </tr>
                              <tr>
                                <td>Techcombank</td>
                                <td>free/bill</td>
                              </tr>
                              <tr>
                                <td>Agribank</td>
                                <td>free/bill</td>
                              </tr>
                              <tr>
                                <td>Seabank</td>
                                <td>free/bill</td>
                              </tr>
                              <tr>
                                <td>Vietinbank</td>
                                <td>free/bill</td>
                              </tr>
                              <tr>
                                <td>Vietcombank</td>
                                <td>free/bill</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <br />
          <br />