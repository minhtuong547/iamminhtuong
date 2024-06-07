<div class="header">
    <div class="container">
        <div class="d-flex">
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
            </a>
            <a class="header-brand" href="../" style="color:#fff;font-weight:bold">
                <i class="fab fa-opencart" style="font-size: 25px;"></i> </a>
        </div>
    </div>
</div>

<div class="admin-navbar sticky" id="headerMenuCollapse">
    <div class="container">
        <ul class="nav">
            <li class="nav-item with-sub">
                <a class="nav-link" href="/<?=config_admin;?>/">
                    <i class="fas fa-home"></i>
                    <span>Tổng Quan</span>
                </a>
            </li>
            <li class="nav-item with-sub">
                <a class="nav-link" href="/<?=config_admin;?>/setting">
                    <i class="fas fa-cogs"></i>
                    <span>Cài Đặt Hệ Thống</span>
                </a>
            </li>
            <li class="nav-item with-sub">
                <a class="nav-link" href="javascript:void(0)" data-toggle="dropdown">
                    <i class="fas fa-cogs"></i>
                    <span>Cài Đặt Event</span>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow">
                    <a href="/<?=config_admin;?>/gifcode" class="dropdown-item">Gifcode</a>
                    <a href="/<?=config_admin;?>/top" class="dropdown-item">Top Tuần</a>
                </div>
            </li>
            <li class="nav-item with-sub">
                <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown">
                    <i class="fas fa-gamepad"></i> Mini Game
                </a>
                <div class="dropdown-menu dropdown-menu-arrow">
                    <a href="/<?=config_admin;?>/game" class="dropdown-item">Edit Game</a>
                    <a href="/<?=config_admin;?>/player-list" class="dropdown-item">Danh Sách Người Chơi</a>
                    <a href="/<?=config_admin;?>/player-block" class="dropdown-item">Danh Sách Đen</a>
                </div>
            </li>
            <li class="nav-item with-sub">
                <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown">
                    <i class="fas fa-wallet"></i> Ví Zalopay
                </a>
                <div class="dropdown-menu dropdown-menu-arrow">
                    <a href="/<?=config_admin;?>/zalopay" class="dropdown-item">Danh Sách Tài Khoản</a>
                    <a href="/<?=config_admin;?>/transfer" class="dropdown-item">Chuyển Tiền</a>
                    <a href="/<?=config_admin;?>/bank_transfer" class="dropdown-item">Chuyển Tiền Ngân Hàng</a>
                    <a href="/<?=config_admin;?>/history" class="dropdown-item">Lịch Sử Tổng</a>
                    <a href="/<?=config_admin;?>/history-error" class="dropdown-item">Lịch Sử Lỗi</a>
                    <a href="/<?=config_admin;?>/check_mgd" class="dropdown-item">Kiểm Tra Mã Giao Dịch</a>
                    <a href="/<?=config_admin;?>/check_history" class="dropdown-item">Kiểm Tra Dòng Tiền</a>
                </div>
            </li>
            <li class="nav-item with-sub">
                <a href="/<?=config_admin;?>/list-account" class="nav-link">
                    <i class="fas fa-user"></i>Tài Khoản
                </a>
            </li>
            <li class="nav-item with-sub">
                <a href="/api/admin/logout" class="nav-link">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> Đăng Xuất
                </a>
            </li>
        </ul>
    </div>
</div>