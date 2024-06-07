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
                        <img src="https://i.imgur.com/AXLKcf1.png" alt="" style="width: 30px">
                        Danh Sách Điểm Danh
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
                                <span class="input-group-btn ml-2">
                                    <button type="button" class="btn btn-sm btn-danger action-muster"
                                        data-action="remove-all">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </span>
                            </div>

                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="form-group">
                            <div class="row gutters-xs">
                                <div class="col">
                                    <input type="text" name="search" class="form-control" value=""
                                        placeholder="Nhập nội dung tìm kiếm....">
                                </div>
                                <span class="col-auto">
                                    <button class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <a href="../adminPanel/muster" class="btn btn-light text-danger">
                                        <i class="fas fa-times-circle"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive table-mousewheel mb-3">
                        <table
                            class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                            <thead class="badge-primary text-white">
                                <tr>
                                    <th class="text-white">Mã Phiên</th>
                                    <th class="text-white">Delay</th>
                                    <th class="text-white">Tổng</th>
                                    <th class="text-white">Tiền Thắng</th>
                                    <th class="text-white">Người Thắng</th>
                                    <th class="text-white">Người Chơi</th>
                                    <th class="text-white">Trạng Thái</th>
                                    <th class="text-white">Thời Gian</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="edit-one" data-id="63c0bb2f4e1be760597466c9">
                                    <td><span class="badge badge-info">#557193</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-warning">Đang Chạy</span></td>
                                    <td>2023-01-13 09:00:15</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c0bb2f4e1be760597466c9"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c0bb2f4e1be760597466c9"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c0b8d64e1be760597461aa">
                                    <td><span class="badge badge-info">#470623</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-13 09:00:14</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c0b8d64e1be760597461aa"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c0b8d64e1be760597461aa"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c0b67d4e1be76059745c88">
                                    <td><span class="badge badge-info">#802860</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-13 08:50:13</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c0b67d4e1be76059745c88"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c0b67d4e1be76059745c88"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c0b4244e1be76059745757">
                                    <td><span class="badge badge-info">#530012</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-13 08:40:12</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c0b4244e1be76059745757"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c0b4244e1be76059745757"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c0b1cb4e1be76059745216">
                                    <td><span class="badge badge-info">#558670</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-13 08:30:11</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c0b1cb4e1be76059745216"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c0b1cb4e1be76059745216"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c0af724e1be76059744c96">
                                    <td><span class="badge badge-info">#252854</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-13 08:20:10</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c0af724e1be76059744c96"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c0af724e1be76059744c96"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c0ad194e1be76059744784">
                                    <td><span class="badge badge-info">#999631</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-13 08:10:09</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c0ad194e1be76059744784"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c0ad194e1be76059744784"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c0aabf4e1be76059744275">
                                    <td><span class="badge badge-info">#927490</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-13 08:00:08</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c0aabf4e1be76059744275"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c0aabf4e1be76059744275"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c0a8664e1be76059743cbd">
                                    <td><span class="badge badge-info">#312383</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-13 07:50:06</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c0a8664e1be76059743cbd"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c0a8664e1be76059743cbd"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c0a60d4e1be760597437af">
                                    <td><span class="badge badge-info">#311175</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-13 07:40:05</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c0a60d4e1be760597437af"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c0a60d4e1be760597437af"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c0a3b34e1be7605974329f">
                                    <td><span class="badge badge-info">#341212</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-13 07:30:04</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c0a3b34e1be7605974329f"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c0a3b34e1be7605974329f"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c0a15b4e1be76059742d90">
                                    <td><span class="badge badge-info">#479626</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-13 07:20:02</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c0a15b4e1be76059742d90"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c0a15b4e1be76059742d90"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c09f014e1be7605974287d">
                                    <td><span class="badge badge-info">#267737</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-13 07:10:02</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c09f014e1be7605974287d"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c09f014e1be7605974287d"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c03af54e1be7605974139f">
                                    <td><span class="badge badge-info">#728966</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-13 07:00:00</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c03af54e1be7605974139f"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c03af54e1be7605974139f"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c0389c4e1be76059740e79">
                                    <td><span class="badge badge-info">#922313</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-12 23:53:08</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c0389c4e1be76059740e79"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c0389c4e1be76059740e79"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                                <tr class="edit-one" data-id="63c036434e1be760597408c9">
                                    <td><span class="badge badge-info">#968931</span></td>
                                    <td class="timeDefault">600s</td>
                                    <td>0</td>
                                    <td>0đ</td>
                                    <td class="win"></td>
                                    <td><textarea class="form-control"></textarea>
                                    </td>
                                    <td class="status"><span
                                            class="badge badge-success">Hoàn Thành</span></td>
                                    <td>2023-01-12 23:43:07</td>
                                    <td><span class="badge badge-info action-muster hand" data-id="63c036434e1be760597408c9"
                                            data-action="edit"><i class="fas fa-pen"></i></span> <span
                                            class="badge badge-danger action-muster hand" data-id="63c036434e1be760597408c9"
                                            data-action="remove"><i class="fas fa-trash"></i></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-3">
                        <ul class="pagination-container">
                            <li class="page-item page-prev disabled" >
                                <a class="page-link"
                                    href="/adminPanel/muster?page=1">Prev</a>
                            </li>
                            <li class="page-item active" >
                                <a class="page-link"
                                    href="/adminPanel/muster?page=1">1</a>
                            </li>
                            <li >
                                <a class="page-link"
                                    href="/adminPanel/muster?page=2">2</a>
                            </li>
                            <li >
                                <a class="page-link"
                                    href="/adminPanel/muster?page=2">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Views/admin/layout/footer.php'); ?>