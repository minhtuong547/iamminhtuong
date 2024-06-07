
  <!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="container">
      <div class="row d-flex align-items-center"">
      <div class=" col-lg-6 py-5 py-lg-0 order-2 order-lg-1" data-aos="fade-right">
        <h1>TAOSHOPAUTO</h1>
        <h2>mang đến những shop game sử dụng công nghệ tiên tiến, hiện đại và đặc biệt là an toàn đó là sứ mệnh của chúng tôi, hiện tại chúng tôi đang có dự án hợp tác tạo shop miễn phí cho tất cả youtuber hãy liên hệ ngay với chúng tôi nếu bạn đã sẵn sàng</h2>
        <a href="https://fb.com/dvtantai" class="btn-get-started scrollto">Liên Hệ Ngay</a>
      </div>
       </div>
    </div>

  </section><!-- End Hero -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container">

        <div class="section-title">
          <h2 data-aos="fade-in">CÁC MẪU SHOP GAME</h2>
        </div>

 	<div class="row">
<?php
		$result = mysqli_query($connect, "SELECT * FROM danhsachcode ");
		while($row = mysqli_fetch_assoc($result)){
			?>

        
          <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-right">
            <div class="card">
              <div class="card-img">
                <img src="<?php echo $row['thumbnail']; ?>" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="">Mẫu <?php echo $row['id']; ?></a></h5>
                <center><p class="card-text">GIÁ <?php echo $row['gia']; ?>VNĐ/1 THÁNG</p>
                  <button type="button" class="btn btn-outline-danger" onclick="window.location.href='/tao-web/<?php echo $row['id'];?>'"><i class="bi bi-arrow-right-circle"></i> Tạo Ngay</button>
              </center>
             </div></div>
                                   </div>
          
			<?php
		}
		?>	
     </div>


        
         
    </section><!-- End Portfolio Section -->
</div>
  </main><!-- End #main -->