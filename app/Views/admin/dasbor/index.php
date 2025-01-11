<?php 
$session = \Config\Services::session();
use App\Models\Dasbor_model;

$m_dasbor = new Dasbor_model();
?>
<div class="alert bg-lazis">
	<h4>Hai <em class="text-white"><?= $session->get('nama') ?></em></h4>
</div>

<?php if (in_array($session->get('akses_level'), ["superadmin", "Admin"])): ?>
<!-- Info boxes untuk superadmin dan admin -->
<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
      <div class="info-box-content"> 
        <span class="info-box-text">Muzaki</span>
        <span class="info-box-number">
          <?= angka($m_dasbor->muzaki()) ?>
          <small>Konten</small>
        </span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-lock"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Pengguna Website</span>
        <span class="info-box-number"><?= angka($m_dasbor->user()) ?></span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check-alt"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Transaksi Sukses</span>
        <span class="info-box-number">Rp. <?= angka($m_dasbor->suksestransaksi()) ?></span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-check-alt"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Transaksi Pending</span>
        <span class="info-box-number">Rp. <?= angka($m_dasbor->pendingtransaksi()) ?></span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-home"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Wakaf</span>
        <span class="info-box-number"><?= angka($m_dasbor->wakaf()) ?></span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-newspaper"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Program Lazis</span>
        <span class="info-box-number">
          <?= angka($m_dasbor->programlazis()) ?>
          <small>Konten</small>
        </span>
      </div>
    </div>
  </div>
</div>

<?php elseif ($session->get('akses_level') == "muzaki"): ?>
<!-- Info box untuk muzaki -->
<div class="row">
  <?php
    $tahunList = $m_dasbor->listTahunTransaksi(); // Ambil daftar tahun transaksi
    foreach ($tahunList as $tahun) {
        // Menampilkan info transaksi sukses per tahun
        $totalTransaksi = $m_dasbor->sumTransaksiPerTahun($tahun->tahun);
  ?>
  <div class="col-12 col-sm-6 col-md-3">
  <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check-alt"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Transaksi Sukses <?= $tahun->tahun ?></span>
          <span class="info-box-number">Rp. <?= angka($totalTransaksi) ?></span>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
<?php endif; ?>



