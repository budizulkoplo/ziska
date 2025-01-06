<?php

use App\Models\Konfigurasi_model;

$konfigurasi  = new Konfigurasi_model;
$site         = $konfigurasi->listing();
// Menu
use App\Models\Menu_model;

$menu         = new Menu_model();
$site         = $konfigurasi->listing();
$menu_berita  = $menu->berita();
$menu_profil  = $menu->profil();
$menu_layanan  = $menu->layanan();
?>
<!-- ======= Footer ======= -->
<!-- <div style="text-align: right; color:#555555;" class="container">
  <p>
    <stong>| <span style="color:#F6B10E;">Membangun Harapan</span> |</stong>
  </p>
</div> -->
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-6 col-md-6">
          <div class="footer-info">
            <h3><?php echo $site['namaweb'] ?></h3>
            <p>
              <?php echo nl2br(strip_tags($site['alamat'])) ?>
              <br>
              <strong>Phone:</strong> <?php echo $site['telepon'] ?><br>
              <strong>Email:</strong> <?php echo $site['email'] ?><br>
            </p>
            <div class="social-links mt-3">
              <a href="<?php echo $site['twitter'] ?>" class="twitter"><i class="fab fa-whatsapp"></i></a>
              <a href="<?php echo $site['facebook'] ?>" class="facebook"><i class="fab fa-facebook"></i></a>
              <a href="<?php echo $site['instagram'] ?>" class="instagram"><i class="fab fa-instagram"></i></a>
              <a href="<?php echo $site['youtube'] ?>" class="google-plus"><i class="fab fa-youtube"></i></a>

            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6 footer-links">
          <!-- <h4>Portofolio</h4>
          <ul>
            <?php foreach ($menu_layanan as $menu_layanan) { ?>
              <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url('berita/layanan/' . $menu_layanan['slug_berita']) ?>"><?php echo $menu_layanan['judul_berita'] ?></a></li>
            <?php } ?>
          </ul> -->
        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>Lazismu Kaliwungu</span></strong>. All Rights Reserved<br>
      Part of the company <strong><span><a href="https://lazismukaliwungu.com">LAZISMU</a></span></strong>
    </div>

  </div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?php echo base_url() ?>/assets/template/assets/vendor/aos/aos.js"></script>
<script src="<?php echo base_url() ?>/assets/template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>/assets/template/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo base_url() ?>/assets/template/assets/vendor/php-email-form/validate.js"></script>
<script src="<?php echo base_url() ?>/assets/template/assets/vendor/purecounter/purecounter.js"></script>
<script src="<?php echo base_url() ?>/assets/template/assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="<?php echo base_url() ?>/assets/template/assets/js/main.js"></script>
<!-- DataTables  & Plugins -->

<script src="<?php echo base_url() ?>/assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>/assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>/assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<script>
  $(function() {
    $('#example1').DataTable();
  });
</script>
</body>

</html>