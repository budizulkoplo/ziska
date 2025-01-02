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
        <li><a class="nav-link scrollto <?php if ($title == "Tentang Kami") {
                                          echo "active";
                                        } ?> " href="<?php echo base_url() ?>/berita/profil/about"><span>LAZISMU</span> </i></a>
        </li>
        <li><a class="nav-link scrollto <?php if ($title == "Wakaf") {
                                          echo "active";
                                        } ?>" href="<?php echo base_url('wakaf') ?>">WAKAF</a></li>
         <li><a class="nav-link scrollto <?php if ($title == "Program Lazis") {
                                          echo "active";
                                        } ?>" href="<?php echo base_url('program') ?>">PROGRAM</a></li>


        <li class="dropdown"><a href="#" class="<?php if ($title <> "Tentang Kami" and $title <> "Wakaf" and $title <> "Program Lazis" and $title <> "Kontak" and $title <> "Lazismu | Home" and strlen($title) < 50) {
                                                  echo "active";
                                                } ?>  "><span>Info</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <?php foreach ($menu_layanan as $menu_layanan) { ?>
              <li><a href="<?php echo base_url('berita/layanan/' . $menu_layanan['slug_berita']) ?>"><?php echo $menu_layanan['judul_berita'] ?></a></li>
            <?php } ?>
          </ul>
        </li>
        <li><a class="nav-link scrollto <?php if ($title == "Kontak Kami") {
                                          echo "active";
                                        } ?>" href="<?php echo base_url('kontak') ?>">Kontak</a></li>
        <li><a class="nav-link scrollto <?php if ($title == "Login") {
                                          echo "active";
                                        } ?>" href="<?php echo base_url('login') ?>">Login</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->