<?php

// Your data structure
$data = array(
    "code" => "00",
    "desc" => "Get Bank By trongthao",
    "data" => array(
        array(
            "name" => "Á Châu (ACB)",
            "code" => "ACB",
            "shortName" => "Á Châu (ACB)"
        ),
        array(
            "name" => "Đầu tư và phát triển (BIDV)",
            "code" => "BIDV",
            "shortName" => "Đầu tư và phát triển (BIDV)"
        ),
        array(
            "name" => "Bảo Việt (BVB)",
            "code" => "BVB",
            "shortName" => "Bảo Việt (BVB)"
        ),
       array(
            "name" => "Xuất nhập khẩu (EIB)",
            "code" => "EIB",
            "shortName" => "Xuất nhập khẩu (EIB)"
        ),
        array(
            "name" => "Hàng hải (MSB)",
            "code" => "MSB",
            "shortName" => "Hàng hải (MSB)"
        ),
        array(
            "name" => "Nam Á (NAMABANK)",
            "code" => "NAMABANK",
            "shortName" => "Nam Á (NAMABANK)"
        ),
        array(
            "name" => "Đông Nam Á (SEAB)",
            "code" => "SEAB",
            "shortName" => "Đông Nam Á (SEAB)"
        ),
        array(
            "name" => "Sài Gòn Công thương (SGB)",
            "code" => "SGB",
            "shortName" => "Sài Gòn Công thương (SGB)"
        ),
        array(
            "name" => "Sài Gòn Hà Nội (SHB)",
            "code" => "SHB",
            "shortName" => "Sài Gòn Hà Nội (SHB)"
        ),
        array(
            "name" => "Sacombank (STB)",
            "code" => "STB",
            "shortName" => "Sacombank (STB)"
        ),
        array(
            "name" => "Kỹ Thương (TCB)",
            "code" => "TCB",
            "shortName" => "Kỹ Thương (TCB)"
        ),
        array(
            "name" => "Tiên Phong (TPB)",
            "code" => "TPB",
            "shortName" => "Tiên Phong (TPB)"
        ),
        array(
            "name" => "Nông nghiệp và Phát triển nông thôn (VBA)",
            "code" => "VBA",
            "shortName" => "Nông nghiệp và Phát triển nông thôn (VBA)"
        ),
        array(
            "name" => "Ngoại thương Việt Nam (VCB)",
            "code" => "VCB",
            "shortName" => "Ngoại thương Việt Nam (VCB)"
        ),
        array(
            "name" => "Phát triển Việt Nam (VDB)",
            "code" => "VDB",
            "shortName" => "Phát triển Việt Nam (VDB)"
        ),
        array(
            "name" => "Quốc tế (VIB)",
            "code" => "VIB",
            "shortName" => "Quốc tế (VIB)"
        ),
        array(
            "name" => "Việt Nam Thương tín (VIETBANK)",
            "code" => "VIETBANK",
            "shortName" => "Việt Nam Thương tín (VIETBANK)"
        ),
        array(
            "name" => "Công Thương Việt Nam (VIETINBANK)",
            "code" => "VIETINBANK",
            "shortName" => "Công Thương Việt Nam (VIETINBANK)"
        ),
        array(
            "name" => "Việt Nam Thinh Vượng (VPB)",
            "code" => "VPB",
            "shortName" => "Việt Nam Thinh Vượng (VPB)"
        ),
        array(
            "name" => "Quân Đội (MB)",
            "code" => "MB",
            "shortName" => "Quân Đội (MB)"
        ),
        // Add more data arrays as needed
    )
);
$jsonData = json_encode($data);
header('Content-Type: application/json');
echo $jsonData;

?>
