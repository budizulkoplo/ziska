<?php

use App\Models\Konfigurasi_model;

$konfigurasi  = new Konfigurasi_model;
$site         = $konfigurasi->listing();

?>
<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2><?php echo $site['namaweb']; ?></h2>
        <ol>
          <li><a href="<?php echo base_url() ?>">Home</a></li>
          <li><?php echo $title ?></li>
        </ol>
      </div>
    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">
      <div class="row mt-2">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3><?php echo $title ?></h3>
            </div>
            <div class="card-body">
              <?php echo $berita['isi'] ?>
            </div>
            <div class="card-footer">
              Updated by: <?php echo $berita['nama'] ?> | Tanggal: <?php echo tanggal_bulan_menit($berita['tanggal']) ?>
            </div>
          </div>

        </div>

      </div>
    </div>
  </section><!-- End Contact Section -->
</main><!-- End #main -->