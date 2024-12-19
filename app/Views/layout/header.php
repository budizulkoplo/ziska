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
<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
  <div class="container d-flex align-items-center justify-content-center justify-content-md-between">

  </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">

    <a href="<?php echo base_url() ?>/berita/profil/about-us" class="logo me-auto"><img src="<?php echo base_url('assets/upload/image/' . $site['logo']) ?>" alt="<?php echo $site['namaweb'] ?>">

    </a>

    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <h1 class="logo me-auto"><a href="index.html">Medicio</a></h1> -->

    <nav id="navbar" class="navbar order-last order-lg-0">
      <ul>
        <li><a class="nav-link scrollto <?php if (strlen($title) > 50) {
                                          echo "active";
                                        } ?>" href="<?php echo base_url() ?>">Home</a></li>
        <li><a class="nav-link scrollto <?php if ($title == "About Us") {
                                          echo "active";
                                        } ?> " href="<?php echo base_url() ?>/berita/profil/about-us"><span>Profil</span> </i></a>
        </li>


        <li class="dropdown"><a href="#" class="<?php if ($title <> "About Us" and $title <> "Kontak Kami" and $title <> "Download File" and $title <> "Galeri Gambar" and $title <> "Video File" and strlen($title) < 50) {
                                                  echo "active";
                                                } ?>  "><span>Portofolio</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <?php foreach ($menu_layanan as $menu_layanan) { ?>
              <li><a href="<?php echo base_url('berita/layanan/' . $menu_layanan['slug_berita']) ?>"><?php echo $menu_layanan['judul_berita'] ?></a></li>
            <?php } ?>
          </ul>
        </li>

        <li class="dropdown"><a href="#" class="<?php if ($title == "Galeri Gambar" or $title == "Video File") {
                                                  echo "active";
                                                } ?>"><span>Galeri &amp; Video</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="<?php echo base_url('galeri') ?>">Galeri Gambar</a></li>
            <li><a href="<?php echo base_url('video') ?>">Galeri Video</a></li>
          </ul>
        </li>
        <li><a class="nav-link scrollto <?php if ($title == "Download File") {
                                          echo "active";
                                        } ?>" href="<?php echo base_url('download') ?>">Download</a></li>
        <li><a class="nav-link scrollto <?php if ($title == "Kontak Kami") {
                                          echo "active";
                                        } ?>" href="<?php echo base_url('kontak') ?>">Kontak</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->