<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2>Detail Wakaf</h2>
        <ol>
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <li><a href="<?php echo base_url('wakaf'); ?>">Wakaf</a></li>
          <li>Detail</li>
        </ol>
      </div>
    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Wakaf Detail Section ======= -->
  <section id="wakaf-detail" class="wakaf-detail">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <h3><?php echo $wakaf['nosertifikat']; ?></h3>
          <p><strong>Alamat:</strong> <?php echo $wakaf['alamat']; ?></p>
          <p><strong>Pewakaf:</strong> <?php echo $wakaf['pewakaf']; ?></p>
          <p><strong>Keterangan:</strong> <?php echo $wakaf['keterangan']; ?></p>
          <p><strong>Status:</strong> <?php echo $wakaf['status']; ?></p>
        </div>
        <div class="col-lg-12">
          <h4>Lokasi</h4>
          <?php if (!empty($wakaf['koordinat'])): ?>
            <?php
              // Split koordinat menjadi latitude dan longitude
              $coordinates = explode(',', $wakaf['koordinat']);
              $latitude = trim($coordinates[0]);
              $longitude = trim($coordinates[1]);
              $mapUrl = "https://maps.google.com/maps?q={$latitude},{$longitude}&amp;ie=UTF8&amp;iwloc=&amp;output=embed";
            ?>
            <div class="w-100">
              <hr>
              <iframe 
                id="mapcanvas" 
                title="Lokasi Wakaf" 
                src="<?php echo $mapUrl; ?>" 
                width="100%" 
                height="350px" 
                frameborder="0" 
                marginwidth="0" 
                marginheight="0" 
                scrolling="no">
              </iframe>
            </div>
          <?php else: ?>
            <p>Koordinat tidak tersedia.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section><!-- End Wakaf Detail Section -->
</main><!-- End #main -->
