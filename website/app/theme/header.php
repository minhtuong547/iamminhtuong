<?php
$url = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM thongtin "));
?>
 <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/css/style.css" rel="stylesheet">
 
</head>

<body>

 <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span>TAOSHOPAUTO</span>
      </a>

      <nav id="navbar" class="navbar">
                <ul>
          <li><a class="nav-link scrollto active" href="/">Trang Chủ</a></li>
          <li><a class="nav-link scrollto" href="/domain">DV Domain</a></li>
          <li><a class="nav-link scrollto" href="/nap-tien">Nạp Tiền</a></li>
          <?php
					if(isset($_SESSION['user'])){
					
					?>	
					
<a class="getstarted scrollto" href="/profile"><?php echo $_SESSION['user']; ?></text> - <?php echo number_format($user['tien']); ?> VNĐ</a>

	<a class="getstarted scrollto" href="/dang-xuat">Đăng Xuất</a>
	
	 <?php
									if($user['chucvu'] == 9){
										?>
									 <a class="getstarted scrollto" href="/taivip_2004">Admin</a>
										<?php
									}
									?>
	
								</li></ul>
								
								
						<?php
					} else {
						?>
						<span class="px-1"></span>
						<a class="getstarted scrollto" href="/dang-nhap">Đăng Nhập</a>
						<a class="getstarted scrollto" href="/dang-ky">Đăng Ký</a>

						<?php
					}
					?>
		        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      
    </div>
  </header>
  
  
    <!-- End Header -->
	</nav>
</body>
</br>
</br>
</br>