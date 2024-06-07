<?php
function ansuzhi_format($var){
	$dulieu = trim(addslashes(htmlspecialchars($var)));
	return $dulieu;    
}

function trangthai_taoweb($tt){
	if($tt == 0){
		return '<button class="text-light btn btn-info">Đang tạo</button>';
	}

	if($tt == 1){
		return '<button class="text-light btn btn-danger">Tạo thất bại</button>';
	}

	if($tt == 2){
		return '<button class="text-light btn btn-success">Đang hoạt động</button>';
	}

}

function trangthai_mien($tt){
	if($tt == 0){
		return '<button class="text-light btn btn-info">Đang tạo</button>';
	}

	if($tt == 1){
		return '<button class="text-light btn btn-danger">Thất Bại</button>';
	}

	if($tt == 2){
		return '<button class="text-light btn btn-success">Thành Công</button>';
	}
	 

}

function trangthai_giahan($tt){
	if($tt == 0){
		return '<button class="text-light btn btn-info">Chờ gia hạn</button>';
	}

	if($tt == 2){
		return '<button class="text-light btn btn-success">Hoàn thành</button>';
	}
}

function chucvu($stt){
	if($stt == 1){
		return 'Thành viên';
	}
	if($stt == 9){
		return 'Quản trị viên';
	}
	if($stt == 6){
		return 'Cộng tác viên';
	}
	return 'Không xác định';
}

function check_trangthai($trangthai){
	if($trangthai == 0){
		return '<button class="text-light btn btn-info">Chờ Duyệt</button>';
	}
	if($trangthai == 1){
		return '<button class="text-light btn btn-danger">Thẻ sai</button>';
	}
	if($trangthai == 2){
		return '<button class="text-light btn btn-success">Thẻ đúng</button>';
	}
}

function check_trangthairut($trangthai){
	if($trangthai == 0){
		return '<button class="text-light btn btn-info">Chờ Duyệt</button>';
	}
	if($trangthai == 1){
		return '<button class="text-light btn btn-danger">Không Thành Công!Sẽ hoàn tiền</button>';
	}
	if($trangthai == 2){
		return '<button class="text-light btn btn-success">Thành Công</button>';
	}
}

?>