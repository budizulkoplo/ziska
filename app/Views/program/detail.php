<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2>Detail Program</h2>
        <ol>
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <li><a href="<?php echo base_url('program'); ?>">Program LAZIS</a></li>
          <li>Detail</li>
        </ol>
      </div>
    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Program Detail Section ======= -->
  <section id="program-detail" class="program-detail">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <img src="<?php echo base_url('assets/upload/programlazis/' . $program['fotoprogram']); ?>" alt="<?php echo $program['judulprogram']; ?>" class="img-fluid mb-4">
          <h3><?php echo $program['judulprogram']; ?></h3>
          <p><?php echo $program['deskripsiprogram']; ?></p>
          <p><strong>Tanggal Mulai:</strong> <?php echo date('d M Y', strtotime($program['tglmulai'])); ?></p>
          <p><strong>Tanggal Selesai:</strong> <?php echo date('d M Y', strtotime($program['tglselesai'])); ?></p>
          <p><strong>Target Donasi:</strong> Rp<?php echo number_format($program['targetdonasi'], 0, ',', '.'); ?></p>
          <p><strong>Terkumpul:</strong> Rp<?php echo number_format($program['terkumpul'], 0, ',', '.'); ?></p>
        </div>
      </div>
    </div>
    <div class="card-footer text-center">
    <a href="<?= base_url('/login') . '?redirect=' . urlencode(base_url('admin/programlazis/donate/' . $program['idprogram'])) ?>" class="btn btn-success w-100 mt-4">
    <i class="fa fa-eye"></i> Lihat Program
</a>
    </div>
  </section><!-- End Program Detail Section -->
</main><!-- End #main -->
