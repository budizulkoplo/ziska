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
    <li><a class="nav-link scrollto <?= $title == 'Lazismu | Home' ? 'active' : '' ?>" href="<?= base_url() ?>">Home</a></li>
    <li><a class="nav-link scrollto <?= $title == 'Tentang Kami' ? 'active' : '' ?>" href="<?= base_url('/berita/profil/about') ?>">LAZISMU</a></li>
    <li><a class="nav-link scrollto <?= $title == 'Data Wakaf' ? 'active' : '' ?>" href="<?= base_url('wakaf') ?>">WAKAF</a></li>
    <li><a class="nav-link scrollto <?= $title == 'Program LAZIS' ? 'active' : '' ?>" href="<?= base_url('program') ?>">PROGRAM</a></li>
    <li><a class="nav-link scrollto <?= $title == 'Berita LAZISMU' ? 'active' : '' ?>" href="<?= base_url('berita') ?>">Berita</a></li>
    <li><a class="nav-link scrollto <?= $title == 'Kontak Kami' ? 'active' : '' ?>" href="<?= base_url('kontak') ?>">Kontak</a></li>
    <li><a class="nav-link scrollto <?= $title == 'Login' ? 'active' : '' ?>" href="<?= base_url('login') ?>">Login </a></li>

    <li>&nbsp;&nbsp;
    <button onclick="location.href='<?= base_url('kalkulatorzakat') ?>'" class="btn btn-success">
      <i class="nav-icon fas fa-calculator"></i> Kalkulator Zakat
    </button>
    </li>
  </ul>
  <button class="bi bi-list mobile-nav-toggle" aria-label="Toggle navigation"></button>
</nav>
<!-- .navbar -->

  </div>
</header><!-- End Header -->