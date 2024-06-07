<?php
$info = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM thongtin "));
?>
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021 <a href="<?php echo $info['facebook']; ?>" target="_blank"><?php echo $info['admin']; ?></a>. All rights reserved.</span>
    <span class="text-muted float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Ngày sáng tác 25/6/2021 <i class="mdi mdi-heart text-danger"></i></span>
  </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="/taivip_2004/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="/../../../admin/js/bootstrap.bundle.min.js"></script>
<script src="/../../../admin/js/jquery-3.6.0.min.js"></script>
<script src="/../../../admin/js/sweetalert.min.js"></script>
<script src="/taivip_2004/assets/vendors/chart.js/Chart.min.js"></script>
<script src="/taivip_2004/assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="/taivip_2004/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="/taivip_2004/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/taivip_2004/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="/taivip_2004/assets/js/off-canvas.js"></script>
<script src="/taivip_2004/assets/js/hoverable-collapse.js"></script>
<script src="/taivip_2004/assets/js/misc.js"></script>
<script src="/taivip_2004/assets/js/settings.js"></script>
<script src="/taivip_2004/assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="/taivip_2004/assets/js/dashboard.js"></script>
<script src="/taivip_2004/assets/js/chart.js"></script>
<!-- End custom js for this page -->
</body>
</html>